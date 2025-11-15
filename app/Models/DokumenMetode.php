<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenMetode extends Model
{
    use HasFactory;

    protected $table = 'dokumen_metode';
    public $timestamps = false;

    protected $fillable = [
        'klaim_metode_id',
        'nama_file',
        'path_file',
    ];

    public function klaimMetode()
    {
        return $this->belongsTo(KlaimMetode::class, 'klaim_metode_id');
    }
}