<?php

namespace Modules\Account\Repositories;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class DepartmentRepository
{
    public function findById(int $id): Department
    {
        return Department::withTrashed()->findOrFail($id);
    }

    public function getDepartmentsForIndex(\Closure $scope = null): array
    {
        $all = Department::when($scope, fn($q) => $scope($q))->get();

        $branches = $all->where('type', 'branch');
        $offices = $all->where('type', 'office');
        $shops = $all->where('type', 'shop');

        return compact('branches', 'offices', 'shops');
    }

    public function getUsers(): Collection
    {
        return User::whereHas('roles', fn(Builder $q) => $q->where('name', '=', 'manager'))
            ->get(['id', 'name', 'surname'])
            ->append('full_name')
            ->map(fn(User $u) => ['value' => $u->id, 'label' => $u->full_name]);
    }

    public function getTypes(): Collection
    {
        return collect(Department::$types)->map(fn($value, $key) => ['value' => $key, 'label' => $value]);
    }
}
