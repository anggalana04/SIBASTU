<?php

namespace App\Http\Controllers;

use App\Models\Validasi;
use App\Models\Berkas;
use Illuminate\Http\Request;

class ValidasiController extends Controller
{
    public function index()
    {
        // Show all berkas that need validation (customize as needed)
        $berkasList = Berkas::with('mahasiswa')->get();
        return view('tim.validasi-berkas.index', compact('berkasList'));
    }

    public function create()
    {
        return view('tim.validasi-berkas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Id_Mahasiswa' => 'required|string',
            'Nama_Mahasiswa' => 'required|string',
            'Jurusan' => 'required|string',
            'Fakultas' => 'required|string',
            'Semester' => 'nullable|integer',
            'Tgl_Validasi' => 'nullable|date',
        ]);
        Validasi::create($validated);
        return redirect()->route('validasi.index')->with('success', 'Validasi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $berkas = Berkas::with('mahasiswa')->findOrFail($id);
        return view('tim.validasi-berkas.index', compact('berkas'));
    }

    public function update(Request $request, $id)
    {
        $validasi = \App\Models\Validasi::where('Id_Berkas', $id)->firstOrFail();
        $request->validate([
            'Status_Validasi' => 'required|string',
        ]);
        $validasi->Status_Berkas = $request->input('Status_Validasi');
        $validasi->Tgl_Validasi = now();
        if ($request->input('Status_Validasi') === 'ditolak') {
            $validasi->Catatan = $request->input('Catatan');
        } else {
            $validasi->Catatan = null;
        }
        $validasi->save();
        return redirect()->route('validasi.index')->with('success', 'Status validasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $validasi = Validasi::findOrFail($id);
        $validasi->delete();
        return redirect()->route('validasi.index')->with('success', 'Validasi berhasil dihapus.');
    }

    public function show($id)
    {
        $berkas = \App\Models\Berkas::with('mahasiswa')->findOrFail($id);
        return view('tim.validasi-berkas.show', compact('berkas'));
    }
}
