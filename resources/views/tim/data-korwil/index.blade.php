@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/data-korwil.css') }}">
<h1 style="margin-left: 2rem">Manajemen Data Korwil</h1>
<div class="data-korwil-container">
    <div class="data-korwil-header">
        <a href="{{ route('korwil.create') }}" class="btn btn-primary">Tambah Korwil</a>
    </div>
    <div class="data-korwil-table-wrapper">
        <table class="data-mahasiswa-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Korwil</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($korwils as $k)
                <tr>
                    <td>{{ $k->Id_Korwil }}</td>
                    <td>{{ $k->Nama_Korwil }}</td>
                    <td>
                        <a href="{{ route('korwil.show', $k->Id_Korwil) }}" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('korwil.edit', $k->Id_Korwil) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('korwil.destroy', $k->Id_Korwil) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" style="text-align:center;color:#64748b;">Belum ada data korwil.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
