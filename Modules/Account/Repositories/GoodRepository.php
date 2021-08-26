<?php

namespace Modules\Account\Repositories;

use App\Models\Good;
use App\Models\Goods\Category;
use App\Models\User;
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
            ->map(fn(Good $g) => $this->calculateSale($g->setRelation('category', $category), $user));
    }

    public function calculateSale(Good $good, User $user): Good
    {
        $good->stock = $good->stocks[0]?->pivot->qty ?? 0;
        $salePrice = $good->rrp;
        if (($saleType = $user->sale_type) && $sale = $good->category->getAttribute($saleType)) {
            $salePrice *= 1 - $sale / 100;
        }

        $good->salePrice = number_format($salePrice, 2, '.', '');
        return $good;
    }
}
