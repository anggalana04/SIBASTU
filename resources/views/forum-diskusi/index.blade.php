@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/forum-diskusi.css') }}">

    <div class="forum-twitter-header">
        <h1>Forum Diskusi</h1>
        <a href="{{ route('forum-diskusi.create') }}" class="btn-primary btn-forum-create">Buat Forum</a>
    </div>

    <div class="forum-twitter-feed">
        @if($forums->isEmpty())
            <div class="forum-twitter-empty" style="text-align:center;padding:2rem;color:#2563eb;font-weight:500;">
                belum ada data, yu kita diskusi!
            </div>
        @else
            @foreach($forums as $forum)
                <div class="forum-twitter-post">
                    <div class="forum-twitter-avatar">
                        {{ $forum->Id_Mahasiswa ? 'M' : ($forum->Id_Korwil ? 'K' : ($forum->Id_Tim ? 'T' : 'D')) }}
                    </div>
                    <div class="forum-twitter-body">
                        <div class="forum-twitter-user">
                            @if($forum->Id_Mahasiswa && $forum->akunMahasiswa)
                                Mahasiswa <span class="forum-twitter-role">@.{{ $forum->akunMahasiswa->Nama_Akun }}</span>
                            @elseif($forum->Id_Korwil && $forum->akunKorwil)
                                Korwil <span class="forum-twitter-role">@.{{ $forum->akunKorwil->Nama_Akun }}</span>
                            @elseif($forum->Id_Tim && $forum->akunTim)
                                Tim Lanny Jaya Cerdas <span class="forum-twitter-role">@.{{ $forum->akunTim->Nama_Akun }}</span>
                            @else
                                Dinas
                            @endif
                        </div>
                        <a href="{{ route('forum-diskusi.show', $forum->Id_Forum_Diskusi) }}" class="forum-twitter-title forum-twitter-link">{{ $forum->Judul }}</a>
                        <div class="forum-twitter-desc">{{ $forum->Deskripsi }}</div>
                        <div class="forum-twitter-actions">
                            @if(auth()->user() && auth()->user()->role === 'tim')
                                <form action="{{ route('forum-diskusi.destroy', $forum->Id_Forum_Diskusi) }}" method="POST" style="display:inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger btn-small" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
