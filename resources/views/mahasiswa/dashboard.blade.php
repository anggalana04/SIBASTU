@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/dashboard-mahasiswa.css') }}">
@php
    $user = Auth::user();
    $mahasiswa = \App\Models\Mahasiswa::find($user->Id_Mahasiswa ?? null);
    $berkas = $mahasiswa ? \App\Models\Berkas::where('Id_Mahasiswa', $mahasiswa->Id_Mahasiswa)->first() : null;
    $validasi = $berkas ? \App\Models\Validasi::where('Id_Berkas', $berkas->Id_Berkas)->first() : null;
    $informasi = $mahasiswa ? \App\Models\InformasiPemberianBantuan::where('Id_Mahasiswa', $mahasiswa->Id_Mahasiswa)->latest('Tgl_Penyaluran')->first() : null;
    $step = 1;
    if($mahasiswa) $step = 2;
    if($berkas) $step = 3;
    if($validasi && $validasi->Status_Berkas === 'terverifikasi') $step = 4;
    if($informasi) $step = 5;
@endphp
<div class="dashboard-mhs-main-wrapper">
    
        <h1 class="dashboard-mhs-welcome-title">Selamat Datang di SIBASTU!</h1>
        <div class="dashboard-mhs-welcome-desc">
            SIBASTU (Sistem Informasi Bantuan Studi) adalah platform digital untuk memudahkan mahasiswa dalam mengajukan bantuan dana studi secara transparan, mudah, dan terintegrasi. Silakan lengkapi data, upload berkas, dan pantau proses pengajuan Anda melalui dashboard ini.
        </div>
    
    <footer class="dashboard-mhs-footer">
        <div class="dashboard-mhs-stepper-container">
            <h2 class="dashboard-mhs-title">Pengajuan Bantuan Dana</h2>
            <div class="dashboard-mhs-stepper">
                <div class="dashboard-mhs-step {{ $step > 1 ? 'done' : '' }}{{ $step == 1 ? ' current' : '' }}">
                    <div class="step-circle">
                        @if($step > 1)
                            <span class="step-checkmark">&#10003;</span>
                        @else
                            1
                        @endif
                    </div>
                    <div class="step-label">Pendaftaran Mahasiswa</div>
                    <div class="step-desc">Lengkapi data diri dan pastikan akun terhubung ke data mahasiswa.</div>
                    @if($step == 1)
                        <div class="step-indicator-arrow">&#8593;</div>
                    @endif
                </div>
                <div class="dashboard-mhs-step {{ $step > 2 ? 'done' : '' }}{{ $step == 2 ? ' current' : '' }}">
                    <div class="step-circle">
                        @if($step > 2)
                            <span class="step-checkmark">&#10003;</span>
                        @else
                            2
                        @endif
                    </div>
                    <div class="step-label">Upload Berkas</div>
                    <div class="step-desc">Unggah dokumen persyaratan pada menu upload berkas.</div>
                    @if($step == 2)
                        <div class="step-indicator-arrow">&#8593;</div>
                    @endif
                </div>
                <div class="dashboard-mhs-step {{ $step > 3 ? 'done' : '' }}{{ $step == 3 ? ' current' : '' }}">
                    <div class="step-circle">
                        @if($step > 3)
                            <span class="step-checkmark">&#10003;</span>
                        @else
                            3
                        @endif
                    </div>
                    <div class="step-label">Validasi Berkas</div>
                    <div class="step-desc">Menunggu verifikasi berkas oleh Tim Lanny Jaya Cerdas.</div>
                    {{-- Status removed as requested --}}
                    @if($step == 3)
                        <div class="step-indicator-arrow">&#8593;</div>
                    @endif
                </div>
                <div class="dashboard-mhs-step {{ ($step > 4 && ($informasi && in_array($informasi->Status_Bantuan, ['disalurkan','gagal']))) ? 'done' : '' }}{{ $step == 4 ? ' current' : '' }}">
                    <div class="step-circle">
                        @if($informasi && in_array($informasi->Status_Bantuan, ['disalurkan','gagal']))
                            <span class="step-checkmark">&#10003;</span>
                        @else
                            4
                        @endif
                    </div>
                    <div class="step-label">Hasil Bantuan</div>
                    <div class="step-desc">Informasi hasil pengajuan bantuan dana.</div>
                    {{-- Status removed as requested --}}
                    @if($step == 4)
                        <div class="step-indicator-arrow">&#8593;</div>
                    @endif
                </div>
            </div>
        </div>
    </footer>
</div>
@endsection
