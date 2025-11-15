<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    use HasFactory;

    protected $table = 'fakultas';
    
    // MENAMBAH BARIS INI: Menonaktifkan timestamps agar tidak mencari kolom created_at/updated_at
    public $timestamps = false; 

    protected $fillable = [
        'kode_fakultas',
        'nama_fakultas',
        'source'
    ];
}