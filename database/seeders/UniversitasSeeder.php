<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UniversitasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('universitas')->insert(array_map(function ($i) {
            return [
                'id' => $i,
                'name' => 'Universitas ' . $i,
                'location' => 'Location ' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, range(1, 30)));
    }
}
