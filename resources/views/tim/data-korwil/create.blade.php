@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/index-data-mahasiswa.css') }}">
<div class="form-korwil-container">
    <h2>Tambah Korwil</h2>
    <form action="{{ route('korwil.store') }}" method="POST" class="form-korwil">
        @csrf
        <div class="form-group">
            <label for="Nama_Korwil">Nama Korwil</label>
            <input type="text" name="Nama_Korwil" id="Nama_Korwil" required maxlength="100">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('tim.data-korwil') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
