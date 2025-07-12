@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/index-data-mahasiswa.css') }}">
<h1>Manajemen Data Mahasiswa</h1>
<div class="data-mahasiswa-container">

    <div class="data-mahasiswa-header">
        <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">Tambah Mahasiswa</a>
    </div>
    <div class="data-mahasiswa-table-wrapper">
        <table class="data-mahasiswa-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                    <th>Semester</th>
                    <th>No HP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mahasiswas as $m)
                <tr>
                    <td>{{ $m->Id_Mahasiswa }}</td>
                    <td>{{ $m->Nama_Mahasiswa }}</td>
                    <td>{{ $m->Jurusan }}</td>
                    <td>{{ $m->Semester }}</td>
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
                @empty
                <tr><td colspan="6" style="text-align:center;color:#64748b;">Belum ada data mahasiswa.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
