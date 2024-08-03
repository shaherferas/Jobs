<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Manager User',
            'email' => 'manager@tech.com',
            'password' => bcrypt('password'),
            'role' => 'manager',
        ]);

        User::create([
            'name' => 'Regular User',
            'email' => 'user@tech.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);
    }
}
