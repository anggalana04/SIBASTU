@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/upload-berkas.css') }}">
@php
    $berkas = null;
    $status = null;
    if(Auth::user() && Auth::user()->Id_Mahasiswa) {
        $berkas = \App\Models\Berkas::where('Id_Mahasiswa', Auth::user()->Id_Mahasiswa)->first();
        if ($berkas) {
            $validasi = \App\Models\Validasi::where('Id_Berkas', $berkas->Id_Berkas)->first();
            $status = $validasi ? ($validasi->Status_Berkas ?? 'Menunggu Verifikasi') : 'Menunggu Verifikasi';
        }
    }
@endphp
@if($berkas)
    <div class="upload-berkas-container">
        <div class="upload-berkas-form" style="text-align:center;">
            <h1>Upload Berkas</h1>
            <div style="background:#e6f9ed;color:#218838;border:1.5px solid #34c759;padding:1.2rem 1.2rem;border-radius:7px;margin-bottom:1.2rem;">
                Anda sudah melakukan upload berkas.<br>
                Silakan menunggu berkas untuk diverifikasi.<br>
                <b>Status berkas saat ini:</b> {{ $status }}
            </div>
            @if(isset($validasi) && $validasi && ($validasi->Status_Berkas === 'ditolak') && $validasi->Catatan)
                <div style="background:#fff4f4;color:#b91c1c;border:1.5px solid #ef4444;padding:1.2rem 1.2rem;border-radius:7px;margin-bottom:1.2rem;">
                    <b>Catatan Penolakan:</b><br>
                    {{ $validasi->Catatan }}
                </div>
                <div style="margin-bottom:1.2rem;">
                    <span style="color:#b91c1c;font-weight:600;">Silahkan upload berkas kembali.</span>
                </div>
                <a href="{{ route('berkas.create') }}" class="btn btn-primary">Upload Berkas</a>
            @endif
        </div>
    </div>
@else
<div class="upload-berkas-container">
    <form action="{{ route('berkas.store') }}" method="POST" enctype="multipart/form-data" class="upload-berkas-form">
        <h1>Upload Berkas</h1>
        @csrf
        <div class="mb-3">
            <label>Nomor Rekening</label>
            <input type="text" name="Nomor_Rekening" value="{{ old('Nomor_Rekening') }}" required>
        </div>
        <div class="mb-3">
            <label>Nama Bank</label>
            <input type="text" name="Nama_Bank" value="{{ old('Nama_Bank') }}" required>
        </div>
        <div class="mb-3">
            <label>Lampiran Aktif Kuliah</label>
            <input type="file" name="Lampiran_aktifkuliah">
        </div>
        <div class="mb-3">
            <label>Lampiran KPM</label>
            <input type="file" name="Lampiran_kpm">
        </div>
        <div class="mb-3">
            <label>Lampiran KTP</label>
            <input type="file" name="Lampiran_ktp">
        </div>
        <div class="mb-3">
            <label>Lampiran DNS</label>
            <input type="file" name="Lampiran_dns">
        </div>
        <div class="mb-3">
            <label>Lampiran KK</label>
            <input type="file" name="Lampiran_kk">
        </div>
        <div class="mb-3">
            <label>Lampiran Rekomendasi</label>
            <input type="file" name="Lampiran_rekomendasi">
        </div>
        <div style="display: flex; gap: 0.7rem;">
            <button type="submit" class="btn btn-primary">Upload</button>
            <a href="{{ route('berkas.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endif
@endsection
