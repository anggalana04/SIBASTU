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
        $pendaftaran = Validasi::with([
                'mahasiswa.korwil:Id_Korwil,Nama_Korwil',
                'mahasiswa:Id_Mahasiswa,Nama_Mahasiswa,NIM,Jurusan,Semester,Universitas,Id_Korwil',
                'berkas:Id_Berkas,Id_Mahasiswa,Nomor_Rekening,Nama_Bank,Lampiran_aktifkuliah,Lampiran_kpm,Lampiran_ktp,Lampiran_dns,Lampiran_kk,Lampiran_rekomendasi,created_at'
            ])
            ->orderBy('Tgl_Validasi', 'desc')
            ->paginate(20);

        return view('laporan.pendaftaran', compact('pendaftaran'));
    }

    /**
     * Laporan Pemberian Bantuan
     * Menampilkan mahasiswa yang sudah menerima bantuan.
     */
    public function laporanBantuan(Request $request)
    {
        $bantuan = InformasiPemberianBantuan::where('Status_Bantuan', 'disalurkan')
            ->with([
                'mahasiswa.korwil:Id_Korwil,Nama_Korwil',
                'mahasiswa:Id_Mahasiswa,Nama_Mahasiswa,NIM,Id_Korwil',
                'bantuanStudi:Id_Bantuan,Jenis_Bantuan,Nominal,Periode_Bantuan,Tahun_Penerimaan',
                'korwil:Id_Korwil,Nama_Korwil'
            ])
            ->orderBy('Tgl_Penyaluran', 'desc')
            ->paginate(20);

        return view('laporan.bantuan', compact('bantuan'));
    }
}
