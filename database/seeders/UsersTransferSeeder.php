<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTransferSeeder extends Seeder
{
    public function run(): void
    {
        \DB::transaction(function () {
            $users = collect(json_decode(file_get_contents(resource_path('db/users.json')), true));
            $users->each(function (array $data) {
                $name = explode(' ', $data['name']);
                if (count($name) === 2) {
                    [$name, $surname] = $name;
                } else {
                    $name = $data['name'];
                }
                $user = User::create([
                    'id' => $data['id'],
                    'email' => $data['email'],
                    'password' => \Hash::make($data['password']),
                    'company' => $data['company'] ?? null,
                    'name' => $name ?? null,
                    'surname' => $surname ?? '',
                    'address' => $data['address'] ?? null,
                    'phone' => $data['phone'] ?? null,
                    'okpo' => isset($data['okpo']) && $data['okpo'] !== 0 ? $data['okpo'] : null,
                    'country' => 'Украина'
                ]);
                $user->markEmailAsVerified();
                $user->assignRole('user');
            });
        });
    }
}
