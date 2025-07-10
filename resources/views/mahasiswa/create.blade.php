@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Mahasiswa</h1>
    <form action="{{ route('mahasiswa.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>ID Mahasiswa</label>
            <input type="text" name="Id_Mahasiswa" class="form-control" value="{{ old('Id_Mahasiswa') }}" readonly placeholder="Otomatis">
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
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
