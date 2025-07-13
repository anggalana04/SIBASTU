<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengumumanBantuanStudi;

class MahasiswaPengumumanController extends Controller
{
    // Mahasiswa view
    public function index()
    {
            $informasiList = \App\Models\InformasiPemberianBantuan::all();
            $pengumuman = PengumumanBantuanStudi::first();
            return view('mahasiswa.informasi-pemberian', compact('informasiList', 'pengumuman'));

    }
}
    