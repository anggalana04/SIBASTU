@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/bantuan-studi.css') }}">

<div class="bantuan-studi-stack">
    <div class="dashboard-card bantuan-studi-wide-card">
        <h1>DAFTAR CALON PENERIMA BANTUAN STUDI</h1>
        <table class="dashboard-schedule">
            <thead>
                <tr>
                    <th>Mahasiswa</th>
                    <th>NIM/NPM</th>
                    <th>Kampus</th>
                    <th>Jenis Bantuan</th>
                    <th>Tahun</th>
                    <th>Status</th>
                    <th>Tanggal Penyaluran</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($informasiPemberianBantuan as $info)
                    <tr class="clickable-row"
                        onclick="window.location='{{ route('tim.informasi-pemberian.show', $info->Id_Informasi) }}'"
                        style="cursor:pointer;">
                        <td>{{ $info->mahasiswa->Nama_Mahasiswa ?? '-' }}</td>
                        <td>{{ $info->mahasiswa->NIM ?? '-' }}</td>
                        <td>{{ $info->mahasiswa->Universitas ?? ($info->mahasiswa->universitas->Nama_Universitas ?? '-') }}</td>
                        <td>{{ $info->bantuanStudi->Jenis_Bantuan ?? '-' }}</td>
                        <td>{{ $info->bantuanStudi->Tahun_Penerimaan ?? '-' }}</td>
                        <td>
                            <span class="status-badge status-{{ $info->Status_Bantuan }}">
                                {{ ucfirst($info->Status_Bantuan) }}
                            </span>
                        </td>
                        <td>{{ $info->Tgl_Penyaluran ? date('d-m-Y', strtotime($info->Tgl_Penyaluran)) : '-' }}</td>
                        <td>{{ $info->Keterangan ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align:center;">Belum ada data pemberian bantuan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="dashboard-card bantuan-studi-wide-card bantuan-studi-margin-top">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
            <h1 style="margin: 0;">JENIS BANTUAN TERSEDIA</h1>
            <a href="{{ route('tim.bantuan-studi.create') }}" class="btn btn-primary">Tambah Bantuan Studi</a>
        </div>
        <table class="dashboard-schedule">
            <thead>
                <tr>
                    <th>Jenis Bantuan</th>
                    <th>Deskripsi</th>
                    <th>Nominal</th>
                    <th>Periode</th>
                    <th>Tahun Penerimaan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $allBantuan = \App\Models\BantuanStudi::all();
                @endphp
                @forelse($allBantuan as $bantuan)
                    <tr>
                        <td>{{ $bantuan->Jenis_Bantuan }}</td>
                        <td>{{ $bantuan->Deskripsi ?? '-' }}</td>
                        <td>Rp{{ number_format($bantuan->Nominal ?? 0, 0, ',', '.') }}</td>
                        <td>{{ $bantuan->Periode_Bantuan ?? '-' }}</td>
                        <td>{{ $bantuan->Tahun_Penerimaan ?? '-' }}</td>
                        <td style="vertical-align: middle;">
                            <div style="display: inline-flex; gap: 4px; align-items: center;">
                                <a href="{{ route('tim.bantuan-studi.show', $bantuan->Id_Bantuan) }}" class="btn-xxs" title="Detail">🔍</a>
                                <a href="{{ route('tim.bantuan-studi.edit', $bantuan->Id_Bantuan) }}" class="btn-xxs" title="Edit">✏️</a>
                                <form method="POST" action="{{ route('tim.bantuan-studi.destroy', $bantuan->Id_Bantuan) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-xxs" title="Hapus" onclick="return confirm('Yakin ingin menghapus?')">🗑️</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center;">Belum ada jenis bantuan terdaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
.btn {
    display: inline-block;
    padding: 6px 16px;
    font-size: 14px;
    font-weight: 500;
    border-radius: 5px;
    border: none;
    cursor: pointer;
    transition: background 0.2s, color 0.2s;
    margin-right: 4px;
    text-decoration: none;
}
.btn-sm {
    padding: 5px 12px;
    font-size: 13px;
}
.btn-info {
    background: #17a2b8;
    color: #fff;
}
.btn-info:hover {
    background: #117a8b;
}
.btn-warning {
    background: #ffc107;
    color: #212529;
}
.btn-warning:hover {
    background: #e0a800;
}
.btn-danger {
    background: #dc3545;
    color: #fff;
}
.btn-danger:hover {
    background: #a71d2a;
}
.bantuan-link {
    color: #17a2b8;
    font-weight: 600;
    text-decoration: none;
    margin-right: 8px;
    transition: color 0.2s;
}
.bantuan-link:hover {
    color: #117a8b;
    text-decoration: underline;
}
.btn-xs {
    padding: 3px 8px;
    font-size: 12px;
    border-radius: 4px;
}
.btn-xxs {
    padding: 2px 6px;
    font-size: 15px;
    border: none;
    background: none;
    cursor: pointer;
    border-radius: 3px;
    margin: 0;
    transition: background 0.2s;
}
.btn-xxs:active {
    background: #eee;
}
</style>

@endsection
