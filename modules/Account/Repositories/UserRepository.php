<?php

namespace Modules\Account\Repositories;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Models\Role;

class UserRepository
{
    public function findById(int $id): User
    {
        return User::withTrashed()->findOrFail($id);
    }

    public function getUsersForIndex(array $search, \Closure $scope = null): LengthAwarePaginator
    {
        return User::with(['avatarMedia', 'roles'])
            ->when($search['searchQuery'] ?? false, fn(Builder $q) => $q->search($search['searchQuery']))
            ->when($search['sortBy'] ?? false, fn(Builder $q) => $q->orderBy($search['sortBy'], $search['sortDesc'] ?? false ? 'desc' : 'asc'))
            ->when($scope, fn($q) => $scope($q))
            ->paginate($search['perPage'] ?? 10);
    }

    public function getRoles(): array
    {
        return collect(Role::all(['id', 'label'])
            ->map(fn(Role $r) => ['value' => $r->id, 'label' => $r->label]))
            ->values()
            ->toArray();
    }
}
