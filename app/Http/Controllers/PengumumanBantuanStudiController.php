<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengumumanBantuanStudi;

class PengumumanBantuanStudiController extends Controller
{    // For backward compatibility: redirect index() to timIndex
    public function index()
    {
        return redirect()->action([self::class, 'timIndex']);
    }
    // Delete pengumuman
    public function destroy(Request $request)
    {
        $pengumuman = PengumumanBantuanStudi::first();
        if ($pengumuman) {
            $pengumuman->delete();
        }
        return redirect()->route('tim.pengumuman-bantuan-studi')->with('success', 'Pengumuman berhasil dihapus.');
    }

    // No mahasiswa logic here. Use TimPengumumanController for tim/admin logic.

    // Store or update pengumuman (admin/tim)
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:150',
            'isi' => 'nullable|string',
            'syarat' => 'nullable|string',
            'jadwal' => 'nullable|string',
        ]);

        // Convert syarat textarea (one per line) to JSON
        if (isset($data['syarat'])) {
            $syaratArray = array_filter(array_map('trim', preg_split('/\r?\n/', $data['syarat'])));
            $data['syarat'] = json_encode($syaratArray);
        }

        // Convert jadwal textarea (one per line) to JSON
        if (isset($data['jadwal'])) {
            $jadwalArray = array_filter(array_map('trim', preg_split('/\r?\n/', $data['jadwal'])));
            $data['jadwal'] = json_encode($jadwalArray);
        }

        $pengumuman = PengumumanBantuanStudi::first();
        if ($pengumuman) {
            $pengumuman->update($data);
        } else {
            $pengumuman = PengumumanBantuanStudi::create($data);
        }

        return redirect()->route('tim.pengumuman-bantuan-studi')->with('success', 'Pengumuman berhasil disimpan.');
    }

    // Show edit form for admin/tim
    public function edit()
    {
        $pengumuman = PengumumanBantuanStudi::first();
        return view('tim.informasi-pemberian-edit', compact('pengumuman'));
    }

    // Update pengumuman (admin/tim)
    public function update(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:150',
            'isi' => 'nullable|string',
            'syarat' => 'nullable|string',
            'jadwal' => 'nullable|string',
        ]);
        // Convert syarat textarea (one per line) to array
        if (isset($data['syarat'])) {
            $syaratArray = array_filter(array_map('trim', preg_split('/\r?\n/', $data['syarat'])));
            $data['syarat'] = $syaratArray;
        }
        // Convert jadwal textarea (one per line) to array
        if (isset($data['jadwal'])) {
            $jadwalArray = array_filter(array_map('trim', preg_split('/\r?\n/', $data['jadwal'])));
            $data['jadwal'] = $jadwalArray;
        }
        $pengumuman = PengumumanBantuanStudi::first();
        if ($pengumuman) {
            $pengumuman->update($data);
        }
        return redirect()->route('tim.pengumuman-bantuan-studi')->with('success', 'Pengumuman berhasil diupdate.');
    }
    // Tim/admin view
    public function timIndex()
    {
        $informasiList = \App\Models\InformasiPemberianBantuan::all();
        $pengumuman = PengumumanBantuanStudi::first();
        // Decode syarat and jadwal json to array for display, only if they're strings
        if ($pengumuman) {
            if ($pengumuman->syarat && is_string($pengumuman->syarat)) {
                $pengumuman->syarat = json_decode($pengumuman->syarat, true);
            }
            if ($pengumuman->jadwal && is_string($pengumuman->jadwal)) {
                $pengumuman->jadwal = json_decode($pengumuman->jadwal, true);
            }
        }
        return view('tim.informasi-pemberian', compact('informasiList', 'pengumuman'));
    }
}
