<?php

namespace Modules\Account\Repositories;

use App\Models\Goods\Category;
use App\Models\Goods\Group;
use Illuminate\Support\Collection;

class CategoryRepository
{
    public function findById(int $id): Category
    {
        return Category::findOrFail($id);
    }

    public function getCategoriesForIndex(): Collection
    {
        return Category::all();
    }

    public function getGroups(): array
    {
        return Group::all(['id', 'name'])
            ->map(fn(Group $g) => ['value' => $g->id, 'label' => $g->name])
            ->values()
            ->toArray();
    }
}
