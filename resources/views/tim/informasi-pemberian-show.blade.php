@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/informasi-pemberian-show.css') }}">
<div class="informasi-pemberian-detail-container modern-dashboard" style="padding:32px 0;display:flex;flex-direction:column;align-items:center;">
    <h1 class="dashboard-title" style="text-align:center;">Final Decision: Informasi Pemberian Bantuan</h1>
    <div class="dashboard-top-row flex-row" style="display:flex;gap:24px;align-items:flex-start;justify-content:center;width:100%;max-width:1200px;">
        <!-- Kiri: Data Mahasiswa -->
        <div class="dashboard-card mahasiswa-card" style="flex:1;min-width:320px;max-width:500px;margin-right:0;padding:24px;box-sizing:border-box;">
            <h2 class="section-title">Data Mahasiswa</h2>
            <table class="detail-table modern-table">
                <tr><th>ID Mahasiswa</th><td>{{ $info->mahasiswa->Id_Mahasiswa ?? '-' }}</td></tr>
                <tr><th>Nama Mahasiswa</th><td>{{ $info->mahasiswa->Nama_Mahasiswa ?? '-' }}</td></tr>
                <tr><th>NIM/NPM</th><td>{{ $info->mahasiswa->NIM ?? '-' }}</td></tr>
                <tr><th>Universitas</th><td>{{ $info->mahasiswa->Universitas ?? ($info->mahasiswa->universitas->Nama_Universitas ?? '-') }}</td></tr>
                <tr><th>Jurusan</th><td>{{ $info->mahasiswa->Jurusan ?? '-' }}</td></tr>
                <tr><th>Semester</th><td>{{ $info->mahasiswa->Semester ?? '-' }}</td></tr>
                <tr><th>Alamat</th><td>{{ $info->mahasiswa->Alamat ?? '-' }}</td></tr>
                <tr><th>No HP</th><td>{{ $info->mahasiswa->No_hp ?? '-' }}</td></tr>
                <tr><th>Korwil</th><td>{{ $info->mahasiswa->korwil->Nama_Korwil ?? '-' }}</td></tr>
            </table>
        </div>
        <!-- Kanan: Data Berkas (kecil per file) -->
        <div class="berkas-list-outer-container" style="flex:1;min-width:320px;max-width:500px;">
            <div class="dashboard-card berkas-list-container" style="padding:24px;box-sizing:border-box;">
                <h2 class="section-title">Data Berkas</h2>
                @if($info->mahasiswa->berkas && count($info->mahasiswa->berkas))
                    @foreach($info->mahasiswa->berkas as $berkas)
                        @php
                            $lampiranFields = [
                                'Lampiran_aktifkuliah' => 'Lampiran Aktif Kuliah',
                                'Lampiran_kpm' => 'Lampiran KPM',
                                'Lampiran_ktp' => 'Lampiran KTP',
                                'Lampiran_dns' => 'Lampiran DNS',
                                'Lampiran_kk' => 'Lampiran KK',
                                'Lampiran_rekomendasi' => 'Lampiran Rekomendasi',
                            ];
                        @endphp
                        <div class="berkas-mini-list">
                            <div class="berkas-mini-row"><span class="berkas-mini-label">ID Berkas:</span> <span>{{ $berkas->Id_Berkas }}</span></div>
                            <div class="berkas-mini-row"><span class="berkas-mini-label">Nomor Rekening:</span> <span>{{ $berkas->Nomor_Rekening }}</span></div>
                            <div class="berkas-mini-row"><span class="berkas-mini-label">Nama Bank:</span> <span>{{ $berkas->Nama_Bank }}</span></div>
                            @foreach($lampiranFields as $field => $label)
                                <div class="berkas-mini-row">
                                    <span class="berkas-mini-label">{{ $label }}:</span>
                                    @if($berkas->$field)
                                        <span class="berkas-mini-preview">
                                            <a class="file-link btn btn-xs btn-outline-primary" href="{{ asset('storage/'.$berkas->$field) }}" target="_blank" rel="noopener noreferrer">Lihat</a>
                                        </span>
                                    @else
                                        <span>-</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                @else
                    <div class="berkas-mini-row">Tidak ada berkas.</div>
                @endif
            </div>
        </div>
    </div>
    <!-- Bawah: Keputusan Bantuan Studi (full width) -->
    <div class="dashboard-card keputusan-section keputusan-full">
        <h2 class="section-title">Keputusan Bantuan Studi</h2>
        <form action="{{ route('tim.informasi-pemberian.update', $info->Id_Informasi) }}" method="POST" class="keputusan-form modern-form">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="Id_Bantuan">Jenis Bantuan</label>
                <select name="Id_Bantuan" id="Id_Bantuan" class="form-control" required>
                    @foreach($jenisBantuanList as $bantuan)
                        <option value="{{ $bantuan->Id_Bantuan }}" {{ $info->Id_Bantuan == $bantuan->Id_Bantuan ? 'selected' : '' }}>{{ $bantuan->Jenis_Bantuan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="Tahun_Penerimaan">Tahun Penerimaan</label>
                <input type="text" id="Tahun_Penerimaan" class="form-control" value="{{ $info->bantuanStudi->Tahun_Penerimaan ?? '-' }}" readonly>
            </div>
            <div class="form-group">
                <label for="Status_Bantuan">Status</label>
                <select name="Status_Bantuan" id="Status_Bantuan" class="form-control" required>
                    <option value="proses" {{ $info->Status_Bantuan == 'proses' ? 'selected' : '' }}>Proses</option>
                    <option value="disalurkan" {{ $info->Status_Bantuan == 'disalurkan' ? 'selected' : '' }}>Disalurkan</option>
                    <option value="gagal" {{ $info->Status_Bantuan == 'gagal' ? 'selected' : '' }}>Gagal</option>
                </select>
                @if($info->Status_Bantuan)
                    <span class="status-badge status-{{ $info->Status_Bantuan }}">{{ ucfirst($info->Status_Bantuan) }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="Tgl_Penyaluran">Tanggal Penyaluran</label>
                <input type="date" name="Tgl_Penyaluran" id="Tgl_Penyaluran" class="form-control" value="{{ $info->Tgl_Penyaluran ?? date('Y-m-d') }}">
            </div>
            <div class="form-group">
                <label for="Keterangan">Keterangan</label>
                <textarea name="Keterangan" id="Keterangan" class="form-control" rows="2">{{ $info->Keterangan }}</textarea>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-success dashboard-btn">Simpan Keputusan</button>
                <a href="{{ route('tim.bantuan-studi') }}" class="btn btn-secondary dashboard-btn">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
