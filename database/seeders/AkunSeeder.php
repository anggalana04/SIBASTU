<?php
// database/seeders/AkunSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AkunSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('akun')->insert([
            [
                'Id_Akun' => 'AK_001',
                'Nama_Akun' => 'mahasiswa1',
                'Password' => Hash::make('password123'),
                'role' => 'mahasiswa',
                'Id_Tim' => null,
                'Id_Korwil' => null,
                'Id_Mahasiswa' => 'MS_001',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Id_Akun' => 'AK_002',
                'Nama_Akun' => 'korwil1',
                'Password' => Hash::make('password123'),
                'role' => 'korwil',
                'Id_Tim' => null,
                'Id_Korwil' => 'KW_001',
                'Id_Mahasiswa' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Id_Akun' => 'AK_003',
                'Nama_Akun' => 'tim1',
                'Password' => Hash::make('password123'),
                'role' => 'tim',
                'Id_Tim' => 'TLJ_001',
                'Id_Korwil' => null,
                'Id_Mahasiswa' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Id_Akun' => 'AK_004',
                'Nama_Akun' => 'dinas1',
                'Password' => Hash::make('password123'),
                'role' => 'dinas',
                'Id_Tim' => null,
                'Id_Korwil' => null,
                'Id_Mahasiswa' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
