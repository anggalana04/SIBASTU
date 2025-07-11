<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        <header class="main-header">
            <div class="header-content">
                <h1>{{ config('app.name', 'Laravel') }}</h1>
            </div>
        </header>
        <div class="container">
            <aside class="sidebar">
                <nav>
                    @php
                        $user = Auth::user();
                    @endphp
                    @if($user && $user->role === 'mahasiswa')
                        <ul>
                            <h1>{{ $user->role }}</h1>
                            <li><a href="/mahasiswa/dashboard">Dashboard</a></li>
                            <li><a href="{{ route('mahasiswa.pendaftaran') }}">Pendaftaran</a></li>
                            <li><a href="/mahasiswa/upload-berkas">Upload Berkas</a></li>
                            <li><a href="/mahasiswa/informasi-pemberian">Informasi Pemberian</a></li>
                            <li><a href="/mahasiswa/forum-diskusi">Forum Diskusi</a></li>
                            <li><a href="/profile">Profile</a></li>
                            <li><a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                        </ul>
                    @elseif($user && $user->role === 'korwil')
                        <ul>
                            <li><a href="/korwil/dashboard">Dashboard</a></li>
                            <li><a href="/korwil/forum-diskusi">Forum Diskusi</a></li>
                            <li><a href="/korwil/respon-diskusi">Respon Diskusi</a></li>
                            <li><a href="/korwil/setting">Setting</a></li>
                            <li><a href="/profile">Profile</a></li>
                            <li><a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                        </ul>
                    @elseif($user && $user->role === 'tim')
                        <ul>
                            <li><a href="/tim/dashboard">Dashboard</a></li>
                            <li><a href="/tim/bantuan-studi">Bantuan Studi</a></li>
                            <li><a href="/tim/data-mahasiswa">Data Mahasiswa</a></li>
                            <li><a href="/tim/data-korwil">Data Korwil</a></li>
                            <li><a href="/tim/validasi-berkas">Validasi Berkas</a></li>
                            <li><a href="/tim/informasi-pemberian">Informasi Pemberian</a></li>
                            <li><a href="/tim/forum-diskusi">Forum Diskusi</a></li>
                            <li><a href="/profile">Profile</a></li>
                            <li><a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                        </ul>
                    @elseif($user && $user->role === 'dinas')
                        <ul>
                            <li><a href="/dinas/dashboard">Dashboard</a></li>
                            <li><a href="/dinas/laporan">Laporan</a></li>
                            <li><a href="/dinas/laporan/pendaftaran">Laporan Pendaftaran</a></li>
                            <li><a href="/dinas/laporan/pemberian">Laporan Pemberian</a></li>
                            <li><a href="/profile">Profile</a></li>
                            <li><a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                        </ul>
                    @else
                        <ul>
                            <li><a href="/dashboard">Dashboard</a></li>
                            <li><a href="/profile">Profile</a></li>
                            <li><a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                        </ul>
                    @endif
                    <form id="logout-form" action="/logout" method="POST" style="display: none;">
                        @csrf
                    </form>
                </nav>
            </aside>
            <main class="main-content">
                <!-- Page Content -->
                @yield('content')
            </main>
        </div>
    </body>
</html>
