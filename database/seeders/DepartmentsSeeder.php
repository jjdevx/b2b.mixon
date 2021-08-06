<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Seeder;

class DepartmentsSeeder extends Seeder
{
    public function run(): void
    {
        Department::factory()->count(10)->create()->each(function (Department $department) {
            $department->users()->saveMany(
                User::whereHas('roles', fn(Builder $q) => $q->where('name', '=', 'manager'))
                    ->whereDoesntHave('departments')
                    ->inRandomOrder()
                    ->limit(random_int(1, 4))
                    ->get()
            );
        });
    }
}
