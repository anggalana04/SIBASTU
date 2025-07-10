<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformasiPemberianBantuan extends Model
{
    protected $table = 'informasi_pemberian_bantuan';
    protected $primaryKey = 'Id_Informasi';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'Id_Informasi',
        'Id_Bantuan',
        'Id_Mahasiswa',
        'Nama_Mahasiswa',
        'Nama_Korwil'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->Id_Informasi)) {
                $lastId = self::orderBy('Id_Informasi', 'desc')->value('Id_Informasi');
                $num = 1;
                if ($lastId && preg_match('/Info_(\\d+)/', $lastId, $matches)) {
                    $num = intval($matches[1]) + 1;
                }
                $model->Id_Informasi = 'Info_' . str_pad($num, 3, '0', STR_PAD_LEFT);
            }
        });
    }

    public function bantuanStudi()
    {
        return $this->belongsTo(BantuanStudi::class, 'Id_Bantuan', 'Id_Bantuan');
    }
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'Id_Mahasiswa', 'Id_Mahasiswa');
    }
}
