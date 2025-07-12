@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/akun.css') }}">
<div class="akun-container">
    <h2>Manajemen Akun</h2>
    <a href="{{ route('tim.akun.create') }}" class="btn btn-primary mb-3">+ Tambah Akun</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="table-responsive">
        <table class="table table-striped akun-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Akun</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($akun as $i => $a)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $a->Nama_Akun }}</td>
                        <td><span class="badge badge-role badge-{{ $a->role }}">{{ ucfirst($a->role) }}</span></td>
                        <td>
                            <a href="{{ route('tim.akun.edit', ['id' => $a->Id_Akun]) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('tim.akun.destroy', ['id' => $a->Id_Akun]) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus akun ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
