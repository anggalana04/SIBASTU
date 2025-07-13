@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/informasi-pemberian.css') }}">
<div class="main-content">
    <h1>Manajemen Pengumuman Bantuan Studi</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="pengumuman-card-container">
        <div class="pengumuman-card">
            <form action="{{ route('tim.pengumuman-bantuan-studi.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="judul">Judul Pengumuman</label>
                    <input type="text" name="judul" id="judul" class="form-control" value="{{ $pengumuman->judul ?? '' }}" required maxlength="150">
                </div>
                <div class="form-group">
                    <label for="isi">Isi Pengumuman</label>
                    <textarea name="isi" id="isi" class="form-control" rows="3">{{ $pengumuman->isi ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="syarat">Syarat & Ketentuan</label>
                    <textarea name="syarat" id="syarat" class="form-control" rows="2">{{ $pengumuman->syarat ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="tanggal_mulai">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="{{ $pengumuman->tanggal_mulai ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_selesai">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="{{ $pengumuman->tanggal_selesai ?? '' }}" required>
                </div>
                <div class="form-actions" style="margin-top:18px;display:flex;gap:12px;">
                    <button type="submit" class="btn btn-success">Simpan Pengumuman</button>
                    @if(isset($pengumuman))
                        <form action="{{ route('tim.pengumuman-bantuan-studi.destroy', $pengumuman->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin hapus pengumuman?')">Hapus</button>
                        </form>
                    @endif
                </div>
            </form>
        </div>
    </div>
    <div class="mt-5">
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
</div>
@endsection
