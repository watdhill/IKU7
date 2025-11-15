<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Semester;
use App\Models\Fakultas; // Tambahkan ini jika Anda perlu Fakultas

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan Model Semester sudah terdefinisi
        
        $semesters = [
            ['nama_semester' => 'Semester 1'],
            ['nama_semester' => 'Semester 2'],
            ['nama_semester' => 'Semester 3'],
            ['nama_semester' => 'Semester 4'],
            ['nama_semester' => 'Semester 5'],
            ['nama_semester' => 'Semester 6'],
            ['nama_semester' => 'Semester 7'],
            ['nama_semester' => 'Semester 8'],
        ];

        foreach ($semesters as $semester) {
            Semester::firstOrCreate(
                ['nama_semester' => $semester['nama_semester']],
                $semester
            );
        }
    }
}