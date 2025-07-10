@extends('layouts.app')
@section('content')
<div class="container mahasiswa-content">
    <h1>Tambah Mahasiswa</h1>
    <form action="{{ route('mahasiswa.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>ID Mahasiswa</label>
            <input type="text" name="Id_Mahasiswa" class="form-control" value="{{ old('Id_Mahasiswa') }}" readonly placeholder="Otomatis">
        </div>
        <div class="mb-3">
            <label>ID Bantuan</label>
            <input type="text" name="Id_Bantuan" class="form-control" value="{{ old('Id_Bantuan') }}">
        </div>
        <div class="mb-3">
            <label>ID Universitas</label>
            <input type="text" name="Id_Universitas" class="form-control" value="{{ old('Id_Universitas') }}">
        </div>
        <div class="mb-3">
            <label>Nama Mahasiswa</label>
            <input type="text" name="Nama_Mahasiswa" class="form-control" value="{{ old('Nama_Mahasiswa') }}" required>
        </div>
        <div class="mb-3">
            <label>Jurusan</label>
            <input type="text" name="Jurusan" class="form-control" value="{{ old('Jurusan') }}" required>
        </div>
        <div class="mb-3">
            <label>Semester</label>
            <input type="number" name="Semester" class="form-control" value="{{ old('Semester') }}">
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="Alamat" class="form-control" value="{{ old('Alamat') }}">
        </div>
        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="No_hp" class="form-control" value="{{ old('No_hp') }}">
        </div>
        <div class="mb-3">
            <label>Laporan Aktif Kuliah</label>
            <input type="text" name="Laporan_Aktifkuliah" class="form-control" value="{{ old('Laporan_Aktifkuliah') }}">
        </div>
        <div class="mb-3">
            <label>Laporan KPM</label>
            <input type="text" name="Laporan_Kpm" class="form-control" value="{{ old('Laporan_Kpm') }}">
        </div>
        <div class="mb-3">
            <label>Laporan DNS</label>
            <input type="text" name="Laporan_Dns" class="form-control" value="{{ old('Laporan_Dns') }}">
        </div>
        <div class="mb-3">
            <label>Laporan KK</label>
            <input type="text" name="Laporan_Kk" class="form-control" value="{{ old('Laporan_Kk') }}">
        </div>
        <div class="mb-3">
            <label>Laporan Tabungan</label>
            <input type="text" name="Laporan_Tabungan" class="form-control" value="{{ old('Laporan_Tabungan') }}">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
