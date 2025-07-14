<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PengumumanBantuanStudi;
use App\Models\InformasiPemberianBantuan;

class MahasiswaPengumumanController extends Controller
{
    // Mahasiswa view
    public function index(Request $request)
    {
        $user = Auth::user();
        // Ensure only mahasiswa can access and only their own data is shown
        if ($user->role !== 'mahasiswa' || !$user->Id_Mahasiswa) {
            abort(403, 'Unauthorized');
        }
        $informasiList = collect();
        $periodeList = \App\Models\BantuanStudi::distinct()->pluck('Periode_Bantuan')->filter()->values();
        $jenisList = \App\Models\BantuanStudi::distinct()->pluck('Jenis_Bantuan')->filter()->values();
        if ($user->Id_Mahasiswa) {

            $mahasiswa = \App\Models\Mahasiswa::where('Id_Mahasiswa', $user->Id_Mahasiswa)->first();

            if ($mahasiswa) {
                $query = \App\Models\InformasiPemberianBantuan::with(['mahasiswa', 'bantuanStudi'])
                    ->where('Id_Mahasiswa', $mahasiswa->Id_Mahasiswa);
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
                    $query->whereHas('bantuanStudi', function ($q) use ($search) {
                        $q->where('Jenis_Bantuan', 'like', "%$search%")
                            ->orWhere('Periode_Bantuan', 'like', "%$search%")
                        ;
                    });
                }
                // Only apply filters if at least one filter is filled, otherwise get all
                if ($request->filled('periode') || $request->filled('jenis') || $request->filled('search')) {
                    $informasiList = $query->get();
                } else {
                    $informasiList = \App\Models\InformasiPemberianBantuan::with(['mahasiswa', 'bantuanStudi'])
                        ->where('Id_Mahasiswa', $mahasiswa->Id_Mahasiswa)
                        ->get();
                }
            } else {
                $informasiList = collect(); // kosong
            }
        }


        $pengumuman = PengumumanBantuanStudi::first();
        return view('mahasiswa.informasi-pemberian', compact('informasiList', 'pengumuman', 'periodeList', 'jenisList'));
    }
}
