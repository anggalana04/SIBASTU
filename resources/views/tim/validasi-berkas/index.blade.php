@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/index-berkas.css') }}">
<h1 class="validasi-title">VALIDASI BERKAS</h1>
<div class="data-mahasiswa-table-wrapper">
    <form method="GET" action="" class="informasi-pemberian-form" style="margin-bottom:28px;display:flex;flex-wrap:wrap;gap:18px;align-items:flex-end;">
        <div>
            <label class="form-label">Status Validasi</label>
            <select name="status" class="form-control" style="min-width:140px;">
                <option value="">-- Semua Status --</option>
                <option value="menunggu_verifikasi" @if(request('status')=='menunggu_verifikasi') selected @endif>Menunggu Verifikasi</option>
                <option value="diverifikasi" @if(request('status')=='diverifikasi') selected @endif>Diverifikasi</option>
                <option value="ditolak" @if(request('status')=='ditolak') selected @endif>Ditolak</option>
            </select>
        </div>
        <div style="flex:2;min-width:180px;">
            <label class="form-label">Cari Mahasiswa/Jurusan</label>
            <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Nama, NIM, Jurusan...">
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Terapkan</button>
        </div>
    </form>
    <table class="data-mahasiswa-table">
        <thead>
            <tr>
                <th>ID Berkas</th>
                <th>Nama Mahasiswa</th>
                <th>Jurusan</th>
                <th>Status Validasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($berkasList as $b)
            <tr class="clickable-row" data-href="{{ route('validasi.show', $b->Id_Berkas) }}">
                <td>{{ $b->Id_Berkas }}</td>
                <td>{{ $b->mahasiswa->Nama_Mahasiswa ?? '-' }}</td>
                <td>{{ $b->mahasiswa->Jurusan ?? '-' }}</td>
                <td>
                    @php
                        $validasi = \App\Models\Validasi::where('Id_Berkas', $b->Id_Berkas)->first();
                    @endphp
                    <span class="status-badge status-{{ $validasi?->Status_Berkas ?? 'unknown' }}">
                        {{ $validasi?->Status_Berkas ?? '-' }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('validasi.show', $b->Id_Berkas) }}" class="btn btn-info btn-sm">Validasi</a>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" style="text-align:center;color:#64748b;">Belum ada berkas untuk divalidasi.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.clickable-row').forEach(function(row) {
        row.addEventListener('click', function(e) {
            if(e.target.tagName.toLowerCase() === 'a' || e.target.closest('a')) return;
            window.location = this.dataset.href;
        });
    });
});
</script>
@endsection
