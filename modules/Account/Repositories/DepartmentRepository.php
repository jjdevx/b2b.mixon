<?php

namespace Modules\Account\Repositories;

use App\Models\Department;

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
}
