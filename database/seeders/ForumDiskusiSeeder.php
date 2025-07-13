<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ForumDiskusiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('forum_diskusi')->insert([
            [
                'Id_Forum_Diskusi' => 'FD001',
                'Judul' => 'Cara Menggunakan Sistem SIBASTU',
                'Deskripsi' => 'Bagaimana cara mendaftar dan mengelola bantuan studi di SIBASTU?',
                'Id_Mahasiswa' => 'MHS001',
                'Id_Tim' => null,
                'Id_Korwil' => null,
                'Id_Dinas' => null,
                'Role_Pengirim' => 'mahasiswa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Id_Forum_Diskusi' => 'FD002',
                'Judul' => 'Masalah Login ke Sistem',
                'Deskripsi' => 'Saya mengalami masalah saat mencoba login ke akun saya. Apakah ada solusi?',
                'Id_Mahasiswa' => null,
                'Id_Tim' => 'TLJ001',
                'Id_Korwil' => null,
                'Id_Dinas' => null,
                'Role_Pengirim' => 'tim',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
