@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Detail Forum Diskusi</h1>
    <!-- Dummy Forum Detail -->
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title">Tips Belajar Efektif</h4>
            <p class="card-text">Bagikan tips belajar yang efektif selama kuliah online.</p>
            <span class="badge bg-primary">Mahasiswa</span>
        </div>
    </div>
    <h5>Respon Diskusi</h5>
    <ul class="list-group mb-3">
        <li class="list-group-item">
            <strong>Mahasiswa:</strong> Saya biasanya membuat jadwal belajar harian agar lebih teratur.
        </li>
        <li class="list-group-item">
            <strong>Tim Lanny Jaya Cerdas:</strong> Gunakan teknik pomodoro untuk meningkatkan fokus saat belajar.
        </li>
        <li class="list-group-item">
            <strong>Korwil:</strong> Jangan lupa untuk berdiskusi dengan teman jika ada materi yang sulit dipahami.
        </li>
    </ul>
    <form>
        <div class="mb-3">
            <label for="respon" class="form-label">Tambah Respon</label>
            <textarea class="form-control" id="respon" rows="3" placeholder="Tulis respon Anda..."></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
    <a href="#" class="btn btn-secondary mt-3">Kembali ke Forum</a>
</div>
@endsection
