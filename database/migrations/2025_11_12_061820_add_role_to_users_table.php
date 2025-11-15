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
        // Pastikan kolom 'role' belum ada sebelum menambahkannya
        if (!Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('role')->default('dosen')->after('email'); // Pastikan 'email' adalah kolom yang sudah ada
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Pastikan kolom 'role' ada sebelum menghapusnya
        if (Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('role');
            });
        }
    }
};