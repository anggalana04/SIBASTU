@extends('layouts.app')
@section('content')
<div class="container mahasiswa-content">
    <h1>Informasi Pemberian Bantuan Studi</h1>
    <form method="GET" action="#" class="row g-3 mb-4">
        <div class="col-md-3">
            <label class="form-label">Tahun</label>
            <select name="tahun" class="form-select">
                <option value="">2024-2025</option>
                <option value="">2025-2026</option>
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Jenis Informasi</label>
            <select name="jenis" class="form-select">
                <option value="">Bantuan Studi</option>
                <option value="">Beasiswa</option>
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Kuota</label>
            <select name="kuota" class="form-select">
                <option value="">1.700.000</option>
                <option value="">2.000.000</option>
            </select>
        </div>
        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Tampilkan</button>
        </div>
    </form>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header bg-info text-white">Syarat & Ketentuan</div>
                <div class="card-body">
                    <ul>
                        <li>Fotocopy KTP dan NPWP</li>
                        <li>Surat Keterangan Aktif Kuliah</li>
                        <li>Transkrip Nilai Terbaru</li>
                        <li>Proposal Studi Asli</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header bg-success text-white">Jadwal Pendaftaran dan Penyaluran</div>
                <div class="card-body">
                    <ul>
                        <li>Pendaftaran Dibuka: 01 Juni 2025</li>
                        <li>Pendaftaran Ditutup: 20 Juni 2025</li>
                        <li>Seleksi Berkas: 21-25 Juni 2025</li>
                        <li>Pengumuman: 28 Juni 2025</li>
                        <li>Penyaluran: 01 Juli 2025</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <a href="#" class="btn btn-danger"><i class="bi bi-download"></i> Unduh Jadwal</a>
        <div class="mt-2">Kontak Tim Lanny Jaya Cerdas: 628-xxxx-xxxx</div>
    </div>
</div>
@endsection
