<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Validasi extends Model
{
    protected $table = 'validasi';
    protected $primaryKey = 'Id_Validasi';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'Id_Validasi',
        'Id_Mahasiswa',
        'Nama_Mahasiswa',
        'Jurusan',
        'Fakultas',
        'Semester',
        'Tgl_Validasi'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'Id_Mahasiswa', 'Id_Mahasiswa');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->Id_Validasi)) {
                $lastId = self::orderBy('Id_Validasi', 'desc')->value('Id_Validasi');
                $num = 1;
                if ($lastId && preg_match('/VD_(\\d+)/', $lastId, $matches)) {
                    $num = intval($matches[1]) + 1;
                }
                $model->Id_Validasi = 'VD_' . str_pad($num, 3, '0', STR_PAD_LEFT);
            }
        });
    }
}
