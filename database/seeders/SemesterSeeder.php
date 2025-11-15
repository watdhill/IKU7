<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Semester;

class SemesterSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Ganjil'],
            ['nama' => 'Genap'],
        ];

        foreach ($data as $item) {
            Semester::create($item);
        }
    }
}
