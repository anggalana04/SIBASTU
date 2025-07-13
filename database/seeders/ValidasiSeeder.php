<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ValidasiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('validasi')->insert(array_map(function ($i) {
            return [
                'Id_Validasi' => 'VAL' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'Id_Berkas' => 'BRK' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'Id_Mahasiswa' => 'MHS' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'Id_Tim' => $i % 2 === 0 ? 'TIM' . str_pad($i, 3, '0', STR_PAD_LEFT) : null,
                'Status_Berkas' => 'menunggu_verifikasi',
                'Catatan' => 'Catatan validasi ' . $i,
                'Tgl_Validasi' => now(),
            ];
        }, range(1, 30)));
    }
}
