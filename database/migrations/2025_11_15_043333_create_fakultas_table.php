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
        Schema::create('fakultas', function (Blueprint $table) {
            $table->id();
            $table->string('kode_fakultas', 10)->unique();
            $table->string('nama_fakultas', 100);
            $table->string('source')->nullable(); // Ditambahkan kolom source
            // Catatan: Seeder Anda sebelumnya menyisipkan kolom 'created_at' dan 'updated_at'
            // Jika Anda ingin menggunakan timestamps, hapus baris berikut, tapi pastikan modelnya tidak memiliki $timestamps = false;
            // Jika tabel Anda tidak menggunakan timestamps, biarkan begini saja
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fakultas');
    }
};