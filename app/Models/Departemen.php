<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    use HasFactory;

    protected $table = 'departemen';
    
    // MENAMBAH BARIS INI: Memberi tahu Laravel bahwa tabel ini TIDAK memiliki kolom updated_at dan created_at
    public $timestamps = false; 

    // Kolom ini sudah benar dan sesuai dengan yang kita gunakan di seeder:
    // id_fakultas (sebelumnya fakultas_id di seeder)
    // nama_departemen (sebelumnya nama di seeder)
    protected $fillable = ['kode_departemen', 'nama_departemen', 'id_fakultas', 'source'];
}