<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MataKuliah;

class MataKuliahSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // Prodi Sistem Informasi
            ['departemen_id' => 1, 'semester_id' => 1, 'nama' => 'Basis Data'],
            ['departemen_id' => 1, 'semester_id' => 1, 'nama' => 'Pemrograman'],
            ['departemen_id' => 1, 'semester_id' => 2, 'nama' => 'Jaringan Komputer'],

            // Prodi Informatika
            ['departemen_id' => 2, 'semester_id' => 1, 'nama' => 'Algoritma'],
            ['departemen_id' => 2, 'semester_id' => 2, 'nama' => 'Arsitektur Komputer'],

            // Prodi Manajemen
            ['departemen_id' => 3, 'semester_id' => 1, 'nama' => 'Pengantar Manajemen'],

            // Prodi Akuntansi
            ['departemen_id' => 4, 'semester_id' => 2, 'nama' => 'Akuntansi Dasar'],
        ];

        foreach ($data as $item) {
            MataKuliah::create($item);
        }
    }
}
