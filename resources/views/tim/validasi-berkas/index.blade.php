@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/index-berkas.css') }}">
<h1 class="validasi-title">VALIDASI BERKAS</h1>
<div class="data-mahasiswa-table-wrapper">
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
