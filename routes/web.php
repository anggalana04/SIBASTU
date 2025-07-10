<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\BerkasController;
use App\Http\Controllers\ForumDiskusiController;
use App\Http\Controllers\ValidasiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Mahasiswa routes
    Route::prefix('mahasiswa')->group(function () {
        Route::view('/dashboard', 'mahasiswa.dashboard')->name('mahasiswa.dashboard');
        Route::view('/pendaftaran', 'mahasiswa.pendaftaran')->name('mahasiswa.pendaftaran');
        Route::view('/upload-berkas', 'mahasiswa.upload-berkas')->name('mahasiswa.upload-berkas');
        Route::view('/informasi-pemberian', 'mahasiswa.informasi-pemberian')->name('mahasiswa.informasi-pemberian');
        Route::view('/forum-diskusi', 'mahasiswa.forum-diskusi')->name('mahasiswa.forum-diskusi');
    });

    // Mahasiswa CRUD
    Route::resource('mahasiswa', MahasiswaController::class);

    // Berkas CRUD for Mahasiswa
    Route::resource('berkas', BerkasController::class);

    // Forum Diskusi CRUD for Mahasiswa
    Route::resource('forum-diskusi', ForumDiskusiController::class);

    // Korwil routes
    Route::prefix('korwil')->group(function () {
        Route::view('/dashboard', 'korwil.dashboard')->name('korwil.dashboard');
        Route::view('/forum-diskusi', 'korwil.forum-diskusi')->name('korwil.forum-diskusi');
        Route::view('/respon-diskusi', 'korwil.respon-diskusi')->name('korwil.respon-diskusi');
        Route::view('/setting', 'korwil.setting')->name('korwil.setting');
    });

    // Tim routes
    Route::prefix('tim')->group(function () {
        Route::view('/dashboard', 'tim.dashboard')->name('tim.dashboard');
        Route::view('/bantuan-studi', 'tim.bantuan-studi')->name('tim.bantuan-studi');
        Route::view('/data-mahasiswa', 'tim.data-mahasiswa')->name('tim.data-mahasiswa');
        Route::view('/data-korwil', 'tim.data-korwil')->name('tim.data-korwil');
        Route::view('/validasi-berkas', 'tim.validasi-berkas')->name('tim.validasi-berkas');
        Route::view('/informasi-pemberian', 'tim.informasi-pemberian')->name('tim.informasi-pemberian');
        Route::view('/forum-diskusi', 'tim.forum-diskusi')->name('tim.forum-diskusi');
    });

    // Validasi CRUD for Tim
    Route::resource('validasi', ValidasiController::class);

    // Dinas routes
    Route::prefix('dinas')->group(function () {
        Route::view('/dashboard', 'dinas.dashboard')->name('dinas.dashboard');
        Route::view('/laporan', 'dinas.laporan')->name('dinas.laporan');
        Route::view('/laporan/pendaftaran', 'dinas.laporan-pendaftaran')->name('dinas.laporan.pendaftaran');
        Route::view('/laporan/pemberian', 'dinas.laporan-pemberian')->name('dinas.laporan.pemberian');
    });
});

require __DIR__ . '/auth.php';
