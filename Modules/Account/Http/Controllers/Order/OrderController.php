<?php

namespace Modules\Account\Http\Controllers\Order;

use App\Http\Requests\OrderUpdateRequest;
use App\Models\Good;
use App\Models\Goods\Category;
use Illuminate\Http\RedirectResponse;
use Inertia\Response as InertiaResponse;
use Modules\Account\Http\Controllers\Controller;
use Modules\Account\Repositories\GoodRepository;

final class OrderController extends Controller
{
    public function __construct(private GoodRepository $repository)
    {

    }

    public function page(Category $category = null): InertiaResponse
    {
        $this->seo()->setTitle('Заказ товаров');

        if ($category) {
            $goods = $this->repository->getByCategory($category);
        }

        return inertia('Order/Page', [
            'data' => [
                'categories' => Category::all(['id', 'name']),
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
}
