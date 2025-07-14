@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/laporan-bantuan.css') }}">
<div class="container mt-4">
    <div class="laporan-bantuan-container">
        <h2 style="display:flex;justify-content:space-between;align-items:center;">
            Laporan Pemberian Bantuan
            <a href="{{ route('laporan.bantuan.exportPdf', request()->all()) }}" class="btn btn-success" style="min-width:160px;float:right;">Export to PDF</a>
        </h2>
        <form method="GET" action="" class="mb-4 filter-bar" style="display:flex;gap:20px;flex-wrap:wrap;align-items:end;background:#f8fafc;padding:18px 24px 10px 24px;border-radius:10px;box-shadow:0 2px 8px 0 #e5e7eb;margin-bottom:32px;">
            <div style="min-width:180px;">
                <label for="periode" class="form-label" style="font-weight:500;">Periode</label>
                <select name="periode" id="periode" class="form-control" style="border-radius:6px;">
                    <option value="">Semua Periode</option>
                    @foreach($periodeList as $periode)
                        <option value="{{ $periode }}" @if(request('periode') == $periode) selected @endif>{{ $periode }}</option>
                    @endforeach
                </select>
            </div>
            <div style="min-width:180px;">
                <label for="jenis" class="form-label" style="font-weight:500;">Jenis Bantuan</label>
                <select name="jenis" id="jenis" class="form-control" style="border-radius:6px;">
                    <option value="">Semua Jenis</option>
                    @foreach($jenisList as $jenis)
                        <option value="{{ $jenis }}" @if(request('jenis') == $jenis) selected @endif>{{ ucwords(str_replace('_',' ', $jenis)) }}</option>
                    @endforeach
                </select>
            </div>
            <div style="flex:1;min-width:220px;">
                <label for="search" class="form-label" style="font-weight:500;">Cari</label>
                <input type="text" name="search" id="search" class="form-control" placeholder="Nama/NIM/Periode" value="{{ request('search') }}" style="border-radius:6px;">
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
