<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserRoleSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk membuat akun dengan role berbeda.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Rektorat Admin',
            'email' => 'rektorat@example.com',
            'password' => Hash::make('12345678'),
            'role' => 'rektorat',
        ]);

        User::create([
            'name' => 'Fakultas Admin',
            'email' => 'fakultas@example.com',
            'password' => Hash::make('12345678'),
            'role' => 'fakultas',
        ]);

        User::create([
            'name' => 'Dosen Utama',
            'email' => 'dosen@example.com',
            'password' => Hash::make('12345678'),
            'role' => 'dosen',
        ]);
    }
}
