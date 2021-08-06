<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{

    public function run(): void
    {
        $crudPermissions = ['index', 'create', 'edit', 'delete'];
        $trashPermissions = ['trash', 'restore', 'force-delete'];

        $sections = [
            'account' => [
                'name' => 'Админ-панель',
                'permissions' => ['access', 'telescope'],
            ],
            'users' => [
                'name' => 'Пользователи',
                'permissions' => [...$crudPermissions, ...$trashPermissions],
            ],
            'departments' => [
                'name' => 'Отделы',
                'permissions' => [...$crudPermissions, ...$trashPermissions],
            ],
        ];

        foreach ($sections as $key => $section) {
            foreach ($section['permissions'] as $permission) {
                $name = "$key.$permission";
                if (Permission::where('name', $name)->first() === null) {
                    Permission::create(['name' => $name]);
                }
            }
        }

        $roles = [
            'admin' => [
                'label' => 'Админ',
                'permissions' => Permission::all()->pluck('name')
            ],
            'manager' => [
                'label' => 'Менеджер',
                'permissions' => []
            ],
            'user' => [
                'label' => 'Пользователь',
                'permissions' => ['account.access']
            ]
        ];

        foreach ($roles as $key => $data) {
            if (!($role = Role::where('name', '=', $key)->first())) {
                $role = new Role(['name' => $key, 'label' => $data['label']]);
                $role->save();
            }
            if (isset($data['permissions'])) {
                $permissions = $data['permissions'];
                $role->syncPermissions($permissions);
            }
        }
    }
}
