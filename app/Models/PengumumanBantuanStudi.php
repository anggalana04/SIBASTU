<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengumumanBantuanStudi extends Model
{
    protected $table = 'pengumuman_bantuan_studi';
    protected $fillable = [
        'judul',
        'isi',
        'tanggal_mulai',
        'tanggal_selesai',
        'syarat',
    ];
}
