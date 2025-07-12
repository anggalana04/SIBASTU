@extends('layouts.app')
@section('content')
<div class="container mt-4">
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
                    <th>Tanggal Pendaftaran</th>
                    <th>Status Berkas</th>
                    <th>Dokumen Diunggah</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mahasiswa as $mhs)
                    <tr>
                        <td>{{ $mhs->Nama_Mahasiswa }}</td>
                        <td>{{ $mhs->NIM }}</td>
                        <td>{{ $mhs->Jurusan }}</td>
                        <td>{{ $mhs->Universitas }}</td>
                        <td>{{ optional($mhs->created_at)->format('d-m-Y') }}</td>
                        <td>{{ optional($mhs->berkas->validasi->first())->Status_Berkas ?? '-' }}</td>
                        <td>
                            @if($mhs->berkas)
                                @php $dok = [];
                                    if($mhs->berkas->Lampiran_aktifkuliah) $dok[] = 'Aktif Kuliah';
                                    if($mhs->berkas->Lampiran_kpm) $dok[] = 'KPM';
                                    if($mhs->berkas->Lampiran_ktp) $dok[] = 'KTP';
                                    if($mhs->berkas->Lampiran_dns) $dok[] = 'DNS';
                                    if($mhs->berkas->Lampiran_kk) $dok[] = 'KK';
                                    if($mhs->berkas->Lampiran_rekomendasi) $dok[] = 'Rekomendasi';
                                @endphp
                                {{ implode(', ', $dok) }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>{{ $mahasiswa->links() }}</div>
    </div>
</div>
@endsection
