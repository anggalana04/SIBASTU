<?php

namespace App\Http\Controllers;

use App\Models\Korwil;
use App\Models\Mahasiswa;
use App\Models\Berkas;
use App\Models\Validasi;
use App\Models\InformasiPemberianBantuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KorwilController extends Controller
{
    public function index()
    {
        $korwils = Korwil::orderBy('Nama_Korwil')->get();
        return view('tim.data-korwil.index', compact('korwils'));
    }

    public function create()
    {
        return view('tim.data-korwil.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Nama_Korwil' => 'required|string|max:100',
        ]);
        Korwil::create($validated);
        return redirect()->route('tim.data-korwil')->with('success', 'Korwil berhasil ditambahkan.');
    }

    public function show($id)
    {
        $korwil = Korwil::findOrFail($id);
        return view('tim.data-korwil.show', compact('korwil'));
    }

    public function edit($id)
    {
        $korwil = Korwil::findOrFail($id);
        return view('tim.data-korwil.edit', compact('korwil'));
    }

    public function update(Request $request, $id)
    {
        $korwil = Korwil::findOrFail($id);
        $validated = $request->validate([
            'Nama_Korwil' => 'required|string|max:100',
        ]);
        $korwil->update($validated);
        return redirect()->route('tim.data-korwil')->with('success', 'Korwil berhasil diupdate.');
    }

    public function destroy($id)
    {
        $korwil = Korwil::findOrFail($id);
        $korwil->delete();
        return redirect()->route('tim.data-korwil')->with('success', 'Korwil berhasil dihapus.');
    }

    public function dashboard()
    {
        $korwil = Auth::user();
        $totalMahasiswa = Mahasiswa::where('Id_Korwil', $korwil->Id_Korwil)->count();
        $mahasiswaMendaftar = Mahasiswa::where('Id_Korwil', $korwil->Id_Korwil)->whereNotNull('created_at')->count();
        $mahasiswaUploadBerkas = Mahasiswa::where('Id_Korwil', $korwil->Id_Korwil)
            ->whereHas('berkas')
            ->count();
        $mahasiswaTerverifikasi = Mahasiswa::where('Id_Korwil', $korwil->Id_Korwil)
            ->whereHas('berkas', function ($q) {
                $q->whereHas('validasi', function ($v) {
                    $v->where('Status_Berkas', 'diverifikasi');
                });
            })->count();
        $mahasiswaMenerimaBantuan = Mahasiswa::where('Id_Korwil', $korwil->Id_Korwil)
            ->whereHas('informasiPemberianBantuan', function ($q) {
                $q->where('Status_Bantuan', 'disalurkan');
            })->count();
        $totalDanaTersalurkan = InformasiPemberianBantuan::whereHas('mahasiswa', function ($q) use ($korwil) {
            $q->where('Id_Korwil', $korwil->Id_Korwil);
        })
            ->where('Status_Bantuan', 'disalurkan')
            ->with('bantuanStudi')
            ->get()
            ->sum(function ($info) {
                return $info->bantuanStudi->Nominal ?? 0;
            });

        return view('korwil.dashboard', compact(
            'totalMahasiswa',
            'mahasiswaMendaftar',
            'mahasiswaUploadBerkas',
            'mahasiswaTerverifikasi',
            'mahasiswaMenerimaBantuan',
            'totalDanaTersalurkan'
        ));
    }
}
