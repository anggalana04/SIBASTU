<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class DinasController extends Controller
{
    public function dashboard()
    {
        $totalMahasiswa = \App\Models\Mahasiswa::count();
        $mahasiswaMendaftar = \App\Models\Mahasiswa::whereNotNull('created_at')->count();
        $mahasiswaUploadBerkas = \App\Models\Berkas::distinct('Id_Mahasiswa')->count('Id_Mahasiswa');
        // Count unique mahasiswa whose berkas is terverifikasi
        $mahasiswaTerverifikasi = \App\Models\Validasi::where('Status_Berkas', 'terverifikasi')->distinct('Id_Mahasiswa')->count('Id_Mahasiswa');
        $mahasiswaMenerimaBantuan = \App\Models\Mahasiswa::whereHas('informasiPemberianBantuan', function ($q) {
            $q->where('Status_Bantuan', 'disalurkan');
        })->count();
        $totalDanaTersalurkan = \App\Models\InformasiPemberianBantuan::where('Status_Bantuan', 'disalurkan')
            ->with('bantuanStudi')
            ->get()
            ->sum(function ($info) {
                return $info->bantuanStudi->Nominal ?? 0;
            });

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
