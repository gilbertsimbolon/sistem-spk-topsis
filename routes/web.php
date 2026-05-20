<?php

use App\Http\Controllers\Admin\FasilitasKostController;
use App\Http\Controllers\Admin\FotoController;
use App\Http\Controllers\Admin\JenisKostController;
use App\Http\Controllers\Admin\KostController as AdminKostController;
use App\Http\Controllers\Admin\KostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Pages\ComingSoonController;
use App\Http\Controllers\Pages\DashboardController;
use Illuminate\Support\Facades\Route;

// Route Landing Page
Route::get('/', function () {
    return view('index');
})->name('index');

// Auth
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.store');

Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'create'])->name('register.create');

Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Bisa diakses ketika sudah login
Route::middleware('auth')->group(function () {
    // Akses Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
});

// Hanya admin yang bisa akses.
Route::prefix('/admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', function() {
        return view('admin.pages.dashboard');
    })->name('admin.dashboard.index');

    // Halaman Data Kost
    Route::resource('/data-kost', KostController::class);

    // Halaman Fasilitas Kost
    Route::resource('/fasilitas', FasilitasKostController::class);

    // Halaman Jenis Kost
    Route::resource('/jenis-kost', JenisKostController::class);

    // Handle Foto
    Route::post('data-kost/{foto}/foto', [FotoController::class, 'store'])->name('kost-foto.store');

    Route::delete('/kost-foto/{foto}', [FotoController::class, 'destroy'])->name('kost-foto.destroy');
});

Route::get('coming-soon', [ComingSoonController::class, 'index'])->middleware('auth')->name('coming-soon');

