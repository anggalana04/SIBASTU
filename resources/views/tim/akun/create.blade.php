@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/akun.css') }}">
<div class="akun-container">
    <h2>Tambah Akun</h2>
    <form action="{{ route('tim.akun.store') }}" method="POST" class="akun-form">
        @csrf
        <div class="form-group">
            <label for="Nama_Akun">Nama Akun</label>
            <input type="text" name="Nama_Akun" id="Nama_Akun" class="form-control" value="{{ old('Nama_Akun', $akun->Nama_Akun ?? '') }}" required maxlength="255">
            @error('Nama_Akun')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control" required>
                <option value="">Pilih Role</option>
                <option value="mahasiswa" {{ old('role', $akun->role ?? '') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                <option value="korwil" {{ old('role', $akun->role ?? '') == 'korwil' ? 'selected' : '' }}>Korwil</option>
                <option value="tim" {{ old('role', $akun->role ?? '') == 'tim' ? 'selected' : '' }}>Tim</option>
                <option value="dinas" {{ old('role', $akun->role ?? '') == 'dinas' ? 'selected' : '' }}>Dinas</option>
            </select>
            @error('role')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="Password">Password</label>
            <input type="password" name="Password" id="Password" class="form-control" {{ isset($akun) ? '' : 'required' }} minlength="6">
            @error('Password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('tim.akun.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
