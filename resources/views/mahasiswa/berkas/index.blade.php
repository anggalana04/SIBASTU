@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Berkas</h1>
    <a href="{{ route('berkas.create') }}" class="btn btn-primary mb-3">Upload Berkas</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nomor Rekening</th>
                <th>Nama Bank</th>
                <th>Lampiran Aktif Kuliah</th>
                <th>Lampiran KPM</th>
                <th>Lampiran KTP</th>
                <th>Lampiran DNS</th>
                <th>Lampiran KK</th>
                <th>Lampiran Rekomendasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($berkas as $b)
            <tr>
                <td>{{ $b->Id_Berkas }}</td>
                <td>{{ $b->Nomor_Rekening }}</td>
                <td>{{ $b->Nama_Bank }}</td>
                <td>@if($b->Lampiran_aktifkuliah)<a href="{{ asset('storage/'.$b->Lampiran_aktifkuliah) }}" target="_blank">Lihat</a>@endif</td>
                <td>@if($b->Lampiran_kpm)<a href="{{ asset('storage/'.$b->Lampiran_kpm) }}" target="_blank">Lihat</a>@endif</td>
                <td>@if($b->Lampiran_ktp)<a href="{{ asset('storage/'.$b->Lampiran_ktp) }}" target="_blank">Lihat</a>@endif</td>
                <td>@if($b->Lampiran_dns)<a href="{{ asset('storage/'.$b->Lampiran_dns) }}" target="_blank">Lihat</a>@endif</td>
                <td>@if($b->Lampiran_kk)<a href="{{ asset('storage/'.$b->Lampiran_kk) }}" target="_blank">Lihat</a>@endif</td>
                <td>@if($b->Lampiran_rekomendasi)<a href="{{ asset('storage/'.$b->Lampiran_rekomendasi) }}" target="_blank">Lihat</a>@endif</td>
                <td>
                    <form action="{{ route('berkas.destroy', $b->Id_Berkas) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
