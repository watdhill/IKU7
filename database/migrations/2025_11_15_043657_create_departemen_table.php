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
        Schema::create('departemen', function (Blueprint $table) {
            $table->id();
            $table->string('kode_departemen', 10)->unique(); // Diperlukan oleh Seeder
            $table->string('nama_departemen', 100)->unique();
            $table->string('source')->nullable();
            
            // Foreign Key ke Fakultas
            // Asumsi tabel 'fakultas' memiliki kolom id
            $table->foreignId('id_fakultas')->constrained('fakultas')->onDelete('cascade'); 
            
            // Kolom timestamps dihilangkan karena $timestamps = false; di Model
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departemen');
    }
};