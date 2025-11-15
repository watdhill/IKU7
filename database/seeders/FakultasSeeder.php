<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fakultas; // Pastikan model Fakultas sudah diimport

class FakultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Pastikan hanya kolom fillable yang disertakan
            ['kode_fakultas' => 'FTI', 'nama_fakultas' => 'Fakultas Teknologi Informasi', 'source' => 'manual'],
            ['kode_fakultas' => 'FISIP', 'nama_fakultas' => 'Fakultas Ilmu Sosial dan Politik', 'source' => 'manual'],
            ['kode_fakultas' => 'FKep', 'nama_fakultas' => 'Fakultas Keperawatan', 'source' => 'manual'],
            // Tambahkan data fakultas lainnya di sini
        ];

        foreach ($data as $item) {
            // Gunakan updateOrCreate untuk menghindari duplikasi saat seeding
            Fakultas::updateOrCreate(
                ['kode_fakultas' => $item['kode_fakultas']], // Kriteria unik
                $item // Data untuk diisi
            );
        }
    }
}