@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/bantuan-studi.css') }}">
<div class="dashboard-card bantuan-studi-wide-card">
    <h1 style="margin-bottom:24px;">Tambah Bantuan Studi</h1>
    <form method="POST" action="{{ route('tim.bantuan-studi.store') }}" class="form-bantuan-studi">
        @csrf
        <div class="form-group">
            <label for="jenis">Jenis Bantuan</label>
            <input type="text" name="Jenis_Bantuan" id="jenis" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="Deskripsi" id="deskripsi" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="nominal">Nominal</label>
            <input type="number" name="Nominal" id="nominal" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="periode">Periode Bantuan</label>
            <input type="text" name="Periode_Bantuan" id="periode" class="form-control">
        </div>
        <div class="form-group">
            <label for="tahun">Tahun Penerimaan</label>
            <input type="number" name="Tahun_Penerimaan" id="tahun" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary" style="margin-top:16px;">Simpan</button>
    </form>
</div>
<style>
.form-bantuan-studi {
    max-width: 500px;
    margin: 0 auto;
}
.form-group {
    margin-bottom: 16px;
}
.form-group label {
    display: block;
    font-weight: 500;
    margin-bottom: 6px;
}
.form-control {
    width: 100%;
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 16px;
    box-sizing: border-box;
}
.btn-primary {
    background: #007bff;
    color: #fff;
    border: none;
    padding: 10px 24px;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.2s;
}
.btn-primary:hover {
    background: #0056b3;
}
.dashboard-card {
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    border-radius: 10px;
    padding: 32px;
    background: #fff;
}
</style>
@endsection
