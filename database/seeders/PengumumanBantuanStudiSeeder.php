<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PengumumanBantuanStudiSeeder extends Seeder
{
    public function run()
    {
        DB::table('pengumuman_bantuan_studi')->insert([
            'judul' => 'Pengumuman Bantuan Studi 2025',
            'isi' => 'Pendaftaran bantuan studi tahun 2025 telah dibuka. Silakan lengkapi persyaratan dan ikuti jadwal yang telah ditentukan.',
            'syarat' => json_encode([
                'Fotocopy KTP dan NPWP',
                'Surat Keterangan Aktif Kuliah',
                'Transkrip Nilai Terbaru',
                'Proposal Studi Asli'
            ], JSON_UNESCAPED_UNICODE),
            'jadwal' => json_encode([
                'Pendaftaran Dibuka: 01 Juni 2025',
                'Pendaftaran Ditutup: 20 Juni 2025',
                'Seleksi Berkas: 21-25 Juni 2025',
                'Pengumuman: 28 Juni 2025',
                'Penyaluran: 01 Juli 2025'
            ], JSON_UNESCAPED_UNICODE),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
