<?php

namespace Modules\Account\Http\Controllers\Order;

use App\Models\Good;
use App\Models\Order;
use Gloudemans\Shoppingcart\CartItem;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Modules\Account\Http\Controllers\Controller;

class CartController extends Controller
{
    public function page(): Response
    {
        $this->seo()->setTitle('Корзина');

        $user = \Auth::user();

        \Cart::restore($user->id);

        $goods = \Cart::content()->map(function (CartItem $item) {
            /* @var $model Good */
            $model = $item->model;
            return [
                'id' => $item->id,
                'row' => $item->rowId,
                'sku' => $model->sku,
                'name' => $item->name,
                'qty' => $item->qty,
                'price' => $item->price,
                'total' => $item->total,
                'weight' => $item->weight
            ];
        });
        \Cart::store($user->id);

        return inertia('Order/Cart', [
            'data' => [
                'goods' => $goods->values(),
                'billing' => Order::$billing,
                'types' => Order::$types,
                'total' => \Cart::total(),
                'qty' => \Cart::count(),
                'weight' => \Cart::weight(),
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
}
