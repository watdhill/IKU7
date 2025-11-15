<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Departemen;

class DepartemenSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['fakultas_id' => 1, 'nama' => 'Sistem Informasi'],
            ['fakultas_id' => 1, 'nama' => 'Informatika'],

            ['fakultas_id' => 2, 'nama' => 'Manajemen'],
            ['fakultas_id' => 2, 'nama' => 'Akuntansi'],

            ['fakultas_id' => 3, 'nama' => 'Hukum Perdata'],
            ['fakultas_id' => 3, 'nama' => 'Hukum Pidana'],
        ];

        foreach ($data as $item) {
            Departemen::create($item);
        }
    }
}
