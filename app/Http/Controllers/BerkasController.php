<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\Mahasiswa;
use App\Models\Validasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BerkasController extends Controller
{
    public function index(Request $request)
    {
        $query = Berkas::with(['mahasiswa', 'validasi']);
        // Filtering by status validasi
        if ($request->filled('status')) {
            $query->whereHas('validasi', function ($q) use ($request) {
                $q->where('Status_Berkas', $request->status);
            });
        }
        // Search by nama, nim, jurusan
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('mahasiswa', function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('Nama_Mahasiswa', 'like', "%$search%")
                        ->orWhere('NIM', 'like', "%$search%")
                        ->orWhere('Jurusan', 'like', "%$search%")
                    ;
                });
            });
        }
        // Only show berkas that have at least one validasi (for tim validation)
        $query->whereHas('validasi');
        $berkasList = $query->get();
        return view('tim.validasi-berkas.index', compact('berkasList'));
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
        // Get korwil name from relationship if available
        $korwilName = 'nokorwil';
        if ($user->Id_Korwil) {
            $korwil = \App\Models\Korwil::find($user->Id_Korwil);
            if ($korwil) {
                $korwilName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $korwil->Nama_Korwil);
            }
        }
        $nim = $user->NIM ?? $user->nim ?? 'nonim';
        $nim = preg_replace('/[^A-Za-z0-9_\-]/', '_', $nim); // sanitize
        $nama = $user->Nama_Mahasiswa ?? $user->nama_mahasiswa ?? 'anonim';
        $nama = preg_replace('/[^A-Za-z0-9_\-]/', '_', $nama); // sanitize
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
                $originalName = $request->file($fileField)->getClientOriginalName();
                $ext = $request->file($fileField)->getClientOriginalExtension();
                $baseName = pathinfo($originalName, PATHINFO_FILENAME);
                $baseName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $baseName);
                $newFileName = $nim . '_' . $nama . '_' . $fileField . '_' . $baseName . '_' . uniqid() . '.' . $ext;
                $folder = 'berkas/' . $korwilName . '/' . $nim . '_' . $nama;
                $data[$fileField] = $request->file($fileField)->storeAs($folder, $newFileName, 'public');
            } else {
                unset($data[$fileField]); // Don't overwrite with null if not uploaded
            }
        }
        $berkas = Berkas::create($data);
        // Create Validasi automatically
        $idTim = $user->Id_Tim ?? (\App\Models\TimLannyJayaCerdas::first()->Id_Tim ?? 'TLJ_001');
        \App\Models\Validasi::create([
            'Id_Berkas' => $berkas->Id_Berkas,
            'Id_Mahasiswa' => $user->Id_Mahasiswa,
            'Id_Tim' => $idTim,
            'Status_Berkas' => 'menunggu_verifikasi',
        ]);
        return redirect()->route('mahasiswa.upload-berkas')->with('success', 'Berkas uploaded successfully.');
    }

    public function reupload(Request $request)
    {
        $user = Auth::user();
        $berkas = Berkas::where('Id_Mahasiswa', $user->Id_Mahasiswa)->first();
        if ($berkas) {
            // Delete validasi related to this berkas
            Validasi::where('Id_Berkas', $berkas->Id_Berkas)->delete();
            // Delete berkas files from storage
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
                if ($berkas->$fileField) {
                    \Storage::disk('public')->delete($berkas->$fileField);
                }
            }
            // Delete the berkas record
            $berkas->delete();
        }
        return redirect()->route('mahasiswa.upload-berkas')->with('success', 'Silakan upload ulang berkas Anda.');
    }

    public function edit($id)
    {
        $berkas = Berkas::findOrFail($id);
        return view('mahasiswa.berkas.edit', compact('berkas'));
    }
}
