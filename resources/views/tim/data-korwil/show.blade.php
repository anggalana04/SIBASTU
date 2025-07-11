@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/index-data-mahasiswa.css') }}">
<div class="form-korwil-container">
    <h2>Detail Korwil</h2>
    <div class="form-group">
        <label>ID Korwil</label>
        <div class="form-control-static">{{ $korwil->Id_Korwil }}</div>
    </div>
    <div class="form-group">
        <label>Nama Korwil</label>
        <div class="form-control-static">{{ $korwil->Nama_Korwil }}</div>
    </div>
    <a href="{{ route('tim.data-korwil') }}" class="btn btn-secondary">Kembali</a>
    <a href="{{ route('korwil.edit', $korwil->Id_Korwil) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('korwil.destroy', $korwil->Id_Korwil) }}" method="POST" style="display:inline-block">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
    </form>
</div>
@endsection
