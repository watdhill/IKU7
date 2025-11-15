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
        // 1. Tabel Klaim Metode (Induk Transaksi)
        Schema::create('klaim_metode', function (Blueprint $table) {
            $table->id();
            
            // --- PERBAIKAN: Menggunakan Definisi Manual untuk Error 150 ---
            $table->unsignedBigInteger('fakultas_id');
            $table->unsignedBigInteger('departemen_id');
            $table->unsignedBigInteger('semester_id');
            $table->unsignedBigInteger('mata_kuliah_id');
            $table->unsignedBigInteger('metode_id'); // Poin kegagalan
            
            // Kolom Lain
            $table->string('tahun_ajaran', 10); 
            $table->unsignedBigInteger('dosen_id'); // Asumsi referensi ke tabel users
            $table->string('status')->default('pending');
            $table->timestamps(); // Menggunakan timestamps pada tabel transaksi

            // --- Definisi Constraint Manual ---
            $table->foreign('fakultas_id')->references('id')->on('fakultas')->onDelete('cascade');
            $table->foreign('departemen_id')->references('id')->on('departemen')->onDelete('cascade');
            $table->foreign('semester_id')->references('id')->on('semester')->onDelete('cascade');
            $table->foreign('mata_kuliah_id')->references('id')->on('mata_kuliah')->onDelete('cascade');
            $table->foreign('metode_id')->references('id')->on('metode')->onDelete('cascade');
        });

        // 2. Tabel Komponen Penilaian (Anak 1)
        Schema::create('komponen_penilaian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('klaim_metode_id')->constrained('klaim_metode')->onDelete('cascade');
            $table->string('nama');
            $table->decimal('persentase', 5, 2); // Persentase 0.00 - 999.99 (jika 5,2)
            // Tanpa timestamps
        });

        // 3. Tabel Dokumen Metode (Anak 2)
        Schema::create('dokumen_metode', function (Blueprint $table) {
            $table->id();
            $table->foreignId('klaim_metode_id')->constrained('klaim_metode')->onDelete('cascade');
            $table->string('nama_file');
            $table->string('path_file');
            // Tanpa timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_metode');
        Schema::dropIfExists('komponen_penilaian');
        Schema::dropIfExists('klaim_metode');
        // Schema::dropIfExists('metode'); // <-- BARIS INI DIHAPUS KARENA MENYEBABKAN ERROR 150
    }
};