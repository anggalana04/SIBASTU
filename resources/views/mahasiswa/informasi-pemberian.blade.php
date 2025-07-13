@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/informasi-pemberian-mhs.css') }}">
    <h1>Informasi Pemberian Bantuan Studi</h1>
    <form method="GET" action="#" class="informasi-pemberian-form">
        <div class="informasi-pemberian-form-row">
            <div>
                <label class="form-label">Tahun</label>
                <select name="tahun">
                    <option value="">2024-2025</option>
                    <option value="">2025-2026</option>
                </select>
            </div>
            <div>
                <label class="form-label">Jenis Informasi</label>
                <select name="jenis">
                    <option value="">-- Pilih Jenis Bantuan --</option>
                    @php
                        $jenisList = \App\Models\BantuanStudi::query()->distinct()->pluck('Jenis_Bantuan');
                    @endphp
                    @foreach($jenisList as $jenis)
                        <option value="{{ $jenis }}">{{ ucwords(str_replace('_',' ', $jenis)) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Tampilkan</button>
            </div>
        </div>
    </form>

    {{-- Table of Informasi Pemberian Bantuan --}}
    <div class="informasi-pemberian-table-wrapper">
        <table class="informasi-pemberian-table">
            <thead>
                <tr>
                    <th>Mahasiswa</th>
                    <th>Jenis Bantuan</th>
                    <th>Tahun</th>
                    <th>Status</th>
                    <th>Tanggal Penyaluran</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @php $allInformasi = \App\Models\InformasiPemberianBantuan::with(['mahasiswa','bantuanStudi'])->get(); @endphp
                @forelse($allInformasi as $info)
                <tr>
                    <td>{{ $info->mahasiswa->Nama_Mahasiswa ?? '-' }}</td>
                    <td>{{ $info->bantuanStudi->Jenis_Bantuan ?? '-' }}</td>
                    <td>{{ $info->bantuanStudi->Tahun_Penerimaan ?? '-' }}</td>
                    <td>{{ ucfirst($info->Status_Bantuan) }}</td>
                    <td>{{ $info->Tgl_Penyaluran ? date('d-m-Y', strtotime($info->Tgl_Penyaluran)) : '-' }}</td>
                    <td>{{ $info->Keterangan ?? '-' }}</td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center;">Belum ada informasi pemberian bantuan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if(isset($pengumuman))
    <div class="informasi-pemberian-flex">
        <div class="informasi-pemberian-box syarat">
            <div class="box-title">Syarat & Ketentuan</div>
            <ul>
                @if(is_array($pengumuman->syarat))
                    @foreach($pengumuman->syarat as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                @elseif(is_string($pengumuman->syarat) && !empty($pengumuman->syarat))
                    <li>{{ $pengumuman->syarat }}</li>
                @else
                    <li>-</li>
                @endif
            </ul>
        </div>
        @if(isset($pengumuman->jadwal) && is_array($pengumuman->jadwal) && count($pengumuman->jadwal))
        <div class="informasi-pemberian-box jadwal">
            <div class="box-title">Jadwal Pendaftaran dan Penyaluran</div>
            <ul>
                @foreach($pengumuman->jadwal as $jadwal)
                    <li>{{ $jadwal }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    @endif
    <div class="mt-4">
        <a href="#" class="btn btn-danger">Unduh Jadwal</a>
        <div class="mt-2">Kontak Tim Lanny Jaya Cerdas: 628-xxxx-xxxx</div>
    </div>

@endsection
