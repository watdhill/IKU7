<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlaimMetode extends Model
{
    use HasFactory;

    protected $table = 'klaim_metode';
    protected $fillable = [
        'fakultas_id',
        'departemen_id',
        'semester_id',
        'mata_kuliah_id',
        'metode_id',
        'tahun_ajaran',
        'dosen_id', // Asumsi ada field dosen_id dari user yang mengklaim
        'status', // Contoh: pending, disetujui, ditolak
    ];

    // Relasi
    public function dosen() { return $this->belongsTo(User::class, 'dosen_id'); }
    public function metode() { return $this->belongsTo(Metode::class, 'metode_id'); }
    public function mataKuliah() { return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id'); }
    public function komponenPenilaian() { return $this->hasMany(KomponenPenilaian::class, 'klaim_metode_id'); }
    public function dokumenMetode() { return $this->hasMany(DokumenMetode::class, 'klaim_metode_id'); }
}