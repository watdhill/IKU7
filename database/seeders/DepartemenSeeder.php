<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Departemen;

class DepartemenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Fakultas ID 1
            ['id_fakultas' => 1, 'nama_departemen' => 'Sistem Informasi', 'kode_departemen' => 'SI', 'source' => 'Seeder'],
            ['id_fakultas' => 1, 'nama_departemen' => 'Informatika', 'kode_departemen' => 'INF', 'source' => 'Seeder'],

            // Fakultas ID 2
            ['id_fakultas' => 2, 'nama_departemen' => 'Manajemen', 'kode_departemen' => 'MNJ', 'source' => 'Seeder'],
            ['id_fakultas' => 2, 'nama_departemen' => 'Akuntansi', 'kode_departemen' => 'AKT', 'source' => 'Seeder'],

            // Fakultas ID 3
            ['id_fakultas' => 3, 'nama_departemen' => 'Hukum Perdata', 'kode_departemen' => 'HP', 'source' => 'Seeder'],
            ['id_fakultas' => 3, 'nama_departemen' => 'Hukum Pidana', 'kode_departemen' => 'HPD', 'source' => 'Seeder'],
        ];

        foreach ($data as $item) {
            // Menggunakan firstOrCreate untuk memastikan semua kolom fillable terisi dan menghindari duplikasi.
            Departemen::firstOrCreate(
                ['nama_departemen' => $item['nama_departemen']],
                $item
            );
        }
    }
}