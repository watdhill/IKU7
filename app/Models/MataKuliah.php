<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    protected $table = 'mata_kuliah';
    
    // Menonaktifkan timestamps karena tabel tidak memiliki kolom updated_at/created_at
    public $timestamps = false; 

    protected $fillable = [
        'kode_mk',       
        'nama_mk',       
        'id_departemen', // KOREKSI: Menggunakan id_departemen
        'id_semester',   // KOREKSI: Menggunakan id_semester
        'sks',           
        'dosen_pengampu', // Kolom ini ada di skema Anda
        'source',
    ];
}