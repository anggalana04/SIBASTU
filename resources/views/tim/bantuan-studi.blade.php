@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/bantuan-studi.css') }}">
<div class="main-content" style="max-width:1200px;margin:2.5rem auto;display:grid;grid-template-columns:1fr 1fr;grid-template-rows:auto auto;gap:2.5rem 2.5rem;">
    <div class="dashboard-card" style="grid-column: 1; grid-row: 1;">
        <h2>Daftar Bantuan Studi</h2>
        <table class="dashboard-schedule" style="width:100%;margin-top:1.2rem;">
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
                <tr class="clickable-row" onclick="window.location='{{ route('tim.informasi-pemberian.show', $info->Id_Informasi) }}'" style="cursor:pointer;">
                    <td>{{ $info->mahasiswa->Nama_Mahasiswa ?? '-' }}</td>
                    <td>{{ $info->mahasiswa->NIM ?? '-' }}</td>
                    <td>{{ $info->mahasiswa->Universitas ?? ($info->mahasiswa->universitas->Nama_Universitas ?? '-') }}</td>
                    <td>{{ $info->bantuanStudi->Jenis_Bantuan ?? '-' }}</td>
                    <td>{{ $info->bantuanStudi->Tahun_Penerimaan ?? '-' }}</td>
                    <td><span class="status-badge status-{{ $info->Status_Bantuan }}">{{ ucfirst($info->Status_Bantuan) }}</span></td>
                    <td>{{ $info->Tgl_Penyaluran ? date('d-m-Y', strtotime($info->Tgl_Penyaluran)) : '-' }}</td>
                    <td>{{ $info->Keterangan ?? '-' }}</td>
                </tr>
                @empty
                <tr><td colspan="8" style="text-align:center;">Belum ada data pemberian bantuan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="dashboard-notes" style="grid-column: 2; grid-row: 1;">
        <h2>Catatan Bantuan Studi</h2>
        @forelse($informasiPemberianBantuan as $info)
            <div class="note green">
                <b>{{ $info->bantuanStudi->Jenis_Bantuan ?? '-' }}</b><br>
                {{ $info->bantuanStudi->Deskripsi ?? '-' }}
            </div>
        @empty
            <div class="note">Belum ada catatan bantuan studi.</div>
        @endforelse
    </div>
    <div class="dashboard-card" style="grid-column: 1 / span 2; grid-row: 2;">
        <h2>Jadwal Penyaluran</h2>
        <table class="dashboard-schedule">
            <thead>
                <tr>
                    <th>Time</th>
                    <th>Mahasiswa</th>
                    <th>Jenis Bantuan</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($informasiPemberianBantuan as $info)
                <tr>
                    <td>{{ $info->Tgl_Penyaluran ? date('d M Y', strtotime($info->Tgl_Penyaluran)) : '-' }}</td>
                    <td>{{ $info->mahasiswa->Nama_Mahasiswa ?? '-' }}</td>
                    <td>{{ $info->bantuanStudi->Jenis_Bantuan ?? '-' }}</td>
                    <td><span class="status-badge status-{{ $info->Status_Bantuan }}">{{ ucfirst($info->Status_Bantuan) }}</span></td>
                    <td>{{ $info->Keterangan ?? '-' }}</td>
                </tr>
                @empty
                <tr><td colspan="5">Belum ada jadwal penyaluran bantuan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
