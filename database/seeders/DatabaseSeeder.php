<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\AkunSeeder;
use Database\Seeders\KorwilSeeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        DB::table('bantuan_studi')->insert([
            [
                'Id_Bantuan' => 'BA_001',
                'Jenis_Bantuan' => 'uang_saku',
                'Deskripsi' => 'Bantuan uang saku untuk kebutuhan harian mahasiswa',
                'Nominal' => 2000000,
                'Periode_Bantuan' => 'Ganjil 2025',
                'Tahun_Penerimaan' => 2025,
            ],
            [
                'Id_Bantuan' => 'BA_002',
                'Jenis_Bantuan' => 'pembiayaan_pendidikan',
                'Deskripsi' => 'Membantu pembayaran biaya kuliah semester genap',
                'Nominal' => 5000000,
                'Periode_Bantuan' => 'Genap 2025',
                'Tahun_Penerimaan' => 2025,
            ],
            [
                'Id_Bantuan' => 'BA_003',
                'Jenis_Bantuan' => 'studi_akhir',
                'Deskripsi' => 'Diberikan kepada mahasiswa tingkat akhir untuk menyelesaikan skripsi',
                'Nominal' => 3000000,
                'Periode_Bantuan' => 'Akhir 2025',
                'Tahun_Penerimaan' => 2025,
            ],
            [
                'Id_Bantuan' => 'BA_004',
                'Jenis_Bantuan' => 'fasilitas_penunjang',
                'Deskripsi' => 'Fasilitas berupa barang seperti laptop atau modem',
                'Nominal' => 0,
                'Periode_Bantuan' => 'Tahunan',
                'Tahun_Penerimaan' => 2025,
            ],
        ]);

        // Seed tables in the correct order based on relationships
        $this->call([
            AkunSeeder::class,
            KorwilSeeder::class,
            // MahasiswaSeeder::class,
            // BerkasSeeder::class,
            // TimLannyJayaCerdasSeeder::class,
            // InformasiPemberianBantuanSeeder::class,
            // ValidasiSeeder::class,
            // ForumDiskusiSeeder::class,
            // ResponDiskusiSeeder::class,
            PengumumanBantuanStudiSeeder::class,
        ]);
    }
}
