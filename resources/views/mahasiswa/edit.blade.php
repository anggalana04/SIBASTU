@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Mahasiswa</h1>
    <form action="{{ route('mahasiswa.update', $mahasiswa->Id_Mahasiswa) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nama Mahasiswa</label>
            <input type="text" name="Nama_Mahasiswa" class="form-control" value="{{ $mahasiswa->Nama_Mahasiswa }}" required>
        </div>
        <div class="mb-3">
            <label>Jurusan</label>
            <input type="text" name="Jurusan" class="form-control" value="{{ $mahasiswa->Jurusan }}" required>
        </div>
        <div class="mb-3">
            <label>Semester</label>
            <input type="number" name="Semester" class="form-control" value="{{ $mahasiswa->Semester }}">
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="Alamat" class="form-control" value="{{ $mahasiswa->Alamat }}">
        </div>
        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="No_hp" class="form-control" value="{{ $mahasiswa->No_hp }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
