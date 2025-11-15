<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlaimMetode extends Model
{
    use HasFactory;

    protected $table = 'klaim_metode';
    protected $fillable = ['dosen_id', 'id_mk', 'id_metode', 'id_semester', 'tahun_ajaran'];
}
