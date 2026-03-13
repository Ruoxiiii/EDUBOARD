<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Admin User',
            'email' => 'admin@eduboard.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        \App\Models\User::create([
            'name' => 'Teacher User',
            'email' => 'teacher@eduboard.com',
            'password' => bcrypt('password'),
            'role' => 'teacher',
        ]);

        \App\Models\User::create([
            'name' => 'Student User',
            'email' => 'student@eduboard.com',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);
    }
}
