<?php

namespace Modules\Account\Http\Controllers\Order;

use App\Models\Good;
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
                'sku' => $model->sku,
                'name' => $item->name,
                'price' => $item->price,
                'total' => $item->total,
                'weight' => $item->weight
            ];
        });
        \Cart::store($user->id);

        return inertia('Order/Cart', [
            'data' => [
                'goods' => $goods->values(),
                'totals' => \Cart::total(),
                'subtotal' => \Cart::subtotal(),
                'priceTotal' => \Cart::priceTotal()
            ]
        ]);
    }

    public function clear(): RedirectResponse
    {
        \Cart::restore(\Auth::id());
        \Cart::erase(\Auth::id());

        return redirect()->route('account.order')->with(['toast' => ['text' => 'Корзина была очищена.']]);
    }
}
