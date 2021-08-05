<?php

namespace Modules\Account\Http\Resources;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Department */
class DepartmentResource extends JsonResource
{
    public function toArray($request = null)
    {
        /* @var $department Department */
        $department = $this->resource;

        return [
            'id' => $department->id,
            'name' => $department->name,
            'createdAt' => $department->created_at,
            'updatedAt' => $department->updated_at,
            'users' => $department->users->map(fn(User $u) => ['id' => $u->id, 'name' => $u->full_name])
        ];
    }
}
