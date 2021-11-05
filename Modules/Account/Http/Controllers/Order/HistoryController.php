<?php

namespace Modules\Account\Http\Controllers\Order;

use App\Models\Department;
use App\Models\Good;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Inertia\Response as InertiaResponse;
use Modules\Account\Http\Controllers\Controller;
use Modules\Account\Http\Requests\IndexRequest;
use Modules\Account\Http\Resources\OrderCollection;
use Modules\Account\Repositories\GoodRepository;

final class HistoryController extends Controller
{
    public function __construct(private GoodRepository $repository)
    {

    }

    public function index(IndexRequest $request): InertiaResponse
    {
        $this->seo()->setTitle('История заказов');

        $paginationCount = 20;

        $user = \Auth::user();
        $orders = $user->orders()->with('user')->orderByDesc('id')->paginate($paginationCount);

        if ($user->hasRole('admin')) {
            $orders = Order::with('user')->orderByDesc('id')->paginate($paginationCount);
        } else if ($department = $this->getDepartment()) {
            $orders = Order::with('user')
                ->whereHas('user', fn($q) => $q->whereHas('departments', fn($d) => $d->where('id', $department->id)))
                ->orderByDesc('id')
                ->paginate($paginationCount);
        }

        return inertia('Order/History', [
            'data' => [
                'paginator' => (new OrderCollection($orders))->toArray(),
                'table' => array_merge($request->only(['searchQuery', 'sortBy',]), [
                    'sortDesc' => (int)$request->input('sortDesc')
                ]),
            ]
        ]);
    }

    public function show(Order $order): InertiaResponse
    {
        $this->seo()->setTitle("Заказ {$order->id}");

        $user = \Auth::user();

        abort_unless($order->user_id === $user->id || $user->hasRole(['admin', 'manager']), 403);

        $order->load(['user', 'goods']);
        $order->billing = Order::$billing[$order->billing];
        $order->type = Order::$types[$order->type];

        return inertia('Order/Show', ['data' => ['order' => $order]]);
    }

    public function repeat(Order $order): RedirectResponse
    {
        $user = \Auth::user();

        foreach ($order->goods as $good) {
            $goodWithSale = $this->repository->calculateSale(Good::find($good->id), $user);
            \Cart::add($goodWithSale, $good->pivot->qty);
        }

        return redirect()->route('account.cart')->with(['toast' => ['text' => 'Товары были добавлены.']]);
    }

    private function getDepartment(): ?Department
    {
        return \Auth::user()->departments()->first();
    }
}
