<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    public function index()
    {
        $akun = Akun::all();
        return view('tim.akun.index', compact('akun'));
    }

    public function create()
    {
        return view('tim.akun.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Nama_Akun' => 'required|string|max:255',
            'role' => 'required|in:mahasiswa,korwil,tim,dinas',
            'Password' => 'required|string|min:6',
        ]);
        $validated['Password'] = bcrypt($validated['Password']);
        Akun::create($validated);
        return redirect()->route('tim.akun.index')->with('success', 'Akun berhasil dibuat.');
    }

    public function edit($id)
    {
        $akun = Akun::findOrFail($id);
        return view('tim.akun.edit', compact('akun'));
    }

    public function update(Request $request, $id)
    {
        $akun = Akun::findOrFail($id);
        $validated = $request->validate([
            'Nama_Akun' => 'required|string|max:255',
            'role' => 'required|in:mahasiswa,korwil,tim,dinas',
            'Password' => 'nullable|string|min:6',
        ]);
        if (!empty($validated['Password'])) {
            $validated['Password'] = bcrypt($validated['Password']);
        } else {
            unset($validated['Password']);
        }
        $akun->update($validated);
        return redirect()->route('tim.akun.index')->with('success', 'Akun berhasil diupdate.');
    }

    public function destroy($id)
    {
        $akun = Akun::findOrFail($id);
        $akun->delete();
        return redirect()->route('tim.akun.index')->with('success', 'Akun berhasil dihapus.');
    }
}
