@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/index-berkas.css') }}">
<div class="validasi-berkas-container">
    <div class="validasi-berkas-header">
        <h1>Validasi Berkas Mahasiswa</h1>
    </div>
    <form action="{{ route('validasi.update', $berkas->Id_Berkas) }}" method="POST" class="validasi-berkas-form" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="form-group">
                <label>Nama Mahasiswa</label>
                <input type="text" value="{{ $berkas->mahasiswa->Nama_Mahasiswa }}" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label>NIM/NPM</label>
                <input type="text" value="{{ $berkas->mahasiswa->Id_Mahasiswa }}" class="form-control" readonly>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Program Studi</label>
                <input type="text" value="{{ $berkas->mahasiswa->Jurusan }}" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label>Semester</label>
                <input type="text" value="{{ $berkas->mahasiswa->Semester }}" class="form-control" readonly>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Lampiran KHS</label>
                @if($berkas->Lampiran_dns)
                    <a href="{{ asset('storage/'.$berkas->Lampiran_dns) }}" target="_blank">Lihat File</a>
                @else
                    <span style="color:#64748b;">Belum diupload</span>
                @endif
            </div>
            <div class="form-group">
                <label>Lampiran KRS</label>
                @if($berkas->Lampiran_aktifkuliah)
                    <a href="{{ asset('storage/'.$berkas->Lampiran_aktifkuliah) }}" target="_blank">Lihat File</a>
                @else
                    <span style="color:#64748b;">Belum diupload</span>
                @endif
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Lampiran Lain</label>
                @if($berkas->Lampiran_kpm)
                    <a href="{{ asset('storage/'.$berkas->Lampiran_kpm) }}" target="_blank">Lihat File</a>
                @else
                    <span style="color:#64748b;">Belum diupload</span>
                @endif
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Status Validasi</label>
                <input type="hidden" name="Status_Validasi" id="status_validasi_input" value="">
                <div id="catatan-group" style="display:none;margin-bottom:1rem;">
                    <label for="catatan_input">Catatan Penolakan <span style="color:#ef4444">*</span></label>
                    <textarea name="Catatan" id="catatan_input" class="form-control" rows="3" placeholder="Tuliskan alasan penolakan..." style="margin-top:0.5rem;"></textarea>
                </div>
                <div class="validasi-berkas-actions">
                    <button type="button" class="btn btn-primary" onclick="setStatusAndSubmit('terverifikasi')">Validasi</button>
                    <button type="button" class="btn btn-danger" onclick="setStatusAndSubmit('ditolak')">Tolak</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
function setStatusAndSubmit(status) {
    document.getElementById('status_validasi_input').value = status;
    if(status === 'ditolak') {
        document.getElementById('catatan-group').style.display = 'block';
        document.getElementById('catatan_input').setAttribute('required', 'required');
        // Only submit if catatan is filled
        if(!document.getElementById('catatan_input').value.trim()) {
            document.getElementById('catatan_input').focus();
            return;
        }
    } else {
        document.getElementById('catatan-group').style.display = 'none';
        document.getElementById('catatan_input').removeAttribute('required');
    }
    document.querySelector('.validasi-berkas-form').submit();
}
</script>
@endsection
