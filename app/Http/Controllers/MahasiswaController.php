<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\Akun;

class MahasiswaController extends Controller
{
    public function store(Request $request)
    {
        try {
            $user = Auth::user();
            if (!$user || $user->role !== 'mahasiswa') {
                abort(403, 'Unauthorized action.');
            }
            $validated = $request->validate([
                'Nama_Mahasiswa' => 'required|string|max:100',
                'Id_Universitas' => 'nullable|string|max:10',
                'Jurusan' => 'required|string|max:50',
                'Semester' => 'nullable|integer',
                'Alamat' => 'nullable|string',
                'No_hp' => 'nullable|string|max:15',
            ]);
            $mahasiswa = Mahasiswa::create($validated);
            $akun = Akun::find($user->Id_Akun);
            $akun->Id_Mahasiswa = $mahasiswa->Id_Mahasiswa;
            $akun->save();
            return redirect()->route('mahasiswa.pendaftaran')->with('success', 'Pendaftaran Mahasiswa berhasil.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    public function update(Request $request, $id)
    {
        try {
            $user = Auth::user();
            if (!$user || $user->role !== 'mahasiswa') {
                abort(403, 'Unauthorized action.');
            }
            $mahasiswa = Mahasiswa::findOrFail($id);
            $validated = $request->validate([
                'Nama_Mahasiswa' => 'required|string|max:100',
                'Id_Universitas' => 'nullable|string|max:10',
                'Jurusan' => 'required|string|max:50',
                'Semester' => 'nullable|integer',
                'Alamat' => 'nullable|string',
                'No_hp' => 'nullable|string|max:15',
            ]);
            $mahasiswa->update($validated);
            return redirect()->route('dashboard')->with('success', 'Data Mahasiswa berhasil diupdate.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat update data: ' . $e->getMessage())->withInput();
        }
    }

    public function create()
    {
        $mahasiswa = null;
        if (Auth::user() && Auth::user()->Id_Mahasiswa) {
            $mahasiswa = Mahasiswa::find(Auth::user()->Id_Mahasiswa);
        }
        return view('mahasiswa.pendaftaran', compact('mahasiswa'));
    }

    public function index()
    {
        $mahasiswas = \App\Models\Mahasiswa::orderBy('Nama_Mahasiswa')->get();
        return view('tim.data-mahasiswa.index', compact('mahasiswas'));
    }
}
