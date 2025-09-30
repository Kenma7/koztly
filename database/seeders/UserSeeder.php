<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Test User',
            'username' => 'testuser123',
            'gender' => 'pria',
            'email' => 'testuser123@example.com',
            'phone_number' => '08123456789',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Optional: Buat admin juga
        DB::table('users')->insert([
            'name' => 'Admin',
            'username' => 'admin',
            'gender' => 'pria',
            'email' => 'admin@example.com',
            'phone_number' => '08123456780',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}