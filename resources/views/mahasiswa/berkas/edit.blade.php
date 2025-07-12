@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Berkas</h1>
    <form action="{{ route('berkas.update', $berkas->Id_Berkas) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nomor Rekening</label>
            <input type="text" name="Nomor_Rekening" class="form-control" value="{{ $berkas->Nomor_Rekening }}" required>
        </div>
        <div class="mb-3">
            <label>Nama Bank</label>
            <input type="text" name="Nama_Bank" class="form-control" value="{{ $berkas->Nama_Bank }}" required>
        </div>
        <div class="mb-3">
            <label>Lampiran Aktif Kuliah</label>
            @if($berkas->Lampiran_aktifkuliah)
                <a href="{{ asset('storage/'.$berkas->Lampiran_aktifkuliah) }}" target="_blank">Lihat File</a>
            @endif
            <input type="file" name="Lampiran_aktifkuliah" class="form-control">
        </div>
        <div class="mb-3">
            <label>Lampiran KPM</label>
            @if($berkas->Lampiran_kpm)
                <a href="{{ asset('storage/'.$berkas->Lampiran_kpm) }}" target="_blank">Lihat File</a>
            @endif
            <input type="file" name="Lampiran_kpm" class="form-control">
        </div>
        <div class="mb-3">
            <label>Lampiran KTP</label>
            @if($berkas->Lampiran_ktp)
                <a href="{{ asset('storage/'.$berkas->Lampiran_ktp) }}" target="_blank">Lihat File</a>
            @endif
            <input type="file" name="Lampiran_ktp" class="form-control">
        </div>
        <div class="mb-3">
            <label>Lampiran DNS</label>
            @if($berkas->Lampiran_dns)
                <a href="{{ asset('storage/'.$berkas->Lampiran_dns) }}" target="_blank">Lihat File</a>
            @endif
            <input type="file" name="Lampiran_dns" class="form-control">
        </div>
        <div class="mb-3">
            <label>Lampiran KK</label>
            @if($berkas->Lampiran_kk)
                <a href="{{ asset('storage/'.$berkas->Lampiran_kk) }}" target="_blank">Lihat File</a>
            @endif
            <input type="file" name="Lampiran_kk" class="form-control">
        </div>
        <div class="mb-3">
            <label>Lampiran Rekomendasi</label>
            @if($berkas->Lampiran_rekomendasi)
                <a href="{{ asset('storage/'.$berkas->Lampiran_rekomendasi) }}" target="_blank">Lihat File</a>
            @endif
            <input type="file" name="Lampiran_rekomendasi" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('berkas.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
