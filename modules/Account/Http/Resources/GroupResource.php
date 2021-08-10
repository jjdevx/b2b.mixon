<?php

namespace Modules\Account\Http\Resources;

use App\Models\Goods\Group;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Group */
class GroupResource extends JsonResource
{
    public function toArray($request = null)
    {
        /* @var $group Group */
        $group = $this->resource;

        return [
            'id' => $group->id,
            'groupId' => $group->group_id,
            'name' => $group->name,
            'createdAt' => $group->created_at,
            'updatedAt' => $group->updated_at,
        ];
    }
}
