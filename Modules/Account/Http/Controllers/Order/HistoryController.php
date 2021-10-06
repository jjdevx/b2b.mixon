<?php

namespace Modules\Account\Http\Controllers\Order;

use App\Models\Department;
use App\Models\Goods\Category;
use App\Models\Goods\Group;
use App\Models\Order;
use App\Models\User;
use Inertia\Response as InertiaResponse;
use Modules\Account\Http\Controllers\Controller;
use Modules\Account\Http\Requests\IndexRequest;
use Modules\Account\Http\Resources\OrderCollection;

final class HistoryController extends Controller
{
    public function page(IndexRequest $request): InertiaResponse
    {
        $this->seo()->setTitle('История заказов');

        $paginationCount = 20;

        $user = \Auth::user();
        $orders = $user->orders()->with('user')->withCount('goods')->orderByDesc('id')->paginate($paginationCount);

        if ($user->hasRole('admin')) {
            $orders = Order::with('user')->withCount('goods')->orderByDesc('id')->paginate($paginationCount);
        } else if ($department = $this->getDepartment()) {
            $orders = Order::with('user')
                ->whereHas('user', fn($q) => $q->whereHas('departments', fn($d) => $d->where('id', $department->id)))
                ->withCount('goods')
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

    private function getDepartment(): Department
    {
        return \Auth::user()->departments()->first();
    }
}
