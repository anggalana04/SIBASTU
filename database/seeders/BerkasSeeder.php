<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BerkasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('berkas')->insert(array_map(function ($i) {
            return [
                'Id_Berkas' => 'BRK' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'Id_Mahasiswa' => 'MHS' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'Nomor_Rekening' => '123456789' . $i,
                'Nama_Bank' => 'Bank ' . $i,
                'Lampiran_aktifkuliah' => null,
                'Lampiran_kpm' => null,
                'Lampiran_ktp' => null,
                'Lampiran_dns' => null,
                'Lampiran_kk' => null,
                'Lampiran_rekomendasi' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, range(1, 30)));
    }
}
