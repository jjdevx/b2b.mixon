<?php

namespace Modules\Account\Http\Resources;

use App\Models\Department;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Goods\Group */
class GroupResource extends JsonResource
{
    public function toArray($request = null)
    {
        /* @var $group Department */
        $group = $this->resource;

        return [
            'id' => $group->id,
            'name' => $group->name,
            'createdAt' => $group->created_at,
            'updatedAt' => $group->updated_at,
        ];
    }
}
