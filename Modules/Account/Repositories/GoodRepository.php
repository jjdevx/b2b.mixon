<?php

namespace Modules\Account\Repositories;

use App\Models\Good;
use App\Models\Goods\Category;
use Illuminate\Support\Collection;

class GoodRepository
{
    public function getByCategory(Category $category): Collection
    {
        $user = \Auth::user();
        $department = $user->shippingPoint;

        if ($department === null) {
            abort(403);
        }

        return Good::where('category_id', '=', $category->id)
            ->with(['stocks' => fn($q) => $q->where('department_id', '=', $department->id)])
            ->get(['id', 'sku', 'name', 'rrp', 'weight'])
            ->map(function (Good $good) use ($category, $user) {
                $good->stock = $good->stocks[0]?->pivot->qty ?? 0;
                $salePrice = $good->rrp;
                if (($saleType = $user->sale_type) && $sale = $category->getAttribute($saleType)) {
                    $salePrice *= 1 - $sale / 100;
                }

                $good->salePrice = number_format($salePrice, 2, '.', '');
                return $good;
            });
    }
}
