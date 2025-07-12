@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/informasi-pemberian.css') }}">
<div class="main-content">
    <div class="dashboard-card" style="grid-column: 1; grid-row: 1;">
        <h2>My tasks</h2>
        <div style="display:flex; gap:1rem; margin-bottom:1.2rem;">
            <button class="btn">All task</button>
            <button class="btn">To do</button>
            <button class="btn">In progress</button>
            <button class="btn">Done</button>
        </div>
        @if($informasiList && count($informasiList))
            <ul>
            @foreach($informasiList as $info)
                <li style="margin-bottom:1.1rem;">
                    <b>{{ $info->bantuanStudi->Jenis_Bantuan ?? '-' }}</b> <span class="meta">({{ $info->bantuanStudi->Tahun_Penerimaan ?? '-' }})</span>
                    <div>{{ $info->Keterangan ?? '-' }}</div>
                    <span class="status-badge status-{{ $info->Status_Bantuan }}">{{ ucfirst($info->Status_Bantuan) }}</span>
                </li>
            @endforeach
            </ul>
        @else
            <div class="alert">Belum ada informasi pemberian bantuan untuk Anda.</div>
        @endif
    </div>
    <div class="dashboard-notes" style="grid-column: 2; grid-row: 1;">
        <h2>My notes</h2>
        @if($informasiList && count($informasiList))
            @foreach($informasiList as $info)
                <div class="note green">
                    <b>{{ $info->bantuanStudi->Jenis_Bantuan ?? '-' }}</b><br>
                    {{ $info->bantuanStudi->Deskripsi ?? '-' }}
                </div>
            @endforeach
        @else
            <div class="note">Belum ada catatan bantuan studi.</div>
        @endif
    </div>
    <div class="dashboard-card" style="grid-column: 1 / span 2; grid-row: 2;">
        <h2>My schedule</h2>
        <table class="dashboard-schedule">
            <thead>
                <tr>
                    <th>Time</th>
                    <th>Jenis Bantuan</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @if($informasiList && count($informasiList))
                    @foreach($informasiList as $info)
                    <tr>
                        <td>{{ $info->Tgl_Penyaluran ? date('d M Y', strtotime($info->Tgl_Penyaluran)) : '-' }}</td>
                        <td>{{ $info->bantuanStudi->Jenis_Bantuan ?? '-' }}</td>
                        <td><span class="status-badge status-{{ $info->Status_Bantuan }}">{{ ucfirst($info->Status_Bantuan) }}</span></td>
                        <td>{{ $info->Keterangan ?? '-' }}</td>
                    </tr>
                    @endforeach
                @else
                    <tr><td colspan="4">Belum ada jadwal penyaluran bantuan.</td></tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
