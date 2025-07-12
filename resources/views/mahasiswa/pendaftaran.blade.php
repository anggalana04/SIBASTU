@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{asset('css/pendaftaran.css')}}">
@php
    $mahasiswa = null;
    if(Auth::user() && Auth::user()->Id_Mahasiswa) {
        $mahasiswa = \App\Models\Mahasiswa::find(Auth::user()->Id_Mahasiswa);
    }
@endphp
<div class="pendaftaran-layout">
    <main class="pendaftaran-main">
        <form action="{{ $mahasiswa ? route('mahasiswa.update', $mahasiswa->Id_Mahasiswa) : route('mahasiswa.store') }}" method="POST" class="pendaftaran-form" enctype="multipart/form-data">
            <h1 class="pendaftaran-title">Pendaftaran</h1>
            @csrf
            @if($mahasiswa)
                @method('PUT')
            @endif
            @if(session('success'))
                <div class="alert alert-success" style="background:#d1f7d6;color:#176b2c;border:2px solid #34c759;padding:1rem 1.2rem;border-radius:7px;margin-bottom:1.2rem;text-align:center;">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger" style="background:#ffeaea;color:#b91c1c;border:1.5px solid #f87171;padding:1rem 1.2rem;border-radius:7px;margin-bottom:1.2rem;text-align:center;">
                    {{ session('error') }}
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger" style="background:#ffeaea;color:#b91c1c;border:1.5px solid #f87171;padding:1rem 1.2rem;border-radius:7px;margin-bottom:1.2rem;">
                    <ul style="margin:0;padding-left:1.2rem;text-align:left;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-columns">
                <div class="form-col">
                    <div class="form-group">
                        <label>NIM</label>
                        <input type="text" name="NIM" value="{{ old('NIM', $mahasiswa?->NIM) }}" required @if($mahasiswa) readonly disabled @endif>
                    </div>
                    <div class="form-group">
                        <label>Nama Mahasiswa</label>
                        <input type="text" name="Nama_Mahasiswa" value="{{ old('Nama_Mahasiswa', $mahasiswa?->Nama_Mahasiswa) }}" required @if($mahasiswa) readonly disabled @endif>
                    </div>
                    <div class="form-group">
                        <label>Universitas</label>
                        <input type="text" name="Universitas" value="{{ old('Universitas', $mahasiswa?->Universitas) }}" @if($mahasiswa) readonly disabled @endif>
                    </div>
                    <div class="form-group">
                        <label>Jurusan</label>
                        <input type="text" name="Jurusan" value="{{ old('Jurusan', $mahasiswa?->Jurusan) }}" required @if($mahasiswa) readonly disabled @endif>
                    </div>
                    <div class="form-group">
                        <label>Semester</label>
                        <input type="number" name="Semester" value="{{ old('Semester', $mahasiswa?->Semester) }}" @if($mahasiswa) readonly disabled @endif>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="Alamat" value="{{ old('Alamat', $mahasiswa?->Alamat) }}" @if($mahasiswa) readonly disabled @endif>
                    </div>
                    <div class="form-group">
                        <label>No Hp</label>
                        <input type="text" name="No_hp" value="{{ old('No_hp', $mahasiswa?->No_hp) }}" @if($mahasiswa) readonly disabled @endif>
                    </div>
                    <div class="form-group">
                        <label>Pilih Korwil</label>
                        <select name="Id_Korwil" class="styled-select" required @if($mahasiswa) readonly disabled @endif>
                            <option value="">-- Pilih Korwil --</option>
                            @foreach(\App\Models\Korwil::orderBy('Nama_Korwil')->get() as $korwil)
                                <option value="{{ $korwil->Id_Korwil }}" {{ old('Id_Korwil', $mahasiswa?->Id_Korwil) == $korwil->Id_Korwil ? 'selected' : '' }}>{{ $korwil->Nama_Korwil }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group actions">
                @if($mahasiswa)
                    <button type="button" class="btn-primary full-width" id="editBtn">Edit Data</button>
                @else
                    <button type="submit" class="btn-primary full-width">Pendaftaran</button>
                @endif
            </div>
        </form>
    </main>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var editBtn = document.getElementById('editBtn');
        if(editBtn) {
            editBtn.addEventListener('click', function() {
                document.querySelectorAll('.pendaftaran-form input').forEach(function(input) {
                    input.removeAttribute('readonly');
                    input.removeAttribute('disabled');
                });
                document.querySelectorAll('.pendaftaran-form select').forEach(function(select) {
                    select.removeAttribute('readonly');
                    select.removeAttribute('disabled');
                });
                editBtn.style.display = 'none';
                // Change button to submit
                var actions = document.querySelector('.form-group.actions');
                var submitBtn = document.createElement('button');
                submitBtn.type = 'submit';
                submitBtn.className = 'btn-primary full-width';
                submitBtn.innerText = 'Simpan Perubahan';
                actions.appendChild(submitBtn);
            });
        }
    });
</script>
@push('styles')
<style>
.styled-select {
    padding: 0.6rem 1rem;
    border: 1px solid #e2e8f0;
    border-radius: 7px;
    font-size: 1rem;
    background: #f1f5f9;
    transition: border 0.2s;
    color: #2563eb;
    font-weight: 500;
}
.styled-select:focus {
    border: 1.5px solid #2563eb;
    outline: none;
    background: #fff;
}
.pendaftaran-form a {
    color: #2563eb;
    font-size: 0.97rem;
    margin-top: 0.2rem;
    display: inline-block;
}
.pendaftaran-state-box {
    width: 100%;
    max-width: 700px;
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 2px 16px rgba(37, 99, 235, 0.08);
    padding: 2.5rem 2rem 2rem 2rem;
    margin: 2.5rem auto;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 2rem;
}
.pendaftaran-state-message {
    background: #d1f7d6;
    color: #176b2c;
    border: 2px solid #34c759;
    border-radius: 8px;
    padding: 1.5rem 1.2rem;
    font-size: 1.15rem;
    font-weight: 500;
    text-align: center;
    box-shadow: 0 2px 8px rgba(52,199,89,0.07);
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.7rem;
}
.icon-check {
    font-size: 2.2rem;
    color: #34c759;
    margin-bottom: 0.3rem;
}
.pendaftaran-title {
    font-size: 2rem;
    font-weight: 700;
    color: #2563eb;
    margin-bottom: 1.5rem;
    text-align: center;
    letter-spacing: 0.5px;
}
</style>
@endpush
@endsection
