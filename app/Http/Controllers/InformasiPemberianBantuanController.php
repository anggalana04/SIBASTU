<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InformasiPemberianBantuan;
use App\Models\BantuanStudi;

class InformasiPemberianBantuanController extends Controller
{
    public function show($id)
    {
        $info = InformasiPemberianBantuan::with(['mahasiswa.berkas', 'mahasiswa.korwil', 'bantuanStudi'])->findOrFail($id);
        $jenisBantuanList = BantuanStudi::all();
        return view('tim.informasi-pemberian-show', compact('info', 'jenisBantuanList'));
    }

    public function edit($id)
    {
        $info = InformasiPemberianBantuan::with(['mahasiswa', 'bantuanStudi'])->findOrFail($id);
        $jenisBantuanList = BantuanStudi::all();
        return view('tim.informasi-pemberian-show', compact('info', 'jenisBantuanList'));
    }

    public function update(Request $request, $id)
    {
        $info = InformasiPemberianBantuan::findOrFail($id);
        $request->validate([
            'Id_Bantuan' => 'required|exists:bantuan_studi,Id_Bantuan',
            'Status_Bantuan' => 'required|in:proses,disalurkan,gagal',
            'Tgl_Penyaluran' => 'nullable|date',
            'Keterangan' => 'nullable|string',
        ]);
        $info->update([
            'Id_Bantuan' => $request->Id_Bantuan,
            'Status_Bantuan' => $request->Status_Bantuan,
            'Tgl_Penyaluran' => $request->Tgl_Penyaluran,
            'Keterangan' => $request->Keterangan,
        ]);
        return redirect()->route('tim.informasi-pemberian.show', $info->Id_Informasi)->with('success', 'Keputusan bantuan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $info = InformasiPemberianBantuan::findOrFail($id);
        $info->delete();
        return redirect()->route('tim.informasi-pemberian')->with('success', 'Informasi pemberian bantuan berhasil dihapus.');
    }
}
