<?php

namespace Modules\Account\Http\Controllers\Order;

use App\Http\Requests\OrderByCodesRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Models\Good;
use App\Models\Goods\Category;
use App\Models\Goods\Group;
use App\Models\User;
use Gloudemans\Shoppingcart\CartItem;
use Illuminate\Http\RedirectResponse;
use Inertia\Response as InertiaResponse;
use Modules\Account\Exports\OrderGoodsExport;
use Modules\Account\Http\Controllers\Controller;
use Modules\Account\Http\Requests\OrderRequest;
use Modules\Account\Imports\CodesImport;
use Modules\Account\Notifications\NewOrder;
use Modules\Account\Repositories\GoodRepository;

final class OrderController extends Controller
{
    public function __construct(private GoodRepository $repository)
    {

    }

    public function page(Group $group = null, Category $category = null): InertiaResponse
    {
        $this->seo()->setTitle('Заказ товаров');

        $availableCategories = \Auth::user()->availableCategories()->pluck('id');

        $groups = Group::whereHas('categories', fn($q) => $q->whereIn('id', $availableCategories))->get(['id', 'name']);

        if ($group) {
            $categories = $group->categories()->whereIn('id', $availableCategories)->get();
        }

        if ($category) {
            $goods = $this->repository->getByCategory($category);
        }

        return inertia('Order/Page', [
            'data' => [
                'groups' => $groups ?? [],
                'categories' => $categories ?? [],
                'group' => $group?->id,
                'category' => $category?->id,
                'goods' => $goods ?? []
            ]
        ]);
    }

    public function update(OrderUpdateRequest $request): RedirectResponse
    {
        $user = \Auth::user();
        $goods = $request->input('goods');

        \Cart::setGlobalTax(0);
        \Cart::restore($user->id);
        foreach ($goods as $id => $qty) {
            $good = $this->repository->calculateSale(Good::find($id), $user);
            \Cart::add($good, (int)$qty);
        }
        \Cart::store($user->id);

        return back()->with(['toast' => ['text' => 'Товары были добавлены.']]);
    }

    public function byCodes(OrderByCodesRequest $request): InertiaResponse
    {
        $this->seo()->setTitle('Заказ по кодам');

        if ($request->hasFile('excel')) {
            $items = \Excel::toCollection(new CodesImport(), $request->file('excel'))->toArray()[0];
            $goods = $this->repository->getByCodes(array_column($items, 0));
            $counts = [];

            foreach ($items as [$sku, $qty]) {
                $good = $goods->where('sku', $sku)->first();
                if ($good === null) {
                    continue;
                }

                $counts[$good->id] = $qty;
            }
        } else if ($request->filled(['goods', 'counts'])) {
            $skus = explode("\n", $request->input('goods'));
            $goods = $this->repository->getByCodes($skus);

            $countsRaw = explode("\n", $request->input('counts'));
            $counts = [];
            for ($i = 0, $iMax = count($countsRaw); $i < $iMax; $i++) {
                $sku = $skus[$i];
                $good = $goods->where('sku', $sku)->first();
                if ($good === null) {
                    continue;
                }

                $counts[$good->id] = $countsRaw[$i];
            }
        }

        return inertia('Order/Codes', [
            'data' => [
                'goods' => $goods ?? [],
                'counts' => $counts ?? []
            ]
        ]);
    }

    public function create(OrderRequest $request): RedirectResponse
    {
        $user = \Auth::user();
        $order = null;

        \DB::transaction(function () use ($request, $user, &$order) {

            \Cart::restore($user->id);

            $order = $user->orders()->create(array_merge($request->validated(), [
                'total' => \Cart::total(),
                'qty' => \Cart::count(),
                'weight' => \Cart::weightFloat(),
                'volume' => \Cart::content()->reduce(fn($carry, CartItem $i) => $carry + $i->model->volume * $i->qty, 0)
            ]));

            $items = [];
            \Cart::content()->each(function (CartItem $item) use (&$items) {
                /* @var $model Good */
                $model = $item->model;
                $items[$model->id] = [
                    'qty' => $item->qty,
                    'price' => $item->price,
                    'weight' => $item->weight,
                    'volume' => $model->volume,
                ];
            });

            $order->goods()->sync($items);

            \Cart::erase(\Auth::id());
            \Cart::destroy();
        });

        \Excel::store(new OrderGoodsExport($order->goods), "exports/order-$order->id.xlsx");
        \PDF::loadView('account::order-mail', compact('user', 'order'))->save(storage_path("app/pdf/order-$order->id.pdf"));

        $user->notify(new NewOrder($order));
        $user->shippingPoint->users->each(fn(User $u) => $user->notify(new NewOrder($order, true)));

        return redirect()->route('account.order')->with(['toast' => ['text' => 'Ваш заказ был отправлен.']]);
    }
}
