@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/setting.css') }}">
<div class="setting-container">
    <h1>Setting Korwil</h1>
    <div class="setting-section">
        <h2>Edit Identitas Korwil</h2>
        <form action="{{ route('korwil.updateIdentity') }}" method="POST">
            @csrf
            @method('PUT')
            <label for="name">Nama Korwil:</label>
            <input type="text" id="name" name="name" value="{{ $korwil->name ?? '' }}" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ $korwil->email ?? '' }}" required>

            <button type="submit" class="btn-save">Simpan</button>
        </form>
    </div>

    <div class="setting-section">
        <h2>Tentang</h2>
        <p>SIBASTU adalah platform untuk memudahkan pengelolaan bantuan studi secara efisien dan transparan.</p>
    </div>

    <div class="setting-section">
        <h2>Mode Gelap</h2>
        <form action="{{ route('korwil.toggleDarkMode') }}" method="POST">
            @csrf
            <label for="dark-mode">Aktifkan Mode Gelap:</label>
            <input type="checkbox" id="dark-mode" name="dark_mode" {{ $darkMode ? 'checked' : '' }}>

            <button type="submit" class="btn-save">Simpan</button>
        </form>
    </div>
</div>
@endsection
