@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/laporan-bantuan.css') }}">
<div class="container mt-4">
    <div class="laporan-bantuan-container">
        <h2>Laporan Pemberian Bantuan</h2>
        <a href="#" class="btn btn-success mb-3">Export to PDF</a>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>Nama Mahasiswa</th>
                        <th>NIM</th>
                        <th>Jenis Bantuan</th>
                        <th>Nominal</th>
                        <th>Periode</th>
                        <th>Status Penyaluran</th>
                        <th>Tanggal Penyaluran</th>
                        <th>Nama Korwil</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bantuan as $row)
                        <tr>
                            <td>{{ $row->mahasiswa->Nama_Mahasiswa ?? '-' }}</td>
                            <td>{{ $row->mahasiswa->NIM ?? '-' }}</td>
                            <td>{{ $row->bantuanStudi->Jenis_Bantuan ?? '-' }}</td>
                            <td>Rp{{ number_format($row->bantuanStudi->Nominal ?? 0, 0, ',', '.') }}</td>
                            <td>{{ $row->bantuanStudi->Periode_Bantuan ?? '-' }}</td>
                            <td>{{ ucfirst($row->Status_Bantuan) }}</td>
                            <td>{{ $row->Tgl_Penyaluran ? date('d-m-Y', strtotime($row->Tgl_Penyaluran)) : '-' }}</td>
                            <td>{{ $row->korwil->Nama_Korwil ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>{{ $bantuan->links() }}</div>
        </div>
    </div>
</div>
@endsection
