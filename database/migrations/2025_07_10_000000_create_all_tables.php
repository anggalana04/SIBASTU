<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {

        // 2. Berkas
        Schema::create('berkas', function (Blueprint $table) {
            $table->string('Id_Berkas', 10)->primary();
            $table->string('Id_Mahasiswa', 10);
            $table->string('Nomor_Rekening', 25);
            $table->string('Nama_Bank', 50);
            $table->string('Lampiran_aktifkuliah')->nullable();
            $table->string('Lampiran_kpm')->nullable();
            $table->string('Lampiran_ktp')->nullable();
            $table->string('Lampiran_dns')->nullable();
            $table->string('Lampiran_kk')->nullable();
            $table->string('Lampiran_rekomendasi')->nullable();
        });

        // 3. Mahasiswa
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->string('Id_Mahasiswa', 5)->primary();
            $table->string('Id_Bantuan', 5)->nullable();
            $table->string('Id_Universitas', 6)->nullable();
            $table->string('Nama_Mahasiswa', 50);
            $table->string('Jurusan', 50);
            $table->integer('Semester', false, true)->nullable();
            $table->text('Alamat', 30)->nullable();
            $table->string('No_hp', 15)->nullable();
            $table->string('Laporan_Aktifkuliah', 100)->nullable();
            $table->string('Laporan_Kpm', 100)->nullable();
            $table->string('Laporan_Dns', 100)->nullable();
            $table->string('Laporan_Kk', 100)->nullable();
            $table->string('Laporan_Tabungan', 100)->nullable();
        });

        // 4. Tim Lanny Jaya Cerdas
        Schema::create('tim_lanny_jaya_cerdas', function (Blueprint $table) {
            $table->string('Id_Tim', 20)->primary();
            $table->string('Nama', 20);
            $table->string('Alamat', 100);
            $table->string('No_Hp', 20)->nullable();
            $table->string('Email', 100)->nullable();
            $table->string('Jabatan', 50)->nullable();
        });

        // 5. Bantuan Studi
        Schema::create('bantuan_studi', function (Blueprint $table) {
            $table->string('Id_Bantuan', 20)->primary();
            $table->string('Id_Mahasiswa', 20);
            $table->string('Nama_Mahasiswa', 100);
            $table->year('Tahun_Penerimaan')->nullable();
            $table->date('Tgl_Pendaftar')->nullable();
        });

        // 6. Informasi Pemberian Bantuan
        Schema::create('informasi_pemberian_bantuan', function (Blueprint $table) {
            $table->integer('Id_Informasi', false, true)->primary();
            $table->integer('Id_Bantuan', false, true);
            $table->integer('Id_Mahasiswa', false, true);
            $table->string('Nama_Mahasiswa', 50);
            $table->string('Nama_Korwil', 50);
        });

        // 7. Validasi
        Schema::create('validasi', function (Blueprint $table) {
            $table->string('Id_Validasi', 30)->primary();
            $table->string('Id_Mahasiswa', 20);
            $table->string('Nama_Mahasiswa', 100);
            $table->string('Jurusan', 100);
            $table->string('Fakultas', 100);
            $table->integer('Semester', false, true)->nullable();
            $table->date('Tgl_Validasi')->nullable();
        });

        // 8. Forum Diskusi
        Schema::create('forum_diskusi', function (Blueprint $table) {
            $table->string('Id_Forum_Diskusi', 11)->primary();
            $table->string('Nama_Mahasiswa', 100);
            $table->string('Judul', 150);
            $table->text('Deskripsi')->nullable();
        });

        // 9. Korwil
        Schema::create('korwil', function (Blueprint $table) {
            $table->string('Id_Korwil', 11)->primary();
            $table->string('Nama_Korwil', 100);
        });

        // 10. Respon Diskusi
        Schema::create('respon_diskusi', function (Blueprint $table) {
            $table->string('Id_Respon', 20)->primary();
            $table->string('Id_Tim', 10)->nullable();
            $table->string('Id_Mahasiswa', 15)->nullable();
            $table->string('Id_Korwil', 10)->nullable();
            $table->string('Judul', 100);
            $table->text('Deskripsi')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('berkas');
        Schema::dropIfExists('mahasiswa');
        Schema::dropIfExists('tim_lanny_jaya_cerdas');
        Schema::dropIfExists('bantuan_studi');
        Schema::dropIfExists('informasi_pemberian_bantuan');
        Schema::dropIfExists('validasi');
        Schema::dropIfExists('forum_diskusi');
        Schema::dropIfExists('korwil');
        Schema::dropIfExists('respon_diskusi');
    }
};
