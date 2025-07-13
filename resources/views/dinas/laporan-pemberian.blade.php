@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/laporan-pemberian.css') }}">
<div class="laporan-container">
    <h2>Laporan Pemberian Bantuan</h2>
    <button class="btn-export">Export Data</button>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Mahasiswa</th>
                    <th>Jenis Bantuan</th>
                    <th>Status Bantuan</th>
                    <th>Tanggal Pemberian</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Mahasiswa 1</td>
                    <td>Beasiswa</td>
                    <td><span class="badge badge-success">Diterima</span></td>
                    <td>2025-07-13</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Mahasiswa 2</td>
                    <td>Fasilitas Penunjang</td>
                    <td><span class="badge badge-warning">Menunggu</span></td>
                    <td>2025-07-12</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Mahasiswa 3</td>
                    <td>Beasiswa</td>
                    <td><span class="badge badge-danger">Ditolak</span></td>
                    <td>2025-07-11</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
