<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'rektorat@example.com'],
            [
                'name' => 'Rektorat Admin',
                'password' => Hash::make('12345678'),
                'role' => 'rektorat',
            ]
        );

        User::firstOrCreate(
            ['email' => 'fakultas@example.com'],
            [
                'name' => 'Fakultas Admin',
                'password' => Hash::make('12345678'),
                'role' => 'fakultas',
            ]
        );

        User::firstOrCreate(
            ['email' => 'dosen@example.com'],
            [
                'name' => 'Dosen Utama',
                'password' => Hash::make('12345678'),
                'role' => 'dosen',
            ]
        );
    }
}
