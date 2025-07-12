@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/laporan-pendaftaran.css') }}">
<div class="laporan-pendaftaran-container">
    <h2>Laporan Pendaftaran Mahasiswa</h2>
    <a href="#" class="btn btn-success mb-3">Export to PDF</a>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-primary">
                <tr>
                    <th>Nama Mahasiswa</th>
                    <th>NIM</th>
                    <th>Jurusan</th>
                    <th>Universitas</th>
                    <th>Korwil</th>
                    <th>Tanggal Pendaftaran</th>
                    <th>Status Berkas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pendaftaran as $val)
                    <tr>
                        <td><strong>{{ $val->mahasiswa->Nama_Mahasiswa ?? '-' }}</strong></td>
                        <td>{{ $val->mahasiswa->NIM ?? '-' }}</td>
                        <td>{{ $val->mahasiswa->Jurusan ?? '-' }}</td>
                        <td>{{ $val->mahasiswa->Universitas ?? '-' }}</td>
                        <td>{{ $val->mahasiswa->korwil->Nama_Korwil ?? '-' }}</td>
                        <td>{{ optional($val->berkas->created_at ?? null)->format('d-m-Y') }}</td>
                        <td>
                            @php
                                $status = strtolower($val->Status_Berkas);
                                $badgeClass = match($status) {
                                    'diterima' => 'badge-success',
                                    'ditolak' => 'badge-danger',
                                    'diproses' => 'badge-warning',
                                    default => 'badge-secondary',
                                };
                            @endphp
                            <span class="status-badge {{ $badgeClass }}">{{ ucfirst($val->Status_Berkas) }}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination">{{ $pendaftaran->links() }}</div>
    </div>
</div>
@endsection
