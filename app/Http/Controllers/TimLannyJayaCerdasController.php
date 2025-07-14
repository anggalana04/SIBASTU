<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class TimLannyJayaCerdasController extends Controller
{
    // ...existing methods...

    public function dashboard()
    {
        // For Tim: aggregate all mahasiswa, not filtered by korwil
        $totalMahasiswa = Mahasiswa::count();
        $mahasiswaMendaftar = Mahasiswa::whereNotNull('created_at')->count();
        $mahasiswaUploadBerkas = Mahasiswa::distinct('Id_Mahasiswa')->count('Id_Mahasiswa');
        // Count unique mahasiswa whose berkas is terverifikasi
        $mahasiswaTerverifikasi = \App\Models\Validasi::where('Status_Berkas', 'terverifikasi')->distinct('Id_Mahasiswa')->count('Id_Mahasiswa');
        $mahasiswaMenerimaBantuan = Mahasiswa::whereHas('informasiPemberianBantuan', function ($q) {
            $q->where('Status_Bantuan', 'disalurkan');
        })->count();
        $totalDanaTersalurkan = \App\Models\InformasiPemberianBantuan::where('Status_Bantuan', 'disalurkan')
            ->with('bantuanStudi')
            ->get()
            ->sum(function ($info) {
                return $info->bantuanStudi->Nominal ?? 0;
            });

        return view('tim.dashboard', compact(
            'totalMahasiswa',
            'mahasiswaMendaftar',
            'mahasiswaUploadBerkas',
            'mahasiswaTerverifikasi',
            'mahasiswaMenerimaBantuan',
            'totalDanaTersalurkan'
        ));
    }

    // ...existing methods...
}
