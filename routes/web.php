<?php

use App\Http\Controllers\Admin\KostController as AdminKostController;
use App\Http\Controllers\Admin\Laporan\LaporanController;
use App\Http\Controllers\Admin\ManajemenKost\DaerahKostController;
use App\Http\Controllers\Admin\ManajemenKost\FasilitasKostController;
use App\Http\Controllers\Admin\ManajemenKost\FotoController;
use App\Http\Controllers\Admin\ManajemenKost\JenisKostController;
use App\Http\Controllers\Admin\ManajemenKost\KeamananController;
use App\Http\Controllers\Admin\ManajemenKost\KebersihanController;
use App\Http\Controllers\Admin\ManajemenKost\KostController;
use App\Http\Controllers\Admin\ManajemenUser\OwnerController;
use App\Http\Controllers\Admin\ManajemenUser\UserController;
use App\Http\Controllers\Admin\Topsis\CriteriaController;
use App\Http\Controllers\Admin\Topsis\PenilaianAlternatifController;
use App\Http\Controllers\Admin\Topsis\SubCriteriaController;
use App\Http\Controllers\Admin\Topsis\TopsisController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Pages\ComingSoonController;
use App\Http\Controllers\Pages\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Pages\ProfileUserController;
use Illuminate\Support\Facades\Route;


// Route Landing Page
Route::get('/', [LandingPageController::class, 'kost'])->name('landing-page.kost');

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

    Route::get('dashboard/kost/{id}', [DashboardController::class, 'show'])->name('dashboard.kost.show');

    Route::get('profile/user', [ProfileUserController::class, 'edit'])->name('profile.user.edit');

    Route::put('profile/user/update', [ProfileUserController::class, 'update'])->name('profile.user.update');

    Route::put('profile/user/password', [ProfileUserController::class, 'updatePassword'])->name('profile.user.password');
});

// Hanya admin yang bisa akses.
Route::prefix('/admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardAdminController::class, 'index'])->name('admin.dashboard.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'password'])->name('profile.password');

    // Halaman Data Kost
    Route::resource('/data-kost', KostController::class);

    // Halaman Fasilitas Kost
    Route::resource('/fasilitas', FasilitasKostController::class);

    // Halaman Keamanan Kost
    Route::resource('/keamanan', KeamananController::class);

    // Halaman Kebersihan Kost
    Route::resource('/kebersihan', KebersihanController::class);

    // Halaman Jenis Kost
    Route::resource('/jenis-kost', JenisKostController::class);

    // Halaman Daerah Kost
    Route::resource('/daerah', DaerahKostController::class);

    // Handle Foto
    Route::post('data-kost/{foto}/foto', [FotoController::class, 'store'])->name('kost-foto.store');
    Route::delete('/kost-foto/{foto}', [FotoController::class, 'destroy'])->name('kost-foto.destroy');

    // Halaman User
    Route::resource('/semua-user', UserController::class);

    // Halaman Owner
    Route::resource('/owner', OwnerController::class);

    // Halaman Data Kriteria
    Route::resource('/data-kriteria', CriteriaController::class);

    // Halaman Data Sub Kriteria
    Route::resource('/sub-kriteria', SubCriteriaController::class);

    // Halaman Penilaian Alternatif
    Route::resource('/penilaian-alternatif', PenilaianAlternatifController::class);

    // Halaman Perhitungan TOPSIS
    Route::get('/perhitungan-topsis', [TopsisController::class, 'hitung'])->name('topsis.hitung');

    // Halaman Laporan
    Route::get('/laporan-kost', [LaporanController::class, 'dataKost'])->name('laporan.kost');
});

Route::prefix('/owner')->middleware(['auth', 'role:owner'])->group(function () {
    // Halaman Data Kost Khusus Owner
    Route::resource('/kost', \App\Http\Controllers\Owner\KostController::class);
    // Rute foto khusus untuk owner
    Route::post('/kost/{kost}/foto', [\App\Http\Controllers\Owner\FotoController::class, 'store'])->name('owner.kost-foto.store');
    Route::delete('/kost-foto/{foto}', [\App\Http\Controllers\Owner\FotoController::class, 'destroy'])->name('owner.kost-foto.destroy');
});

Route::get('coming-soon', [ComingSoonController::class, 'index'])->middleware('auth')->name('coming-soon');
