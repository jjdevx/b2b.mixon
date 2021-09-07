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
            ->get(['id', 'sku', 'name', 'rrp', 'weight', 'volume'])
            ->map(fn(Good $g) => $this->calculateSale($g->setRelation('category', $category), $user));
    }

    public function calculateSale(Good $good, User $user): Good
    {
        $category = $good->category;
        $good->stock = $good->stocks[0]?->pivot->qty ?? 0;

        $salePrice = $good->rrp;
        $discount = 0;

        if ($sale = $user->sales()->where('id', '=', $category->id)->first()) {
            $discount = (float)$sale->pivot->size / 100;
        } else if (($saleType = $user->sale_type) && $sale = $category->getAttribute($saleType)) {
            $discount = $sale / 100;
        }

        $salePrice *= 1 - $discount;

        $good->salePrice = number_format($salePrice, 2, '.', '');
        $good->discount = $discount * 100;
        return $good;
    }
}
