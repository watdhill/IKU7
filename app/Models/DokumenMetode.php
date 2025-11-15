<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenMetode extends Model
{
    use HasFactory;

    protected $table = 'dokumen_metode';
    protected $fillable = ['klaim_metode_id', 'nama_dokumen', 'file_path', 'uploaded_at'];
}
