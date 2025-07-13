<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResponDiskusiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('respon_diskusi')->insert([
            [
                'Id_Respon' => 'RD001',
                'Id_Forum_Diskusi' => 'FD001',
                'Id_Pengirim' => 'TLJ001',
                'Role_Pengirim' => 'tim',
                'Deskripsi' => 'Untuk mendaftar, Anda bisa mengikuti panduan di menu bantuan pada dashboard.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Id_Respon' => 'RD002',
                'Id_Forum_Diskusi' => 'FD002',
                'Id_Pengirim' => 'MHS002',
                'Role_Pengirim' => 'mahasiswa',
                'Deskripsi' => 'Saya juga mengalami masalah yang sama. Mungkin perlu reset password.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
