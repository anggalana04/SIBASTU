<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class DinasController extends Controller
{
    public function dashboard()
    {
        $totalMahasiswa = Mahasiswa::count();
        $mahasiswaMendaftar = Mahasiswa::whereNotNull('tanggal_pendaftaran')->count();
        $mahasiswaUploadBerkas = Mahasiswa::whereNotNull('berkas_path')->count();
        $mahasiswaTerverifikasi = Mahasiswa::where('status_verifikasi', true)->count();
        $mahasiswaMenerimaBantuan = Mahasiswa::where('status_bantuan', true)->count();
        $totalDanaTersalurkan = Mahasiswa::where('status_bantuan', true)->sum('jumlah_bantuan');

        return view('dinas.dashboard', compact(
            'totalMahasiswa',
            'mahasiswaMendaftar',
            'mahasiswaUploadBerkas',
            'mahasiswaTerverifikasi',
            'mahasiswaMenerimaBantuan',
            'totalDanaTersalurkan'
        ));
    }
}
