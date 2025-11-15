<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tabel dibuat TANPA foreign key constraint
        Schema::create('mata_kuliah', function (Blueprint $table) {
            $table->id();
            $table->string('kode_mk', 20)->unique();
            $table->string('nama_mk', 150);
            $table->integer('sks');
            $table->string('dosen_pengampu')->nullable();
            $table->string('source')->nullable();
            
            // Kolom FK didefinisikan sebagai BIGINT UNSIGNED secara manual
            $table->unsignedBigInteger('id_departemen'); 
            $table->unsignedBigInteger('id_semester'); 
            
            // Definisikan constraint secara manual (INI DIPINDAHKAN KE MIGRASI TERPISAH)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mata_kuliah');
    }
};