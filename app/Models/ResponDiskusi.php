<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResponDiskusi extends Model
{
    protected $table = 'respon_diskusi';
    protected $primaryKey = 'Id_Respon';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'Id_Respon',
        'Id_Tim',
        'Id_Mahasiswa',
        'Id_Korwil',
        'Judul',
        'Deskripsi'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->Id_Respon)) {
                $lastId = self::orderBy('Id_Respon', 'desc')->value('Id_Respon');
                $num = 1;
                if ($lastId && preg_match('/RSP_(\\d+)/', $lastId, $matches)) {
                    $num = intval($matches[1]) + 1;
                }
                $model->Id_Respon = 'RSP_' . str_pad($num, 3, '0', STR_PAD_LEFT);
            }
        });
    }

    public function tim()
    {
        return $this->belongsTo(TimLannyJayaCerdas::class, 'Id_Tim', 'Id_Tim');
    }
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'Id_Mahasiswa', 'Id_Mahasiswa');
    }
    public function korwil()
    {
        return $this->belongsTo(Korwil::class, 'Id_Korwil', 'Id_Korwil');
    }
}
