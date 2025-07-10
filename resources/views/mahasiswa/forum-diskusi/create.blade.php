@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Buat Forum Diskusi</h1>
    <form action="{{ route('forum-diskusi.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="Judul" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="Deskripsi" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Buat</button>
        <a href="{{ route('forum-diskusi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
