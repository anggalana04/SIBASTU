@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Mahasiswa</h1>
    <div class="mb-3">
        <strong>ID:</strong> {{ $mahasiswa->Id_Mahasiswa }}
    </div>
    <div class="mb-3">
        <strong>Nama:</strong> {{ $mahasiswa->Nama_Mahasiswa }}
    </div>
    <div class="mb-3">
        <strong>Jurusan:</strong> {{ $mahasiswa->Jurusan }}
    </div>
    <div class="mb-3">
        <strong>Semester:</strong> {{ $mahasiswa->Semester }}
    </div>
    <div class="mb-3">
        <strong>Alamat:</strong> {{ $mahasiswa->Alamat }}
    </div>
    <div class="mb-3">
        <strong>No HP:</strong> {{ $mahasiswa->No_hp }}
    </div>
    <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Kembali</a>
    <a href="{{ route('mahasiswa.edit', $mahasiswa->Id_Mahasiswa) }}" class="btn btn-warning">Edit</a>
</div>
@endsection
