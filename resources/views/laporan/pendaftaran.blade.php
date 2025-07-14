@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/laporan-pendaftaran.css') }}">
<div class="laporan-pendaftaran-container">
    <h2 style="display:flex;justify-content:space-between;align-items:center;">
        Laporan Pendaftaran Mahasiswa
        <a href="{{ route('laporan.pendaftaran.exportPdf', request()->all()) }}" class="btn btn-success" style="min-width:160px;float:right;">Export to PDF</a>
    </h2>
    <form method="GET" action="" class="mb-4 filter-bar" style="display:flex;gap:20px;flex-wrap:wrap;align-items:end;background:#f8fafc;padding:18px 24px 10px 24px;border-radius:10px;box-shadow:0 2px 8px 0 #e5e7eb;margin-bottom:32px;">
        <div style="min-width:180px;">
            <label for="korwil" class="form-label" style="font-weight:500;">Korwil</label>
            <select name="korwil" id="korwil" class="form-control" style="border-radius:6px;">
                <option value="">Semua Korwil</option>
                @foreach($korwilList as $korwil)
                    <option value="{{ $korwil->Id_Korwil }}" @if(request('korwil') == $korwil->Id_Korwil) selected @endif>{{ $korwil->Nama_Korwil }}</option>
                @endforeach
            </select>
        </div>
        <div style="min-width:180px;">
            <label for="status" class="form-label" style="font-weight:500;">Status Berkas</label>
            <select name="status" id="status" class="form-control" style="border-radius:6px;">
                <option value="">Semua Status</option>
                <option value="terverifikasi" @if(request('status')=='terverifikasi') selected @endif>Terverifikasi</option>
                <option value="menunggu_verifikasi" @if(request('status')=='menunggu_verifikasi') selected @endif>Menunggu Verifikasi</option>
                <option value="ditolak" @if(request('status')=='ditolak') selected @endif>Ditolak</option>
            </select>
        </div>
        <div style="flex:1;min-width:220px;">
            <label for="search" class="form-label" style="font-weight:500;">Cari</label>
            <input type="text" name="search" id="search" class="form-control" placeholder="Nama/NIM/Universitas" value="{{ request('search') }}" style="border-radius:6px;">
        </div>
        <div>
            <button type="submit" class="btn btn-primary" style="min-width:120px;">Filter</button>
        </div>
    </form>
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
