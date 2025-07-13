<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InformasiPemberianBantuanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('informasi_pemberian_bantuan')->insert(array_map(function ($i) {
            return [
                'Id_Informasi' => 'INF' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'Id_Bantuan' => 'BA_' . str_pad(rand(1, 4), 3, '0', STR_PAD_LEFT),
                'Id_Mahasiswa' => 'MHS' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'Id_Korwil' => 'KOR' . str_pad(rand(1, 10), 3, '0', STR_PAD_LEFT),
                'Status_Bantuan' => 'proses',
                'Tgl_Penyaluran' => now(),
                'Keterangan' => 'Keterangan ' . $i,
            ];
        }, range(1, 30)));
    }
}
