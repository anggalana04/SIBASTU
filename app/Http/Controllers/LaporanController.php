<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Berkas;
use App\Models\Validasi;
use App\Models\BantuanStudi;
use App\Models\InformasiPemberianBantuan;
use App\Models\Korwil;

class LaporanController extends Controller
{
    // Laporan Pendaftaran Mahasiswa
    public function laporanPendaftaran(Request $request)
    {
        // Join mahasiswa, berkas, and latest validasi for each mahasiswa
        $mahasiswa = Mahasiswa::with(['berkas', 'berkas.validasi' => function($q) {
            $q->orderByDesc('Tgl_Validasi');
        }])->paginate(20);
        // Pass to view
        return view('laporan.pendaftaran', compact('mahasiswa'));
    }

    // Laporan Pemberian Bantuan
    public function laporanBantuan(Request $request)
    {
        // Join informasi_pemberian_bantuan, mahasiswa, bantuan_studi, korwil
        $bantuan = InformasiPemberianBantuan::with([
            'mahasiswa',
            'bantuanStudi',
            'korwil',
        ])->paginate(20);
        // Pass to view
        return view('laporan.bantuan', compact('bantuan'));
    }
}
