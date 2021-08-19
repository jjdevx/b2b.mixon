<?php

namespace Modules\Account\Http\Controllers\Stock;

use App\Models\Department;
use App\Models\Good;
use App\Models\Goods\Category;
use Carbon\Carbon;
use Inertia\Response as InertiaResponse;
use Modules\Account\Http\Controllers\Controller;

class StockViewController extends Controller
{
    public function index(Department $department = null, Category $category = null): InertiaResponse
    {
        $this->seo()->setTitle('Просмотр наличия');

        $departments = Department::whereIn('type', [Department::BRANCH, Department::SHOP])->get(['id', 'name']);
        $categories = \Auth::user()->availableCategories()->get(['id', 'name']);

        abort_if(
            $category && !$categories->contains($category->id), 403, 'Вы не имеете права просматривать эту категорию товаров.'
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
                'categories' => $categories,
                'category' => $category?->id,
                'goods' => $goods,
                'stockLastUpdate' => $stockLastUpdate,
            ]
        ]);
    }
}
