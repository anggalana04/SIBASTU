@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/index-data-mahasiswa.css') }}">
<div class="form-korwil-container">
    <h2>Edit Korwil</h2>
    <form action="{{ route('korwil.update', $korwil->Id_Korwil) }}" method="POST" class="form-korwil">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="Nama_Korwil">Nama Korwil</label>
            <input type="text" name="Nama_Korwil" id="Nama_Korwil" value="{{ $korwil->Nama_Korwil }}" required maxlength="100">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('tim.data-korwil') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
