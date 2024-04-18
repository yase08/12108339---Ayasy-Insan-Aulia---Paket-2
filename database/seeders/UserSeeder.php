<?php

namespace Database\Seeders;

// use Illuminate\User\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@localhost',
            'password' => bcrypt('admin'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Staff',
            'email' => 'staff@localhost',
            'password' => bcrypt('staff'),
            'role' => 'staff',
        ]);
    }
}
