<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MataKuliah;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Departemen ID 1 (Contoh Sistem Informasi), Semester 1
            [
                'id_departemen' => 1, 
                'id_semester' => 1,   
                'nama_mk' => 'Basis Data',
                'kode_mk' => 'SI101',
                'sks' => 3,
                'dosen_pengampu' => 'Dr. Budi',
                'source' => 'Seeder'
            ],
            // Departemen ID 1 (Contoh Sistem Informasi), Semester 2
            [
                'id_departemen' => 1, 
                'id_semester' => 2,   
                'nama_mk' => 'Pemrograman Web',
                'kode_mk' => 'SI202',
                'sks' => 4,
                'dosen_pengampu' => 'Prof. Ani',
                'source' => 'Seeder'
            ],

            // Departemen ID 2 (Contoh Informatika), Semester 1
            [
                'id_departemen' => 2, 
                'id_semester' => 1,
                'nama_mk' => 'Algoritma & Struktur Data',
                'kode_mk' => 'INF101',
                'sks' => 3,
                'dosen_pengampu' => 'Ibu Sita',
                'source' => 'Seeder'
            ],
            
            // Departemen ID 3 (Contoh Manajemen), Semester 1
            [
                'id_departemen' => 3, 
                'id_semester' => 1,
                'nama_mk' => 'Pengantar Manajemen',
                'kode_mk' => 'MNJ101',
                'sks' => 3,
                'dosen_pengampu' => 'Bpk. Tono',
                'source' => 'Seeder'
            ],
        ];

        foreach ($data as $item) {
            MataKuliah::firstOrCreate(
                ['nama_mk' => $item['nama_mk']],
                $item
            );
        }
    }
}