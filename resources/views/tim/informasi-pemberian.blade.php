@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/tim-pengumuman.css') }}">
<div class="main-content">
    <div class="mt-5">
        <form method="GET" action="" class="informasi-pemberian-form" style="margin-bottom:28px;display:flex;flex-wrap:wrap;gap:18px;align-items:flex-end;">
            <div>
                <label class="form-label">Periode Bantuan</label>
                <select name="periode" class="form-control" style="min-width:140px;">
                    <option value="">-- Semua Periode --</option>
                    @foreach($periodeList as $periode)
                        <option value="{{ $periode }}" @if(request('periode') == $periode) selected @endif>{{ $periode }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="form-label">Jenis Bantuan</label>
                <select name="jenis" class="form-control" style="min-width:140px;">
                    <option value="">-- Semua Jenis --</option>
                    @foreach($jenisList as $jenis)
                        <option value="{{ $jenis }}" @if(request('jenis') == $jenis) selected @endif>{{ ucwords(str_replace('_',' ', $jenis)) }}</option>
                    @endforeach
                </select>
            </div>
            <div style="flex:2;min-width:180px;">
                <label class="form-label">Cari Mahasiswa/Bantuan</label>
                <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Nama, NIM, Universitas, Jurusan...">
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Terapkan</button>
            </div>
        </form>
        <h2>Daftar Informasi Pemberian Bantuan</h2>
        <table class="table table-striped informasi-table">
            <thead>
                <tr>
                    <th>Mahasiswa</th>
                    <th>Jenis Bantuan</th>
                    <th>Status</th>
                    <th>Tanggal Penyaluran</th>
                </tr>
            </thead>
            <tbody>
                @foreach($informasiList as $info)
                <tr>
                    <td>{{ $info->mahasiswa->Nama_Mahasiswa ?? '-' }}</td>
                    <td>{{ $info->bantuanStudi->Jenis_Bantuan ?? '-' }}</td>
                    <td><span class="status-badge status-{{ $info->Status_Bantuan }}">{{ ucfirst($info->Status_Bantuan) }}</span></td>
                    <td>{{ $info->Tgl_Penyaluran ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif


    <div class="pengumuman-card-container" style="max-width:1200px;width:100%;margin:2.5rem auto 0 auto;">
        <h1 style="font-size:1.5rem;font-weight:700;color:#1a237e;margin-bottom:2rem;padding:0.5rem 1.5rem 0.5rem 0;letter-spacing:0.5px;text-align:center;">Manajemen Pengumuman Bantuan Studi</h1>
        <div class="pengumuman-card">
            <form action="{{ isset($pengumuman) ? route('tim.pengumuman-bantuan-studi.update', $pengumuman->id) : route('tim.pengumuman-bantuan-studi.store') }}" method="POST">
                @csrf
                @if(isset($pengumuman))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="judul">Judul Pengumuman</label>
                    <input type="text" name="judul" id="judul" class="form-control" value="{{ $pengumuman->judul ?? '' }}" required maxlength="150">
                </div>
                <div class="form-group">
                    <label for="isi">Isi Pengumuman</label>
                    <textarea name="isi" id="isi" class="form-control" rows="3">{{ $pengumuman->isi ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="syarat">Syarat & Ketentuan <span style="font-weight:400;font-size:0.95em;">(1 baris = 1 syarat)</span></label>
                    <textarea name="syarat" id="syarat" class="form-control" rows="4">@if(is_array($pengumuman->syarat)){{ implode("\n", $pengumuman->syarat) }}@else{{ $pengumuman->syarat ?? '' }}@endif</textarea>
                    @if(is_array($pengumuman->syarat) && count($pengumuman->syarat))
                        <ul class="mt-2">
                            @foreach($pengumuman->syarat as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="form-group">
                    <label for="jadwal">Jadwal Penting <span style="font-weight:400;font-size:0.95em;">(1 baris = 1 jadwal, contoh: Pendaftaran Dibuka: 01 Juni 2025)</span></label>
                    <textarea name="jadwal" id="jadwal" class="form-control" rows="4">@if(isset($pengumuman->jadwal) && is_array($pengumuman->jadwal)){{ implode("\n", $pengumuman->jadwal) }}@elseif(isset($pengumuman->jadwal)){{ $pengumuman->jadwal }}@endif</textarea>
                    @if(isset($pengumuman->jadwal) && is_array($pengumuman->jadwal) && count($pengumuman->jadwal))
                        <ul class="mt-2">
                            @foreach($pengumuman->jadwal as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Simpan Pengumuman</button>
                </div>
            </form>
           
        </div>
    </div>

</div>
@endsection
