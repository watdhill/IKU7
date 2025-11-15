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
        Schema::create('metode', function (Blueprint $table) {
            $table->id();
            $table->string('kode_metode', 10)->unique();
            $table->string('nama_metode', 50)->unique();
            // Tanpa timestamps (sesuai Model Anda)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metode');
    }
};