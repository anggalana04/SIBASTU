<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengumumanBantuanStudi extends Model
{
    protected $table = 'pengumuman_bantuan_studi';
    protected $fillable = [
        'judul',
        'isi',
        'syarat',
        'jadwal',
    ];

    protected $casts = [
        'syarat' => 'array',
        'jadwal' => 'array',
    ];
}
