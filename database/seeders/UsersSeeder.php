<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $adminEmail = env('INITIAL_USER_EMAIL');

        if (!User::where('email', '=', $adminEmail)->exists()) {
            [$name, $surname] = explode(' ', env('INITIAL_USER_NAME'));
            $user = new User([
                'name' => $name,
                'surname' => $surname,
                'email' => $adminEmail,
                'password' => env('INITIAL_USER_PASSWORDHASH'),
            ]);
            $user->save();
            $user->assignRole('admin');
        } else {
            $this->command->getOutput()->progressStart(10);

            User::factory()->count(10)->create()->each(function (User $user) {
                $user->assignRole(random_int(0, 1) ? 'user' : 'manager');
                $user->addMediaFromUrl('https://i.pravatar.cc/225')->toMediaCollection('avatar');

                $this->command->getOutput()->progressAdvance();
            });

            $this->command->getOutput()->progressFinish();
        }
    }
}
