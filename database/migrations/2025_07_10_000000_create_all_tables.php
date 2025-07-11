<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // 1. Akun
        Schema::create('akun', function (Blueprint $table) {
            $table->string('Id_Akun', 10)->primary();
            $table->string('Id_Tim', 20)->nullable();
            $table->string('Id_Korwil', 10)->nullable();
            $table->string('Id_Mahasiswa', 10)->nullable();
            $table->string('Nama_Akun', 50);
            $table->string('Password');
            $table->enum('role', ['mahasiswa', 'korwil', 'tim', 'dinas'])->default('mahasiswa');
            $table->timestamps();
        });

        // 2. Mahasiswa
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->string('Id_Mahasiswa', 10)->primary();
            $table->string('Id_Universitas', 10)->nullable();
            $table->string('Nama_Mahasiswa', 100);
            $table->string('Jurusan', 50);
            $table->integer('Semester')->nullable();
            $table->text('Alamat')->nullable();
            $table->string('No_hp', 15)->nullable();
            $table->timestamps();
        });

        // 3. Universitas
        Schema::create('universitas', function (Blueprint $table) {
            $table->string('Id_Universitas', 10)->primary();
            $table->string('Nama', 100);
            $table->text('Alamat')->nullable();
        });

        // 4. Berkas
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
            $table->timestamps();
        });

        // 5. Tim
        Schema::create('tim_lanny_jaya_cerdas', function (Blueprint $table) {
            $table->string('Id_Tim', 20)->primary();
            $table->string('Nama', 100);
            $table->string('Alamat', 100);
            $table->string('No_Hp', 20)->nullable();
            $table->string('Email', 100)->nullable();
            $table->string('Jabatan', 50)->nullable();
        });

        // 6. Korwil
        Schema::create('korwil', function (Blueprint $table) {
            $table->string('Id_Korwil', 10)->primary();
            $table->string('Nama_Korwil', 100);
            $table->string('Nama_Kota', 100)->nullable();
        });

        // 7. Bantuan Studi
        Schema::create('bantuan_studi', function (Blueprint $table) {
            $table->string('Id_Bantuan', 20)->primary();
            $table->enum('Jenis_Bantuan', ['uang_saku', 'pembiayaan_pendidikan', 'studi_akhir', 'fasilitas_penunjang']);
            $table->text('Deskripsi')->nullable();
            $table->integer('Nominal');
            $table->string('Periode_Bantuan', 50);
            $table->year('Tahun_Penerimaan')->nullable();
        });

        // 8. Informasi Pemberian Bantuan
        Schema::create('informasi_pemberian_bantuan', function (Blueprint $table) {
            $table->string('Id_Informasi', 20)->primary();
            $table->string('Id_Bantuan', 20);
            $table->string('Id_Mahasiswa', 10);
            $table->string('Id_Korwil', 10);
            $table->enum('Status_Bantuan', ['proses', 'disalurkan', 'gagal'])->default('proses');
            $table->date('Tgl_Penyaluran')->nullable();
            $table->text('Keterangan')->nullable();
        });

        // 9. Validasi
        Schema::create('validasi', function (Blueprint $table) {
            $table->string('Id_Validasi', 30)->primary();
            $table->string('Id_Berkas', 10);
            $table->string('Id_Mahasiswa', 10);
            $table->string('Id_Tim', 20)->nullable();
            $table->enum('Status_Berkas', ['menunggu_verifikasi', 'terverifikasi', 'ditolak'])->default('menunggu_verifikasi');
            $table->text('Catatan')->nullable();
            $table->date('Tgl_Validasi')->nullable();
        });

        // 10. Forum Diskusi
        Schema::create('forum_diskusi', function (Blueprint $table) {
            $table->string('Id_Forum_Diskusi', 11)->primary();
            $table->string('Judul', 150);
            $table->text('Deskripsi')->nullable();
            $table->string('Id_Mahasiswa', 10)->nullable();
            $table->string('Id_Tim', 20)->nullable();
            $table->string('Id_Korwil', 10)->nullable();
            $table->string('Id_Dinas', 10)->nullable();
            $table->enum('Role_Pengirim', ['mahasiswa', 'tim', 'korwil', 'dinas'])->nullable();
            $table->timestamps();
        });

        // 11. Respon Diskusi
        Schema::create('respon_diskusi', function (Blueprint $table) {
            $table->string('Id_Respon', 20)->primary();
            $table->string('Id_Forum_Diskusi', 11);
            $table->string('Id_Pengirim', 20);
            $table->enum('Role_Pengirim', ['mahasiswa', 'tim', 'korwil', 'dinas']);
            $table->text('Deskripsi')->nullable();
            $table->timestamps();

            $table->foreign('Id_Forum_Diskusi')->references('Id_Forum_Diskusi')->on('forum_diskusi')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('akun');
        Schema::dropIfExists('mahasiswa');
        Schema::dropIfExists('universitas');
        Schema::dropIfExists('berkas');
        Schema::dropIfExists('tim_lanny_jaya_cerdas');
        Schema::dropIfExists('korwil');
        Schema::dropIfExists('bantuan_studi');
        Schema::dropIfExists('informasi_pemberian_bantuan');
        Schema::dropIfExists('validasi');
        Schema::dropIfExists('forum_diskusi');
        Schema::dropIfExists('respon_diskusi');
    }
};
