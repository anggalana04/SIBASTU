<?php

namespace App\Http\Controllers;

use App\Models\Validasi;
use Illuminate\Http\Request;

class ValidasiController extends Controller
{
    public function index()
    {
        $validasi = Validasi::all();
        return view('tim.validasi-berkas.index', compact('validasi'));
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
        $validasi = Validasi::findOrFail($id);
        return view('tim.validasi-berkas.edit', compact('validasi'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'Id_Mahasiswa' => 'required|string',
            'Nama_Mahasiswa' => 'required|string',
            'Jurusan' => 'required|string',
            'Fakultas' => 'required|string',
            'Semester' => 'nullable|integer',
            'Tgl_Validasi' => 'nullable|date',
        ]);
        $validasi = Validasi::findOrFail($id);
        $validasi->update($validated);
        return redirect()->route('validasi.index')->with('success', 'Validasi berhasil diupdate.');
    }

    public function destroy($id)
    {
        $validasi = Validasi::findOrFail($id);
        $validasi->delete();
        return redirect()->route('validasi.index')->with('success', 'Validasi berhasil dihapus.');
    }
}
