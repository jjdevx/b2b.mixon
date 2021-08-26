<?php

namespace Modules\Account\Http\Resources;

use App\Models\Goods\Category;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Category */
class CategoryResource extends JsonResource
{
    public function toArray($request = null)
    {
        /* @var $category Category */
        $category = $this->resource;

        return [
            'groupId' => $category->group_id,
            'id' => $category->id,
            'name' => $category->name,
            'saleSmall' => $category->sale_small,
            'sale' => $category->sale,
            'saleBig' => $category->sale_big,
            'createdAt' => $category->created_at,
            'updatedAt' => $category->updated_at,
        ];
    }
}
