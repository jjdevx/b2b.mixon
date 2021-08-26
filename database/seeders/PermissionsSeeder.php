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
            'groups' => [
                'name' => 'Группы',
                'permissions' => [...$crudPermissions],
            ],
            'categories' => [
                'name' => 'Категории',
                'permissions' => [...$crudPermissions, 'sales.update'],
            ],
            'stocks' => [
                'name' => 'Остатки',
                'permissions' => ['update', 'view', 'search'],
            ],
            'goods' => [
                'name' => 'Товары',
                'permissions' => ['update'],
            ],
            'order' => [
                'name' => 'Заказ',
                'permissions' => ['make'],
            ]
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
                'permissions' => ['stocks.update', 'stocks.view', 'stocks.search', 'goods.update']
            ],
            'user' => [
                'label' => 'Пользователь',
                'permissions' => ['account.access', 'stocks.search']
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
