<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InformasiPemberianBantuan;
use App\Models\BantuanStudi;

class InformasiPemberianBantuanController extends Controller
{
    public function index(Request $request)
    {
        $query = InformasiPemberianBantuan::with(['mahasiswa', 'bantuanStudi']);

        // Filtering
        if ($request->filled('periode')) {
            $query->whereHas('bantuanStudi', function ($q) use ($request) {
                $q->where('Periode_Bantuan', $request->periode);
            });
        }
        if ($request->filled('jenis')) {
            $query->whereHas('bantuanStudi', function ($q) use ($request) {
                $q->where('Jenis_Bantuan', $request->jenis);
            });
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('mahasiswa', function ($q) use ($search) {
                $q->where('Nama_Mahasiswa', 'like', "%$search%")
                    ->orWhere('NIM', 'like', "%$search%")
                    ->orWhere('Universitas', 'like', "%$search%")
                    ->orWhere('Jurusan', 'like', "%$search%")
                ;
            });
        }
        $periodeList = \App\Models\BantuanStudi::distinct()->pluck('Periode_Bantuan')->filter()->values();
        $jenisList = \App\Models\BantuanStudi::distinct()->pluck('Jenis_Bantuan')->filter()->values();
        $pengumuman = \App\Models\PengumumanBantuanStudi::first();

        return view('tim.informasi-pemberian', compact('informasiList', 'periodeList', 'jenisList', 'pengumuman'));
    }

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
