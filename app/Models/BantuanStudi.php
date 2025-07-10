<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BantuanStudi extends Model
{
    protected $table = 'bantuan_studi';
    protected $primaryKey = 'Id_Bantuan';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'Id_Bantuan',
        'Id_Mahasiswa',
        'Nama_Mahasiswa',
        'Tahun_Penerimaan',
        'Tgl_Pendaftar'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'Id_Mahasiswa', 'Id_Mahasiswa');
    }
    public function informasiPemberianBantuan()
    {
        return $this->hasMany(InformasiPemberianBantuan::class, 'Id_Bantuan', 'Id_Bantuan');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->Id_Bantuan)) {
                $lastId = self::orderBy('Id_Bantuan', 'desc')->value('Id_Bantuan');
                $num = 1;
                if ($lastId && preg_match('/BA_(\\d+)/', $lastId, $matches)) {
                    $num = intval($matches[1]) + 1;
                }
                $model->Id_Bantuan = 'BA_' . str_pad($num, 3, '0', STR_PAD_LEFT);
            }
        });
    }
}
