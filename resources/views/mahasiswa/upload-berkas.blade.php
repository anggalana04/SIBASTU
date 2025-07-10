@extends('layouts.app')
@section('content')
<div class="container mahasiswa-content">
    <h1>Upload Berkas</h1>
    <form action="{{ route('berkas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>ID Berkas</label>
            <input type="text" name="Id_Berkas" class="form-control" value="{{ old('Id_Berkas') }}" readonly placeholder="Otomatis">
        </div>
        <div class="mb-3">
            <label>ID Mahasiswa</label>
            <input type="text" name="Id_Mahasiswa" class="form-control" value="{{ old('Id_Mahasiswa') }}" readonly placeholder="Otomatis">
        </div>
        <div class="mb-3">
            <label>Nomor Rekening</label>
            <input type="text" name="Nomor_Rekening" class="form-control" value="{{ old('Nomor_Rekening') }}" required>
        </div>
        <div class="mb-3">
            <label>Nama Bank</label>
            <input type="text" name="Nama_Bank" class="form-control" value="{{ old('Nama_Bank') }}" required>
        </div>
        <div class="mb-3">
            <label>Lampiran Aktif Kuliah</label>
            <input type="file" name="Lampiran_aktifkuliah" class="form-control">
        </div>
        <div class="mb-3">
            <label>Lampiran KPM</label>
            <input type="file" name="Lampiran_kpm" class="form-control">
        </div>
        <div class="mb-3">
            <label>Lampiran KTP</label>
            <input type="file" name="Lampiran_ktp" class="form-control">
        </div>
        <div class="mb-3">
            <label>Lampiran DNS</label>
            <input type="file" name="Lampiran_dns" class="form-control">
        </div>
        <div class="mb-3">
            <label>Lampiran KK</label>
            <input type="file" name="Lampiran_kk" class="form-control">
        </div>
        <div class="mb-3">
            <label>Lampiran Rekomendasi</label>
            <input type="file" name="Lampiran_rekomendasi" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
        <a href="{{ route('berkas.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
