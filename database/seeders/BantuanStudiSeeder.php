<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BantuanStudiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('bantuan_studi')->insert(array_map(function ($i) {
            return [
                'id' => $i,
                'jenis_bantuan' => 'Jenis ' . $i,
                'deskripsi' => 'Deskripsi bantuan ' . $i,
                'nominal' => rand(1000000, 5000000),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, range(1, 30)));
    }
}
