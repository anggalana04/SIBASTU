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
        DB::table('akun')->insert(array_map(function ($i) {
            $roles = ['mahasiswa', 'tim', 'korwil', 'dinas'];
            $role = $i <= 30 ? 'mahasiswa' : $roles[array_rand($roles)]; // Ensure first 30 are mahasiswa

            static $mahasiswaCount = 1;
            static $timCount = 1;
            static $korwilCount = 1;
            static $dinasCount = 1;

            $nameSuffix = match ($role) {
                'mahasiswa' => $mahasiswaCount++,
                'tim' => $timCount++,
                'korwil' => $korwilCount++,
                'dinas' => $dinasCount++,
            };

            return [
                'Id_Akun' => 'AKN' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'Id_Tim' => $role === 'tim' ? 'TLJ_' . str_pad($timCount - 1, 3, '0', STR_PAD_LEFT) : null,
                'Id_Korwil' => $role === 'korwil' ? 'KW_' . str_pad($korwilCount - 1, 3, '0', STR_PAD_LEFT) : null,
                'Id_Mahasiswa' => $role === 'mahasiswa' ? 'MHS_' . str_pad($mahasiswaCount - 1, 3, '0', STR_PAD_LEFT) : null,
                'Nama_Akun' => $role . $nameSuffix,
                'Password' => bcrypt('password123'),
                'role' => $role,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, range(1, 50)));
    }
}
