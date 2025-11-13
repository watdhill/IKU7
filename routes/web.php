<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Ini adalah file route utama aplikasi. Di sini kita buat 3 dashboard:
| rektorat, fakultas, dan dosen, masing-masing dilindungi middleware role.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Default dashboard — opsional (bisa kamu hapus kalau tidak dipakai)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 🔹 Rektorat Dashboard
Route::middleware(['auth', 'role:rektorat'])->group(function () {
    Route::get('/rektorat/dashboard', function () {
        return view('rektorat.dashboard');
    })->name('rektorat.dashboard');
});

// 🔹 Fakultas Dashboard
Route::middleware(['auth', 'role:fakultas'])->group(function () {
    Route::get('/fakultas/dashboard', function () {
        return view('fakultas.dashboard');
    })->name('fakultas.dashboard');
});

// 🔹 Dosen Dashboard
Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('/dosen/dashboard', function () {
        return view('dosen.dashboard');
    })->name('dosen.dashboard');
});

// Profil user (default bawaan Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
