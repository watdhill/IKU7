<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fakultas;

class FakultasSeeder extends Seeder
{
    public function run(): void
    {
        Fakultas::insert([
            [
                'kode_fakultas'   => 'FTI',
                'nama_fakultas'   => 'Fakultas Teknologi Informasi',
                'source'          => 'manual',
                'created_at'      => now(),
            ],
            [
                'kode_fakultas'   => 'FISIP',
                'nama_fakultas'   => 'Fakultas Ilmu Sosial dan Politik',
                'source'          => 'manual',
                'created_at'      => now(),
            ],
            [
                'kode_fakultas'   => 'FKep',
                'nama_fakultas'   => 'Fakultas Keperawatan',
                'source'          => 'manual',
                'created_at'      => now(),
            ],
        ]);
    }
}
