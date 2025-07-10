@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Forum Diskusi Mahasiswa</h1>
    <a href="{{ route('forum-diskusi.create') }}" class="btn btn-primary mb-3">Buat Forum</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($forums as $f)
            <tr>
                <td>{{ $f->Id_Forum_Diskusi }}</td>
                <td>{{ $f->Judul }}</td>
                <td>{{ $f->Deskripsi }}</td>
                <td>
                    <a href="{{ route('forum-diskusi.show', $f->Id_Forum_Diskusi) }}" class="btn btn-info btn-sm">Lihat</a>
                    <form action="{{ route('forum-diskusi.destroy', $f->Id_Forum_Diskusi) }}" method="POST" style="display:inline-block">
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
