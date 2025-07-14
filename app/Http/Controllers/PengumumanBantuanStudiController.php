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
    // Tim/admin view with filtering
    public function timIndex(Request $request)
    {
        $query = \App\Models\InformasiPemberianBantuan::with(['mahasiswa', 'bantuanStudi']);
        // Filtering
        if ($request->filled('periode')) {
            $query->whereHas('bantuanStudi', function ($q) use ($request) {
                $q->where('Periode_Bantuan', $request->periode);
            });
        }
        if ($request->filled('jenis')) {
            $query->whereHas('bantuanStudi', function ($q) use ($request) {
                $q->where('Jenis_Bantuan', $request->jenis);
            });
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('mahasiswa', function ($q) use ($search) {
                $q->where('Nama_Mahasiswa', 'like', "%$search%")
                    ->orWhere('NIM', 'like', "%$search%")
                    ->orWhere('Universitas', 'like', "%$search%")
                    ->orWhere('Jurusan', 'like', "%$search%")
                ;
            });
        }
        $informasiList = $query->get();
        $periodeList = \App\Models\BantuanStudi::distinct()->pluck('Periode_Bantuan')->filter();
        $jenisList = \App\Models\BantuanStudi::distinct()->pluck('Jenis_Bantuan')->filter();
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
        // Ensure periodeList and jenisList are always defined for the view
        if (!isset($periodeList)) $periodeList = collect();
        if (!isset($jenisList)) $jenisList = collect();
        return view('tim.informasi-pemberian', compact('informasiList', 'periodeList', 'jenisList', 'pengumuman'));
    }
}
