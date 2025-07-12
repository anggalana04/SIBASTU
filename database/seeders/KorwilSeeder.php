<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KorwilSeeder extends Seeder
{
    public function run()
    {
        $korwils = [
            'Korwil Jayapura',
            'Korwil Jayawijaya',
            'Korwil Surabaya',
            'Korwil Tangerang',
            'Korwil Malang',
            'Korwil Bali',
            'Korwil Semarang',
            'Korwil Yogjakarta',
            'Korwil Bogor',
            'Korwil Bandung',
            'Korwil Jakarta',
            'Korwil Makassar',
            'Korwil Siduarjo',
            'Korwil Manado',
            'Korwil Kalimantan',
            'Korwil Sulawesi',
            'Korwil Medan',
            'Korwil Manokowari',
        ];
        foreach ($korwils as $i => $nama) {
            DB::table('korwil')->insert([
                'Id_Korwil' => 'KW_' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                'Nama_Korwil' => $nama,
                'Nama_Kota' => null,
            ]);
        }
    }
}
