<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BantuanStudi;
use App\Models\InformasiPemberianBantuan;
use App\Models\Mahasiswa;

class TimBantuanStudiController extends Controller
{
    public function index(Request $request)
    {
        $informasiPemberianBantuan = InformasiPemberianBantuan::with(['mahasiswa', 'bantuanStudi'])->latest('Id_Informasi')->get();
        return view('tim.bantuan-studi', compact('informasiPemberianBantuan'));
    }

    public function give($id)
    {
        $bantuan = BantuanStudi::with(['mahasiswa', 'informasiPemberianBantuan'])->findOrFail($id);
        return view('tim.give-bantuan', compact('bantuan'));
    }

    public function storeGive(Request $request, $id)
    {
        $bantuan = BantuanStudi::findOrFail($id);
        $request->validate([
            'Status_Bantuan' => 'required|in:disalurkan,gagal',
            'Keterangan' => 'nullable|string',
            'Tgl_Penyaluran' => 'required|date',
        ]);
        InformasiPemberianBantuan::create([
            'Id_Bantuan' => $bantuan->Id_Bantuan,
            'Id_Mahasiswa' => $bantuan->Id_Mahasiswa,
            'Id_Korwil' => $bantuan->mahasiswa->Id_Korwil ?? null,
            'Status_Bantuan' => $request->Status_Bantuan,
            'Tgl_Penyaluran' => $request->Tgl_Penyaluran,
            'Keterangan' => $request->Keterangan,
        ]);
        return redirect()->route('tim.bantuan-studi')->with('success', 'Bantuan berhasil disalurkan.');
    }

    public function informasiPemberianIndex()
    {
        $informasiList = \App\Models\InformasiPemberianBantuan::with(['mahasiswa.korwil'])->get();
        return view('tim.informasi-pemberian', compact('informasiList'));
    }

    public function create()
    {
        return view('tim.bantuan-studi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Jenis_Bantuan' => 'required',
            'Nominal' => 'required|numeric',
        ]);
        BantuanStudi::create($request->all());
        return redirect()->route('tim.bantuan-studi')->with('success', 'Bantuan studi berhasil ditambah.');
    }

    public function edit($id)
    {
        $bantuanStudi = BantuanStudi::findOrFail($id);
        return view('tim.bantuan-studi.edit', compact('bantuanStudi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Jenis_Bantuan' => 'required',
            'Nominal' => 'required|numeric',
        ]);
        $bantuanStudi = BantuanStudi::findOrFail($id);
        $bantuanStudi->update($request->all());
        return redirect()->route('tim.bantuan-studi')->with('success', 'Bantuan studi berhasil diupdate.');
    }

    public function destroy($id)
    {
        BantuanStudi::destroy($id);
        return redirect()->route('tim.bantuan-studi')->with('success', 'Bantuan studi berhasil dihapus.');
    }

    public function show($id)
    {
        $bantuanStudi = BantuanStudi::findOrFail($id);
        return view('tim.bantuan-studi.show', compact('bantuanStudi'));
    }
}
