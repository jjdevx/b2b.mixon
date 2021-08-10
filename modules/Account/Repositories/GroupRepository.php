<?php

namespace Modules\Account\Repositories;

use App\Models\Goods\Group;
use Illuminate\Support\Collection;

class GroupRepository
{
    public function findById(int $id): Group
    {
        return Group::findOrFail($id);
    }

    public function getGroupsForIndex(): Collection
    {
        return Group::all();
    }
}
