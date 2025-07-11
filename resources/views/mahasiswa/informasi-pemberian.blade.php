@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/informasi-pemberian.css') }}">
<div class="main-content">
    <h1>Informasi Pemberian Bantuan Studi</h1>
    <form method="GET" action="#" class="informasi-pemberian-form">
        <div class="informasi-pemberian-form-row">
            <div>
                <label class="form-label">Tahun</label>
                <select name="tahun">
                    <option value="">2024-2025</option>
                    <option value="">2025-2026</option>
                </select>
            </div>
            <div>
                <label class="form-label">Jenis Informasi</label>
                <select name="jenis">
                    <option value="">Bantuan Studi</option>
                    <option value="">Beasiswa</option>
                </select>
            </div>
            <div>
                <label class="form-label">Kuota</label>
                <select name="kuota">
                    <option value="">1.700.000</option>
                    <option value="">2.000.000</option>
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Tampilkan</button>
            </div>
        </div>
    </form>
    <div class="informasi-pemberian-flex">
        <div class="informasi-pemberian-box syarat">
            <div class="box-title">Syarat & Ketentuan</div>
            <ul>
                <li>Fotocopy KTP dan NPWP</li>
                <li>Surat Keterangan Aktif Kuliah</li>
                <li>Transkrip Nilai Terbaru</li>
                <li>Proposal Studi Asli</li>
            </ul>
        </div>
        <div class="informasi-pemberian-box jadwal">
            <div class="box-title">Jadwal Pendaftaran dan Penyaluran</div>
            <ul>
                <li>Pendaftaran Dibuka: 01 Juni 2025</li>
                <li>Pendaftaran Ditutup: 20 Juni 2025</li>
                <li>Seleksi Berkas: 21-25 Juni 2025</li>
                <li>Pengumuman: 28 Juni 2025</li>
                <li>Penyaluran: 01 Juli 2025</li>
            </ul>
        </div>
    </div>
    <div class="mt-4">
        <a href="#" class="btn btn-danger">Unduh Jadwal</a>
        <div class="mt-2">Kontak Tim Lanny Jaya Cerdas: 628-xxxx-xxxx</div>
    </div>
</div>
@endsection
