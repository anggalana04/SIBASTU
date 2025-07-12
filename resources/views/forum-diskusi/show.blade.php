@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/detail-forum.css') }}">
<a href="{{ route('forum-diskusi.index') }}" class="btn btn-secondary detail-forum-back" title="Kembali ke Forum" style="padding:0.4em 1em;margin:0.7em 0 0.7em 0.7em;display:inline-block;font-size:1.5rem;z-index:10;text-decoration:none;position:fixed;left:1.5rem;top:1.5rem;">◀️</a>
<div class="detail-forum-container" style="position:relative;">
    <div class="detail-forum-header">
        <div class="detail-forum-avatar">
            {{ $forum->Id_Mahasiswa ? 'M' : ($forum->Id_Korwil ? 'K' : ($forum->Id_Tim ? 'T' : 'D')) }}
        </div>
        <div>
            <div class="detail-forum-title">{{ $forum->Judul }}</div>
            <div class="detail-forum-meta">
                {{ $namaAkunCreator }}
            </div>
        </div>
    </div>
    <div class="detail-forum-desc">{{ $forum->Deskripsi }}</div>
    <div class="detail-forum-komentar-section">
        <div class="detail-forum-komentar-title">Komentar</div>
        <div class="detail-forum-komentar-list">
            @forelse($forum->responDiskusi as $respon)
                <div class="detail-forum-komentar-item">
                    <div class="detail-forum-komentar-avatar">
                        @if($respon->Role_Pengirim === 'mahasiswa')
                            M
                        @elseif($respon->Role_Pengirim === 'tim')
                            T
                        @elseif($respon->Role_Pengirim === 'korwil')
                            K
                        @elseif($respon->Role_Pengirim === 'dinas')
                            D
                        @else
                            ?
                        @endif
                    </div>
                    <div class="detail-forum-komentar-body">
                        <div class="detail-forum-komentar-user">
                            @if($respon->Role_Pengirim === 'mahasiswa' && $respon->akunMahasiswa)
                                {{ $respon->akunMahasiswa->Nama_Akun }}
                            @elseif($respon->Role_Pengirim === 'tim' && $respon->akunTim)
                                {{ $respon->akunTim->Nama_Akun }}
                            @elseif($respon->Role_Pengirim === 'korwil' && $respon->akunKorwil)
                                {{ $respon->akunKorwil->Nama_Akun }}
                            @elseif($respon->Role_Pengirim === 'dinas')
                                Dinas
                            @else
                                -
                            @endif
                        </div>
                        <div class="detail-forum-komentar-text">{{ $respon->Deskripsi }}</div>
                    </div>
                </div>
            @empty
                <div class="detail-forum-komentar-item" style="color:#64748b;">Belum ada Respon.</div>
            @endforelse
        </div>
        @if(auth()->check())
        <form action="{{ route('forum-diskusi.addRespon', $forum->Id_Forum_Diskusi) }}" method="POST" class="detail-forum-komentar-form">
            @csrf
            <textarea name="Deskripsi" rows="3" placeholder="Tulis Respon atau komentar..." required></textarea>
            <button type="submit">Kirim</button>
        </form>
        @endif
    </div>
   
</div>
@endsection
