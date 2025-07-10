<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::all();
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Nama_Mahasiswa' => 'required|string|max:50',
            'Id_Universitas' => 'nullable|string|max:50',
            'Jurusan' => 'required|string|max:50',
            'Fakultas' => 'nullable|string|max:50',
            'Semester' => 'nullable|integer',
            'Alamat' => 'nullable|string|max:100',
            'No_hp' => 'nullable|string|max:20',
            'Laporan_Aktifkuliah' => 'nullable|string|max:100',
            'Laporan_Kpm' => 'nullable|string|max:100',
            'Laporan_Ktp' => 'nullable|string|max:100',
            'Laporan_Dns' => 'nullable|string|max:100',
            'Laporan_Kk' => 'nullable|string|max:100',
            'Laporan_KartuKeluarga' => 'nullable|string|max:100',
            'Laporan_Rekomendasi' => 'nullable|string|max:100',
        ]);

        
        Mahasiswa::create($validated);
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa created successfully.');
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'Nama_Mahasiswa' => 'required|string|max:50',
            'Jurusan' => 'required|string|max:50',
            'Semester' => 'nullable|integer',
            'Alamat' => 'nullable|string|max:30',
            'No_hp' => 'nullable|string|max:15',
        ]);
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update($validated);
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa updated successfully.');
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa deleted successfully.');
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.show', compact('mahasiswa'));
    }
}
