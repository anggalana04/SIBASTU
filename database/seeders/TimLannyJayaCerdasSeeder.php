<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimLannyJayaCerdasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tim_lanny_jaya_cerdas')->insert(array_map(function ($i) {
            return [
                'Id_Tim' => 'TIM' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'Nama' => 'Tim ' . $i,
                'Alamat' => 'Alamat Tim ' . $i,
                'No_Hp' => '081234567' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'Email' => 'tim' . $i . '@example.com',
                'Jabatan' => 'Jabatan ' . $i,
            ];
        }, range(1, 10)));
    }
}
