@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/buat-forum-diskusi.css') }}">
<div class="buat-forum-container">
    <h1>Buat Forum Diskusi</h1>
    <form action="{{ route('forum-diskusi.store') }}" method="POST" class="buat-forum-form">
        @csrf
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="Judul" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="Deskripsi"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Buat</button>
        <a href="{{ route('forum-diskusi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
