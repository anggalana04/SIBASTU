<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Validasi;
use App\Models\InformasiPemberianBantuan;

class LaporanController extends Controller
{
    /**
     * Laporan Pendaftaran Mahasiswa
     * Menampilkan mahasiswa yang sudah upload berkas dan status validasinya.
     */
    public function laporanPendaftaran(Request $request)
    {
        $korwilList = \App\Models\Korwil::all();
        $pendaftaranQuery = \App\Models\Validasi::with([
            'mahasiswa.korwil:Id_Korwil,Nama_Korwil',
            'mahasiswa:Id_Mahasiswa,Nama_Mahasiswa,NIM,Jurusan,Semester,Universitas,Id_Korwil',
            'berkas:Id_Berkas,Id_Mahasiswa,Nomor_Rekening,Nama_Bank,Lampiran_aktifkuliah,Lampiran_kpm,Lampiran_ktp,Lampiran_dns,Lampiran_kk,Lampiran_rekomendasi,created_at'
        ]);

        // Filtering by Korwil
        if ($request->filled('korwil')) {
            $pendaftaranQuery->whereHas('mahasiswa', function ($q) use ($request) {
                $q->where('Id_Korwil', $request->korwil);
            });
        }
        // Filtering by Status Berkas
        if ($request->filled('status')) {
            $pendaftaranQuery->where('Status_Berkas', $request->status);
        }
        // Search by Nama/NIM/Universitas
        if ($request->filled('search')) {
            $search = $request->search;
            $pendaftaranQuery->whereHas('mahasiswa', function ($q) use ($search) {
                $q->where('Nama_Mahasiswa', 'like', "%$search%")
                    ->orWhere('NIM', 'like', "%$search%")
                    ->orWhere('Universitas', 'like', "%$search%")
                ;
            });
        }
        $pendaftaran = $pendaftaranQuery->orderBy('Tgl_Validasi', 'desc')->paginate(20)->appends($request->all());
        return view('laporan.pendaftaran', compact('pendaftaran', 'korwilList'));
    }

    /**
     * Laporan Pemberian Bantuan
     * Menampilkan mahasiswa yang sudah menerima bantuan.
     */
    public function laporanBantuan(Request $request)
    {
        $periodeList = \App\Models\BantuanStudi::distinct()->pluck('Periode_Bantuan')->filter()->values();
        $jenisList = \App\Models\BantuanStudi::distinct()->pluck('Jenis_Bantuan')->filter()->values();
        $bantuanQuery = \App\Models\InformasiPemberianBantuan::where('Status_Bantuan', 'disalurkan')
            ->with([
                'mahasiswa.korwil:Id_Korwil,Nama_Korwil',
                'mahasiswa:Id_Mahasiswa,Nama_Mahasiswa,NIM,Id_Korwil',
                'bantuanStudi:Id_Bantuan,Jenis_Bantuan,Nominal,Periode_Bantuan,Tahun_Penerimaan',
                'korwil:Id_Korwil,Nama_Korwil'
            ]);
        if ($request->filled('periode')) {
            $bantuanQuery->whereHas('bantuanStudi', function ($q) use ($request) {
                $q->where('Periode_Bantuan', $request->periode);
            });
        }
        if ($request->filled('jenis')) {
            $bantuanQuery->whereHas('bantuanStudi', function ($q) use ($request) {
                $q->where('Jenis_Bantuan', $request->jenis);
            });
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $bantuanQuery->whereHas('mahasiswa', function ($q) use ($search) {
                $q->where('Nama_Mahasiswa', 'like', "%$search%")
                    ->orWhere('NIM', 'like', "%$search%")
                    ->orWhere('Universitas', 'like', "%$search%")
                ;
            });
        }
        $bantuan = $bantuanQuery->orderBy('Tgl_Penyaluran', 'desc')->paginate(20)->appends($request->all());
        return view('laporan.bantuan', compact('bantuan', 'periodeList', 'jenisList'));
    }

    /**
     * Export Laporan Pendaftaran Mahasiswa to PDF
     */
    public function exportPendaftaranPdf(Request $request)
    {
        $pendaftaranQuery = \App\Models\Validasi::with([
            'mahasiswa.korwil:Id_Korwil,Nama_Korwil',
            'mahasiswa:Id_Mahasiswa,Nama_Mahasiswa,NIM,Jurusan,Semester,Universitas,Id_Korwil',
            'berkas:Id_Berkas,Id_Mahasiswa,Nomor_Rekening,Nama_Bank,Lampiran_aktifkuliah,Lampiran_kpm,Lampiran_ktp,Lampiran_dns,Lampiran_kk,Lampiran_rekomendasi,created_at'
        ]);
        if ($request->filled('korwil')) {
            $pendaftaranQuery->whereHas('mahasiswa', function ($q) use ($request) {
                $q->where('Id_Korwil', $request->korwil);
            });
        }
        if ($request->filled('status')) {
            $pendaftaranQuery->where('Status_Berkas', $request->status);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $pendaftaranQuery->whereHas('mahasiswa', function ($q) use ($search) {
                $q->where('Nama_Mahasiswa', 'like', "%$search%")
                    ->orWhere('NIM', 'like', "%$search%")
                    ->orWhere('Universitas', 'like', "%$search%")
                ;
            });
        }
        $pendaftaran = $pendaftaranQuery->orderBy('Tgl_Validasi', 'desc')->get();
        $pdf = \Barryvdh\DomPDF\Facades\Pdf::loadView('laporan.pendaftaran_pdf', compact('pendaftaran'));
        return $pdf->download('laporan_pendaftaran_mahasiswa.pdf');
    }
}
