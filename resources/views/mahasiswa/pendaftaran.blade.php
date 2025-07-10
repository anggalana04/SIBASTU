@extends('layouts.app')
@section('content')
<div class="pendaftaran-layout">
    <main class="pendaftaran-main">
        <form action="{{ route('mahasiswa.store') }}" method="POST" class="pendaftaran-form">
            @csrf
            <div class="form-columns">
                <div class="form-col">
                    <div class="form-group">
                        <label>Nama Mahasiswa</label>
                        <input type="text" name="Nama_Mahasiswa" value="{{ old('Nama_Mahasiswa') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Universitas</label>
                        <input type="text" name="Id_Universitas" value="{{ old('Id_Universitas') }}">
                    </div>
                    <div class="form-group">
                        <label>Jurusan</label>
                        <input type="text" name="Jurusan" value="{{ old('Jurusan') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Fakultas</label>
                        <input type="text" name="Fakultas" value="{{ old('Fakultas') }}">
                    </div>
                    <div class="form-group">
                        <label>Semester</label>
                        <input type="number" name="Semester" value="{{ old('Semester') }}">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="Alamat" value="{{ old('Alamat') }}">
                    </div>
                    <div class="form-group">
                        <label>No Hp</label>
                        <input type="text" name="No_hp" value="{{ old('No_hp') }}">
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label>Surat Aktif Kuliah</label>
                        <input type="text" name="Laporan_Aktifkuliah" value="{{ old('Laporan_Aktifkuliah') }}">
                    </div>
                    <div class="form-group">
                        <label>KPM</label>
                        <input type="text" name="Laporan_Kpm" value="{{ old('Laporan_Kpm') }}">
                    </div>
                    <div class="form-group">
                        <label>KTP</label>
                        <input type="text" name="Laporan_Ktp" value="{{ old('Laporan_Ktp') }}">
                    </div>
                    <div class="form-group">
                        <label>DNS</label>
                        <input type="text" name="Laporan_Dns" value="{{ old('Laporan_Dns') }}">
                    </div>
                    <div class="form-group">
                        <label>KK</label>
                        <input type="text" name="Laporan_Kk" value="{{ old('Laporan_Kk') }}">
                    </div>
                    <div class="form-group">
                        <label>Kartu Keluarga</label>
                        <input type="text" name="Laporan_KartuKeluarga" value="{{ old('Laporan_KartuKeluarga') }}">
                    </div>
                    <div class="form-group">
                        <label>Surat Rekomendasi</label>
                        <input type="text" name="Laporan_Rekomendasi" value="{{ old('Laporan_Rekomendasi') }}">
                    </div>
                </div>
            </div>
            <div class="form-group actions">
                <button type="submit" class="btn-primary full-width">Pendaftaran</button>
            </div>
        </form>
    </main>
</div>
@endsection
