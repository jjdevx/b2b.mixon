<?php

namespace Modules\Account\Http\Controllers\Stock;

use App\Models\Department;
use App\Models\Good;
use App\Models\Goods\Category;
use App\Models\Goods\Group;
use Carbon\Carbon;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Modules\Account\Http\Controllers\Controller;
use Modules\Account\Http\Requests\StockSearchRequest;

class StockViewController extends Controller
{
    public function view(Department $department = null, Group $group = null, Category $category = null): InertiaResponse
    {
        $this->seo()->setTitle('Просмотр наличия');
        $user = \Auth::user();

        if ($user->hasAnyRole('manager', 'admin')) {
            $departments = Department::whereIn('type', [Department::BRANCH, Department::SHOP])->get(['id', 'name']);
        } else {
            $departments = [$user->shippingPoint];
        }

        $categories = $user->hasRole('admin')
            ? Category::all(['id', 'name'])
            : $user->availableCategories()->get(['id', 'name']);

        $groups = Group::whereHas('categories', fn($q) => $q->whereIn('id', $categories->pluck('id')))->get(['id', 'name']);

        if ($group) {
            $categories = $group->categories()->whereIn('id', $categories->pluck('id'))->get();
        }

        abort_if(
            $category && !$categories->contains($category->id),
            403,
            'Вы не имеете права просматривать эту категорию товаров.'
        );

        $goods = [];
        if ($department && $category) {
            $goods = Good::where('category_id', '=', $category->id)
                ->with(['stocks' => fn($q) => $q->where('department_id', '=', $department->id)])
                ->get(['sku', 'name'])
                ->map(function (Good $good) {
                    $good->stock = $good->stocks[0]?->pivot->qty ?? 0;
                    return $good;
                });
        }

        $stockLastUpdate = $department?->stock_updated_at
            ? (new Carbon($department->stock_updated_at))->toDateTimeString()
            : null;

        return inertia('Stock/View', [
            'data' => [
                'departments' => $departments,
                'department' => $department?->id,
                'groups' => $groups,
                'group' => $group?->id,
                'categories' => $group ? $categories : null,
                'category' => $category?->id,
                'goods' => $goods,
                'stockLastUpdate' => $stockLastUpdate,
            ]
        ]);
    }

    public function search(StockSearchRequest $request): InertiaResponse
    {
        $this->seo()->setTitle('Просмотр наличия по коду');

        if ($sku = $request->input('sku')) {
            $goodsBySku = Department::with([
                'goods' => fn($q) => $q->where('goods.sku', '=', $sku)
                    ->select(['name'])
                    ->withPivot('qty')
            ])
                ->where(function ($query) {
                    $user = \Auth::user();
                    if ($user->hasRole('user') && !$user->hasRole('manager')) {
                        $query->where('id', '=', $user->shipping_point);
                        if (!$user->shipping_point) {
                            Inertia::share('flash', [
                                'text' => 'Ваш аккаунт не подключен ни к одной точке отгрузки. Обратитесь к администратору.',
                                'icon' => 'warning',
                            ]);
                        }
                    }
                })
                ->get(['id', 'name', 'stock_updated_at'])
                ->filter(fn(Department $d) => $d->goods->isNotEmpty())
                ->map(function (Department $department) use ($sku) {
                    $data = $department->toArray();
                    $good = $data['goods'][0];

                    $data['date'] = Carbon::createFromTimestamp($data['stock_updated_at'])->toDateTimeString();
                    $data['sku'] = $sku;
                    $data['good'] = $good['name'];
                    $data['stock'] = $good['pivot']['qty'];
                    unset($data['goods']);

                    return $data;
                });
        }

        if ($name = $request->input('name')) {
            $goodsByName = Good::where('name', 'like', "%$name%")
                ->orWhere('name', 'like', "$name%")
                ->get(['id', 'sku', 'name']);
        }

        return inertia('Stock/Search', [
            'data' => [
                'sku' => $sku,
                'goodsBySku' => isset($goodsBySku) ? $goodsBySku->values() : [],
                'name' => $name,
                'goodsByName' => isset($goodsByName) ? $goodsByName->values() : []
            ]
        ]);
    }
}
