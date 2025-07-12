@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/informasi-pemberian.css') }}">
<div class="main-content">
    <h1>Informasi Pemberian Bantuan Studi</h1>
    @if($pengumuman)
    <div class="informasi-pemberian-flex">
        <div class="informasi-pemberian-box syarat">
            <div class="box-title">Syarat & Ketentuan</div>
            <ul>
                @foreach(explode("\n", $pengumuman->syarat) as $syarat)
                    @if(trim($syarat) !== '')
                        <li>{{ $syarat }}</li>
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="informasi-pemberian-box jadwal">
            <div class="box-title">Jadwal Pendaftaran dan Penyaluran</div>
            <ul>
                <li>Pendaftaran Dibuka: {{ $pengumuman->tanggal_mulai ? date('d M Y', strtotime($pengumuman->tanggal_mulai)) : '-' }}</li>
                <li>Pendaftaran Ditutup: {{ $pengumuman->tanggal_selesai ? date('d M Y', strtotime($pengumuman->tanggal_selesai)) : '-' }}</li>
                <li>Pengumuman: {{ $pengumuman->isi ?? '-' }}</li>
            </ul>
        </div>
    </div>
    <div class="mt-4">
        <div class="mt-2">Kontak Tim Lanny Jaya Cerdas: 628-xxxx-xxxx</div>
    </div>
    @else
    <div class="alert alert-info">Belum ada pengumuman bantuan studi.</div>
    @endif
</div>
@endsection
