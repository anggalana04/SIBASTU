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
        <h1>JENIS BANTUAN TERSEDIA</h1>
        <table class="dashboard-schedule">
            <thead>
                <tr>
                    <th>Jenis Bantuan</th>
                    <th>Deskripsi</th>
                    <th>Nominal</th>
                    <th>Periode</th>
                    <th>Tahun Penerimaan</th>
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
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center;">Belum ada jenis bantuan terdaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
