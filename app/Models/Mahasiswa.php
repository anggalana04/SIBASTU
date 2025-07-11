<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'Id_Mahasiswa';
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = [
        'Id_Mahasiswa',
        'Id_Universitas',
        'Nama_Mahasiswa',
        'Jurusan',
        'Semester',
        'Alamat',
        'No_hp'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->Id_Mahasiswa)) {
                $lastId = self::orderBy('Id_Mahasiswa', 'desc')->value('Id_Mahasiswa');
                $num = 1;
                if ($lastId && preg_match('/MS_(\\d+)/', $lastId, $matches)) {
                    $num = intval($matches[1]) + 1;
                }
                $model->Id_Mahasiswa = 'MS_' . str_pad($num, 3, '0', STR_PAD_LEFT);
            }
        });
    }

    public function berkas()
    {
        return $this->hasMany(Berkas::class, 'Id_Mahasiswa', 'Id_Mahasiswa');
    }
    public function bantuanStudi()
    {
        return $this->belongsTo(BantuanStudi::class, 'Id_Bantuan', 'Id_Bantuan');
    }
    public function informasiPemberianBantuan()
    {
        return $this->hasMany(InformasiPemberianBantuan::class, 'Id_Mahasiswa', 'Id_Mahasiswa');
    }
    public function validasi()
    {
        return $this->hasMany(Validasi::class, 'Id_Mahasiswa', 'Id_Mahasiswa');
    }
    public function forumDiskusi()
    {
        return $this->hasMany(ForumDiskusi::class, 'Nama_Mahasiswa', 'Nama_Mahasiswa');
    }
    public function responDiskusi()
    {
        return $this->hasMany(ResponDiskusi::class, 'Id_Mahasiswa', 'Id_Mahasiswa');
    }
}
