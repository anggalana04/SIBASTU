@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Forum Diskusi Mahasiswa</h1>
    <a href="#" class="btn btn-primary mb-3">Buat Forum</a>
    <div class="alert alert-success" style="display:none">Forum berhasil dibuat!</div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <!-- Dummy Data Start -->
            <tr>
                <td>1</td>
                <td>Tips Belajar Efektif</td>
                <td>Bagikan tips belajar yang efektif selama kuliah online.</td>
                <td>Mahasiswa</td>
                <td>
                    <a href="#" class="btn btn-info btn-sm">Lihat</a>
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Diskusi Beasiswa</td>
                <td>Tempat bertanya dan berbagi info tentang beasiswa.</td>
                <td>Korwil</td>
                <td>
                    <a href="#" class="btn btn-info btn-sm">Lihat</a>
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>Sharing Pengalaman Magang</td>
                <td>Ceritakan pengalaman magangmu di sini.</td>
                <td>Tim Lanny Jaya Cerdas</td>
                <td>
                    <a href="/forum-diskusi/show" class="btn btn-info btn-sm">Lihat</a>
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </td>
            </tr>
            <!-- Dummy Data End -->
        </tbody>
    </table>
</div>
@endsection
