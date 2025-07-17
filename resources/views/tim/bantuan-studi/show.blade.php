@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/bantuan-studi.css') }}">
<div class="dashboard-card bantuan-studi-wide-card">
    <h1 style="margin-bottom:24px;">Detail Bantuan Studi</h1>
    <ul class="detail-list">
        <li><strong>Jenis Bantuan:</strong> {{ $bantuanStudi->Jenis_Bantuan }}</li>
        <li><strong>Deskripsi:</strong> {{ $bantuanStudi->Deskripsi }}</li>
        <li><strong>Nominal:</strong> Rp{{ number_format($bantuanStudi->Nominal, 0, ',', '.') }}</li>
        <li><strong>Periode Bantuan:</strong> {{ $bantuanStudi->Periode_Bantuan }}</li>
        <li><strong>Tahun Penerimaan:</strong> {{ $bantuanStudi->Tahun_Penerimaan }}</li>
    </ul>
    <div style="margin-top:24px;">
        <a href="{{ route('tim.bantuan-studi.edit', $bantuanStudi->Id_Bantuan) }}" class="btn btn-primary">Edit</a>
        <form method="POST" action="{{ route('tim.bantuan-studi.destroy', $bantuanStudi->Id_Bantuan) }}" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
        </form>
    </div>
</div>
<style>
.detail-list {
    list-style: none;
    padding: 0;
    margin: 0 0 16px 0;
}
.detail-list li {
    padding: 10px 0;
    border-bottom: 1px solid #eee;
    font-size: 17px;
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
    margin-right: 8px;
}
.btn-primary:hover {
    background: #0056b3;
}
.btn-danger {
    background: #dc3545;
    color: #fff;
    border: none;
    padding: 10px 24px;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.2s;
}
.btn-danger:hover {
    background: #a71d2a;
}
.dashboard-card {
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    border-radius: 10px;
    padding: 32px;
    background: #fff;
    max-width: 500px;
    margin: 0 auto;
}
</style>
@endsection
