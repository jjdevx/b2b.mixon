<?php

namespace Modules\Account\Http\Controllers\Order;

use App\Models\Good;
use App\Models\Order;
use Gloudemans\Shoppingcart\CartItem;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Modules\Account\Exports\CartGoodsExport;
use Modules\Account\Http\Controllers\Controller;
use Modules\Account\Repositories\GoodRepository;

class CartController extends Controller
{
    public function page(GoodRepository $repository): Response
    {
        $this->seo()->setTitle('Корзина');

        $user = \Auth::user();

        \Cart::restore($user->id);

        $goods = \Cart::content()->map(function (CartItem $item) use ($repository, $user) {
            /* @var $model Good */
            $model = $repository->calculateSale($item->model, $user);
            return [
                'id' => $item->id,
                'row' => $item->rowId,
                'sku' => $model->sku,
                'name' => $item->name,
                'qty' => $item->qty,
                'price' => $model->rrp,
                'discount' => $model->discount,
                'salePrice' => $item->price,
                'total' => $item->total,
                'weight' => $item->weight,
                'volume' => $model->volume
            ];
        });
        \Cart::store($user->id);

        $volume = round($goods->reduce(fn($carry, $good) => $carry + $good['volume'] * $good['qty'], 0), 3);

        return inertia('Order/Cart', [
            'data' => [
                'goods' => $goods->values(),
                'billing' => Order::$billing,
                'types' => Order::$types,
                'rrp' => round($goods->reduce(fn($carry, $good) => $carry + $good['price'] * $good['qty'], 0), 2),
                'total' => \Cart::total(),
                'qty' => \Cart::count(),
                'weight' => \Cart::weight(),
                'volume' => $volume
            ]
        ]);
    }

    public function plus(string $row, bool $minus = false): RedirectResponse
    {
        $id = \Auth::id();
        \Cart::restore($id);
        \Cart::update($row, \Cart::get($row)->qty + (!$minus ? 1 : -1));
        \Cart::store($id);

        return back()->with(['toast' => ['text' => 'Количество товара было увеличено.']]);
    }

    public function minus(string $row): RedirectResponse
    {
        $this->plus($row, true);

        return back()->with(['toast' => ['text' => 'Количество товара было уменьшено.']]);
    }

    public function clear(): RedirectResponse
    {
        \Cart::restore(\Auth::id());
        \Cart::erase(\Auth::id());
        \Cart::destroy();

        return redirect()->route('account.order')->with(['toast' => ['text' => 'Корзина была очищена.']]);
    }

    public function remove(string $row): RedirectResponse
    {
        $id = \Auth::id();
        \Cart::restore($id);
        \Cart::remove($row);
        \Cart::store($id);

        return back()->with(['toast' => ['text' => 'Товар был удален.']]);
    }

    public function excel(GoodRepository $repository)
    {
        $user = \Auth::user();

        \Cart::restore($user->id);

        $goods = \Cart::content()->map(function (CartItem $item) use ($repository, $user) {
            /* @var $model Good */
            $model = $repository->calculateSale($item->model, $user);
            return [
                'id' => $item->id,
                'row' => $item->rowId,
                'sku' => $model->sku,
                'name' => $item->name,
                'qty' => $item->qty,
                'price' => $model->rrp,
                'discount' => $model->discount,
                'salePrice' => $item->price,
                'total' => $item->total,
                'weight' => $item->weight,
                'volume' => $model->volume
            ];
        });
        \Cart::store($user->id);

        return \Excel::download(new CartGoodsExport($goods), 'cart.xlsx');
    }
}
