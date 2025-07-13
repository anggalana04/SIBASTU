<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
    protected $table = 'berkas';
    protected $primaryKey = 'Id_Berkas';
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = [
        'Id_Berkas',
        'Id_Mahasiswa',
        'Nomor_Rekening',
        'Nama_Bank',
        'Lampiran_aktifkuliah',
        'Lampiran_kpm',
        'Lampiran_ktp',
        'Lampiran_dns',
        'Lampiran_kk',
        'Lampiran_rekomendasi'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'Id_Mahasiswa', 'Id_Mahasiswa');
    }

    public function validasi()
    {
        return $this->hasOne(\App\Models\Validasi::class, 'Id_Berkas', 'Id_Berkas');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->Id_Berkas)) {
                $lastId = self::orderBy('Id_Berkas', 'desc')->value('Id_Berkas');
                $num = 1;
                if ($lastId && preg_match('/BK_(\\d+)/', $lastId, $matches)) {
                    $num = intval($matches[1]) + 1;
                }
                $model->Id_Berkas = 'BK_' . str_pad($num, 3, '0', STR_PAD_LEFT);
            }
        });
    }
}
