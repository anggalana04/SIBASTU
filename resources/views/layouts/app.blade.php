<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="stylesheet" href="/css/app.css">
        <link rel="icon" type="image/png" href="{{ asset('image/Lambang_Kabupaten_Lanny_Jaya__Papua-removebg-preview.png') }}">
    </head>
    <body>
        <header class="main-header">
            <div class="app-header" style="display:flex;align-items:center;gap:18px;padding:0 24px;min-height:64px;">
                <img src="{{ asset('image/Lambang_Kabupaten_Lanny_Jaya__Papua-removebg-preview.png') }}" alt="Logo Lanny Jaya" style="height:48px;width:auto;display:block;">
                <span class="app-title" style="font-size:2rem;font-weight:700;color:#2563eb;">{{ config('app.name', 'SIBASTU') }}</span>
            </div>
        </header>
        <div class="container">
            <aside class="sidebar">
                <nav>
                    @php
                        $user = auth()->user();
                    @endphp
                    @if($user && $user->role === 'mahasiswa')
                        <ul>
                            <li><a href="/mahasiswa/dashboard" class="@if(request()->is('mahasiswa/dashboard')) active @endif">🏠 Dashboard</a></li>
                            <li><a href="{{ route('mahasiswa.pendaftaran') }}" class="@if(request()->is('mahasiswa/pendaftaran')) active @endif">📝 Pendaftaran</a></li>
                            <li><a href="/mahasiswa/upload-berkas" class="@if(request()->is('mahasiswa/upload-berkas')) active @endif">📤 Upload Berkas</a></li>
                            <li><a href="/mahasiswa/informasi-pemberian" class="@if(request()->is('mahasiswa/informasi-pemberian')) active @endif">💡 Informasi Pemberian</a></li>
                            <li><a href="/mahasiswa/forum-diskusi" class="@if(request()->is('mahasiswa/forum-diskusi*')) active @endif">💬 Forum Diskusi</a></li>
                            <li><a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">🚪 Logout</a></li>
                        </ul>
                    @elseif($user && $user->role === 'korwil')
                        <ul>
                            <li><a href="/korwil/dashboard" class="@if(request()->is('korwil/dashboard')) active @endif">🏠 Dashboard</a></li>
                            <li><a href="/forum-diskusi" class="@if(request()->is('forum-diskusi*')) active @endif">💬 Forum Diskusi</a></li>
                            <li><a href="/korwil/respon-diskusi" class="@if(request()->is('korwil/respon-diskusi')) active @endif">🗨️ Respon Diskusi</a></li>
                            <li><a href="/korwil/setting" class="@if(request()->is('korwil/setting')) active @endif">⚙️ Setting</a></li>
                            <li><a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">🚪 Logout</a></li>
                        </ul>
                    @elseif($user && $user->role === 'tim')
                        <ul>
                            <li><a href="/tim/dashboard" class="@if(request()->is('tim/dashboard')) active @endif">🏠 Dashboard</a></li>
                            <li><a href="/tim/bantuan-studi" class="@if(request()->is('tim/bantuan-studi')) active @endif">🎓 Bantuan Studi</a></li>
                            <li><a href="/tim/data-mahasiswa" class="@if(request()->is('tim/data-mahasiswa')) active @endif">👨‍🎓 Data Mahasiswa</a></li>
                            <li><a href="/tim/data-korwil" class="@if(request()->is('tim/data-korwil')) active @endif">🧑 Data Korwil</a></li>
                            <li><a href="/tim/validasi-berkas" class="@if(request()->is('tim/validasi-berkas*')) active @endif">✅ Berkas</a></li>
                            <li><a href="/tim/informasi-pemberian" class="@if(request()->is('tim/informasi-pemberian')) active @endif">💡 Pemberian</a></li>
                            <li><a href="/tim/akun" class="@if(request()->is('tim/akun*')) active @endif">🔑 Manajemen Akun</a></li>
                            <li><a href="/forum-diskusi" class="@if(request()->is('forum-diskusi*')) active @endif">💬 Forum Diskusi</a></li>
                            <li><a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">🚪 Logout</a></li>
                        </ul>
                    @elseif($user && $user->role === 'dinas')
                        <ul>
                            <li><a href="/dinas/dashboard" class="@if(request()->is('dinas/dashboard')) active @endif">🏠 Dashboard</a></li>
                            <li><a href="/dinas/pendaftaran" class="@if(request()->is('dinas/pendaftaran')) active @endif">📝 Laporan Pendaftaran</a></li>
                            <li><a href="/dinas/bantuan" class="@if(request()->is('dinas/bantuan')) active @endif">💡 Laporan Pemberian</a></li>
                            <li><a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">🚪 Logout</a></li>
                        </ul>
                    @else
                        <ul>
                            <li><a href="/dashboard" class="@if(request()->is('dashboard')) active @endif">🏠 Dashboard</a></li>
                            <li><a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">🚪 Logout</a></li>
                        </ul>
                    @endif
                    <form id="logout-form" action="/logout" method="POST" style="display: none;">
                        @csrf
                    </form>
                </nav>
            </aside>
            <main class="main-content">
                @yield('content')
            </main>
        </div>
        <style>
            .active {
                background: #2563eb;
                color: #fff !important;
                border-radius: 7px;
                font-weight: 600;
            }
            .sidebar ul li a {
                display: block;
                padding: 0.7rem 1.2rem;
                color: #2563eb;
                text-decoration: none;
                transition: background 0.2s, color 0.2s;
            }
            .sidebar ul li a:hover:not(.active) {
                background: #e0e7ef;
                color: #1746a2;
            }
        </style>
    </body>
</html>
