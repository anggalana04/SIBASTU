<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerkasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ValidasiController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ForumDiskusiController;
use App\Http\Controllers\TimBantuanStudiController;
use App\Http\Controllers\MahasiswaPengumumanController;
use App\Http\Controllers\TimPengumumanController;


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
        Route::get('/pendaftaran', [MahasiswaController::class, 'create'])->name('mahasiswa.pendaftaran');
        Route::view('/upload-berkas', 'mahasiswa.upload-berkas')->name('mahasiswa.upload-berkas');
        Route::view('/informasi-pemberian', 'mahasiswa.informasi-pemberian')->name('mahasiswa.informasi-pemberian');
        Route::get('/forum-diskusi', [ForumDiskusiController::class, 'index'])->name('mahasiswa.forum-diskusi');
        Route::view('/forum-diskusi/create', 'forum-diskusi.create')->name('mahasiswa.forum-diskusi.create');
        Route::view('/forum-diskusi/show', 'forum-diskusi.show')->name('mahasiswa.forum-diskusi.show');
    });

    // Mahasiswa CRUD
    Route::resource('mahasiswa', MahasiswaController::class);

    // Berkas CRUD for Mahasiswa
    Route::resource('berkas', BerkasController::class);

    // Forum Diskusi CRUD for Mahasiswa
    Route::resource('forum-diskusi', ForumDiskusiController::class);

    // Korwil routes
    Route::prefix('korwil')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\KorwilController::class, 'dashboard'])->name('korwil.dashboard');
        Route::view('/forum-diskusi', 'korwil.forum-diskusi')->name('korwil.forum-diskusi');
        Route::view('/respon-diskusi', 'korwil.respon-diskusi')->name('korwil.respon-diskusi');
        Route::view('/setting', 'korwil.setting')->name('korwil.setting');
    });

    // Tim routes
    Route::prefix('tim')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\TimLannyJayaCerdasController::class, 'dashboard'])->name('tim.dashboard');
        Route::view('/bantuan-studi', 'tim.bantuan-studi')->name('tim.bantuan-studi');
        Route::get('/data-mahasiswa', [\App\Http\Controllers\MahasiswaController::class, 'index'])->name('tim.data-mahasiswa');

        // Korwil management for tim
        Route::get('/data-korwil', [\App\Http\Controllers\KorwilController::class, 'index'])->name('tim.data-korwil');
        Route::get('/data-korwil/create', [\App\Http\Controllers\KorwilController::class, 'create'])->name('korwil.create');
        Route::post('/data-korwil', [\App\Http\Controllers\KorwilController::class, 'store'])->name('korwil.store');
        Route::get('/data-korwil/{id}', [\App\Http\Controllers\KorwilController::class, 'show'])->name('korwil.show');
        Route::get('/data-korwil/{id}/edit', [\App\Http\Controllers\KorwilController::class, 'edit'])->name('korwil.edit');
        Route::put('/data-korwil/{id}', [\App\Http\Controllers\KorwilController::class, 'update'])->name('korwil.update');
        Route::delete('/data-korwil/{id}', [\App\Http\Controllers\KorwilController::class, 'destroy'])->name('korwil.destroy');

        // Validasi Berkas for tim
        Route::get('/validasi-berkas', [\App\Http\Controllers\ValidasiController::class, 'index'])->name('validasi.index');
        Route::get('/validasi-berkas/{id}/edit', [\App\Http\Controllers\ValidasiController::class, 'edit'])->name('validasi.edit');
        Route::put('/validasi-berkas/{id}', [\App\Http\Controllers\ValidasiController::class, 'update'])->name('validasi.update');
        Route::get('/validasi-berkas/{id}', [\App\Http\Controllers\ValidasiController::class, 'show'])->name('validasi.show');


        Route::get('/informasi-pemberian', [\App\Http\Controllers\PengumumanBantuanStudiController::class, 'timIndex'])->name('tim.informasi-pemberian');
        Route::view('/forum-diskusi', 'tim.forum-diskusi')->name('tim.forum-diskusi');

        Route::get('/bantuan-studi', [\App\Http\Controllers\TimBantuanStudiController::class, 'index'])->name('tim.bantuan-studi');
        Route::get('/bantuan-studi/give/{id}', [\App\Http\Controllers\TimBantuanStudiController::class, 'give'])->name('tim.bantuan-studi.give');
        Route::post('/bantuan-studi/give/{id}', [\App\Http\Controllers\TimBantuanStudiController::class, 'storeGive'])->name('tim.bantuan-studi.give.store');
        Route::get('/informasi-pemberian/{id}', [\App\Http\Controllers\InformasiPemberianBantuanController::class, 'show'])->name('tim.informasi-pemberian.show');
        Route::put('/informasi-pemberian/{id}', [\App\Http\Controllers\InformasiPemberianBantuanController::class, 'update'])->name('tim.informasi-pemberian.update');
        Route::get('/informasi-pemberian/{id}/edit', [\App\Http\Controllers\InformasiPemberianBantuanController::class, 'edit'])->name('informasi.edit');
        Route::delete('/informasi-pemberian/{id}', [\App\Http\Controllers\InformasiPemberianBantuanController::class, 'destroy'])->name('informasi.destroy');

        // Pengumuman Bantuan Studi
        Route::get('/tim/pengumuman-bantuan-studi', [\App\Http\Controllers\PengumumanBantuanStudiController::class, 'index'])->name('tim.pengumuman-bantuan-studi');
        Route::post('/tim/pengumuman-bantuan-studi', [\App\Http\Controllers\PengumumanBantuanStudiController::class, 'store'])->name('tim.pengumuman-bantuan-studi.store');
        Route::get('/tim/pengumuman-bantuan-studi/{id}/edit', [\App\Http\Controllers\PengumumanBantuanStudiController::class, 'edit'])->name('tim.pengumuman-bantuan-studi.edit');
        Route::put('/tim/pengumuman-bantuan-studi/{id}', [\App\Http\Controllers\PengumumanBantuanStudiController::class, 'update'])->name('tim.pengumuman-bantuan-studi.update');
        Route::delete('/tim/pengumuman-bantuan-studi', [\App\Http\Controllers\PengumumanBantuanStudiController::class, 'destroy'])->name('tim.pengumuman-bantuan-studi.destroy');

        // Tim Akun Management
        Route::prefix('akun')->group(function () {
            Route::get('/', [\App\Http\Controllers\AkunController::class, 'index'])->name('tim.akun.index');
            Route::get('/create', [\App\Http\Controllers\AkunController::class, 'create'])->name('tim.akun.create');
            Route::post('/', [\App\Http\Controllers\AkunController::class, 'store'])->name('tim.akun.store');
            Route::get('/{id}/edit', [\App\Http\Controllers\AkunController::class, 'edit'])->name('tim.akun.edit');
            Route::put('/{id}', [\App\Http\Controllers\AkunController::class, 'update'])->name('tim.akun.update');
            Route::delete('/{id}', [\App\Http\Controllers\AkunController::class, 'destroy'])->name('tim.akun.destroy');
        });

        // CRUD Bantuan Studi
        Route::get('/bantuan-studi/create', [\App\Http\Controllers\TimBantuanStudiController::class, 'create'])->name('tim.bantuan-studi.create');
        Route::post('/bantuan-studi', [\App\Http\Controllers\TimBantuanStudiController::class, 'store'])->name('tim.bantuan-studi.store');
        Route::get('/bantuan-studi/{id}/edit', [\App\Http\Controllers\TimBantuanStudiController::class, 'edit'])->name('tim.bantuan-studi.edit');
        Route::put('/bantuan-studi/{id}', [\App\Http\Controllers\TimBantuanStudiController::class, 'update'])->name('tim.bantuan-studi.update');
        Route::delete('/bantuan-studi/{id}', [\App\Http\Controllers\TimBantuanStudiController::class, 'destroy'])->name('tim.bantuan-studi.destroy');
        Route::get('/bantuan-studi/{id}', [\App\Http\Controllers\TimBantuanStudiController::class, 'show'])->name('tim.bantuan-studi.show');
    });

    // Laporan routes for Admin Dinas
    Route::prefix('dinas')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\DinasController::class, 'dashboard'])->name('dinas.dashboard');
        // Main laporan page for dinas
        Route::view('/laporan', 'dinas.laporan')->name('dinas.laporan');
        // Laporan Pendaftaran
        Route::get('/pendaftaran', [\App\Http\Controllers\LaporanController::class, 'laporanPendaftaran'])->name('laporan.pendaftaran');
        Route::get('/pendaftaran/export-pdf', [\App\Http\Controllers\LaporanController::class, 'exportPendaftaranPdf'])->name('laporan.pendaftaran.exportPdf');
        // Laporan Pemberian Bantuan
        Route::get('/bantuan', [\App\Http\Controllers\LaporanController::class, 'laporanBantuan'])->name('laporan.bantuan');
        Route::get('/bantuan/export-pdf', [\App\Http\Controllers\LaporanController::class, 'exportBantuanPdf'])->name('laporan.bantuan.exportPdf');
    });


    // Mahasiswa & Korwil view pengumuman
    Route::get('/mahasiswa/informasi-pemberian', [\App\Http\Controllers\PengumumanBantuanStudiController::class, 'index'])->name('mahasiswa.informasi-pemberian');
    Route::get('/korwil/informasi-pemberian', [\App\Http\Controllers\PengumumanBantuanStudiController::class, 'index'])->name('korwil.informasi-pemberian');

    Route::post('forum-diskusi/{id}/respon', [ForumDiskusiController::class, 'addRespon'])->name('forum-diskusi.addRespon');
    Route::post('/berkas/reupload', [App\Http\Controllers\BerkasController::class, 'reupload'])->name('berkas.reupload');

    // Route for mahasiswa pengumuman
    Route::get('/mahasiswa/informasi-pemberian', [MahasiswaPengumumanController::class, 'index'])->name('mahasiswa.pengumuman-bantuan-studi');

    // Route for tim/admin pengumuman
    Route::resource('/tim/pengumuman-bantuan-studi', TimPengumumanController::class);

    // Route for updating Korwil identity
    Route::put('/korwil/update-identity', [\App\Http\Controllers\KorwilController::class, 'updateIdentity'])->name('korwil.updateIdentity');

    // Route for toggling dark mode
    Route::post('/korwil/toggle-dark-mode', [\App\Http\Controllers\KorwilController::class, 'toggleDarkMode'])->name('korwil.toggleDarkMode');
});

require __DIR__ . '/auth.php';
