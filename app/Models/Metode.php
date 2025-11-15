<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metode extends Model
{
    use HasFactory;

    protected $table = 'metode';
    public $timestamps = false;

    protected $fillable = ['kode_metode', 'nama_metode'];

    // Relasi ke KlaimMetode
    public function klaimMetode()
    {
        return $this->hasMany(KlaimMetode::class, 'metode_id');
    }
}