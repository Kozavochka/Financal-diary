<?php

namespace Database\Seeders;

use App\Models\Direction;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()
            ->create([
                'name' => 'Admin',
                'email' => env('USER_EMAIL_SEEDER'),
                'password' => bcrypt(env('USER_PASSWORD_SEEDER')),
                'role' => 'admin'
            ]);
    }
}
