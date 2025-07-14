@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/dashboard-mahasiswa.css') }}">
<div class="dashboard-tim-container modern-dashboard" style="padding:32px 0;display:flex;flex-direction:column;align-items:center;">
    <h1 class="dashboard-title" style="text-align:center;">Dashboard Dinas</h1>
    <div class="dashboard-stats-row" style="display:flex;gap:24px;flex-wrap:wrap;justify-content:center;width:100%;max-width:1200px;">
        <div class="dashboard-stat-card">
            <div class="stat-title">Total Mahasiswa</div>
            <div class="stat-value">{{ $totalMahasiswa }}</div>
        </div>
        <div class="dashboard-stat-card">
            <div class="stat-title">Sudah Mendaftar</div>
            <div class="stat-value">{{ $mahasiswaMendaftar }}</div>
        </div>
        <div class="dashboard-stat-card">
            <div class="stat-title">Sudah Upload Berkas</div>
            <div class="stat-value">{{ $mahasiswaUploadBerkas }}</div>
        </div>
        <div class="dashboard-stat-card">
            <div class="stat-title">Sudah Terverifikasi</div>
            <div class="stat-value">{{ $mahasiswaTerverifikasi }}</div>
        </div>
        <div class="dashboard-stat-card">
            <div class="stat-title">Sudah Menerima Bantuan</div>
            <div class="stat-value">{{ $mahasiswaMenerimaBantuan }}</div>
        </div>
        <div class="dashboard-stat-card">
            <div class="stat-title">Total Dana Tersalurkan</div>
            <div class="stat-value">Rp {{ number_format($totalDanaTersalurkan,0,',','.') }}</div>
        </div>
    </div>
</div>
@endsection
