<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomponenPenilaian extends Model
{
    use HasFactory;

    protected $table = 'komponen_penilaian';
    public $timestamps = false;

    protected $fillable = [
        'klaim_metode_id',
        'nama',
        'persentase',
    ];

    public function klaimMetode()
    {
        return $this->belongsTo(KlaimMetode::class, 'klaim_metode_id');
    }
}