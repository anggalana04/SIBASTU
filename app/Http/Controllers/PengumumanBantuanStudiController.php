<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengumumanBantuanStudi;

class PengumumanBantuanStudiController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $informasiList = \App\Models\InformasiPemberianBantuan::with('bantuanStudi')
            ->where('Id_Mahasiswa', $user->Id_Mahasiswa)
            ->get();
        return view('mahasiswa.informasi-pemberian', compact('informasiList'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:150',
            'isi' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'syarat' => 'nullable|string',
        ]);
        $pengumuman = PengumumanBantuanStudi::first();
        if ($pengumuman) {
            $pengumuman->update($data);
        } else {
            $pengumuman = PengumumanBantuanStudi::create($data);
        }
        return redirect()->route('tim.pengumuman-bantuan-studi')->with('success', 'Pengumuman berhasil disimpan.');
    }
}
