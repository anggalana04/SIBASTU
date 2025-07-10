@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Data Mahasiswa</h1>
    <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary mb-3">Tambah Mahasiswa</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>Semester</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mahasiswas as $m)
            <tr>
                <td>{{ $m->Id_Mahasiswa }}</td>
                <td>{{ $m->Nama_Mahasiswa }}</td>
                <td>{{ $m->Jurusan }}</td>
                <td>{{ $m->Semester }}</td>
                <td>{{ $m->Alamat }}</td>
                <td>{{ $m->No_hp }}</td>
                <td>
                    <a href="{{ route('mahasiswa.show', $m->Id_Mahasiswa) }}" class="btn btn-info btn-sm">Lihat</a>
                    <a href="{{ route('mahasiswa.edit', $m->Id_Mahasiswa) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('mahasiswa.destroy', $m->Id_Mahasiswa) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
