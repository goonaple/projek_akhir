<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Jalankan seeder database.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'username' => 'admin',
            'password' => Hash::make('123456'),
            'role' => 'admin',
        ]);

        // User biasa
        User::create([
            'username' => 'user',
            'password' => Hash::make('123456'),
            'role' => 'user',
        ]);
    }
}
