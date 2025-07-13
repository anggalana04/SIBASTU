<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        $korwilIds = DB::table('korwil')->pluck('Id_Korwil')->toArray();

        DB::table('mahasiswa')->insert(array_map(function ($i) use ($korwilIds) {
            return [
                'Id_Mahasiswa' => 'MHS' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'Universitas' => 'Universitas ' . $i,
                'Id_Korwil' => $korwilIds[array_rand($korwilIds)],
                'NIM' => 'NIM' . str_pad($i, 8, '0', STR_PAD_LEFT),
                'Nama_Mahasiswa' => 'Mahasiswa ' . $i,
                'Jurusan' => 'Jurusan ' . $i,
                'Semester' => rand(1, 8),
                'Alamat' => 'Alamat Mahasiswa ' . $i,
                'No_hp' => '081234567' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, range(1, 30)));
    }
}
