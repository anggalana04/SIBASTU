<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BerkasController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $berkas = Berkas::where('Id_Mahasiswa', $user->Id_Mahasiswa)->get();
        return view('mahasiswa.berkas.index', compact('berkas'));
    }

    public function create()
    {
        $user = Auth::user();
        return view('mahasiswa.upload-berkas', [
            'Id_Mahasiswa' => $user->Id_Mahasiswa
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Nomor_Rekening' => 'required|string|max:25',
            'Nama_Bank' => 'required|string|max:50',
            'Lampiran_aktifkuliah' => 'nullable|file',
            'Lampiran_kpm' => 'nullable|file',
            'Lampiran_ktp' => 'nullable|file',
            'Lampiran_dns' => 'nullable|file',
            'Lampiran_kk' => 'nullable|file',
            'Lampiran_rekomendasi' => 'nullable|file',
        ]);
        $user = Auth::user();
        $data = $validated;
        $data['Id_Mahasiswa'] = $user->Id_Mahasiswa;
        foreach (
            [
                'Lampiran_aktifkuliah',
                'Lampiran_kpm',
                'Lampiran_ktp',
                'Lampiran_dns',
                'Lampiran_kk',
                'Lampiran_rekomendasi'
            ] as $fileField
        ) {
            if ($request->hasFile($fileField)) {
                $data[$fileField] = $request->file($fileField)->store('berkas', 'public');
            }
        }
        Berkas::create($data);
        return redirect()->route('berkas.index')->with('success', 'Berkas uploaded successfully.');
    }

    public function show($id)
    {
        $berkas = Berkas::findOrFail($id);
        return view('mahasiswa.berkas.show', compact('berkas'));
    }

    public function destroy($id)
    {
        $berkas = Berkas::findOrFail($id);
        $berkas->delete();
        return redirect()->route('berkas.index')->with('success', 'Berkas deleted successfully.');
    }
}
