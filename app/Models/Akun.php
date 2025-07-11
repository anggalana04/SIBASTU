<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Akun extends Authenticatable
{
    use Notifiable;

    protected $table = 'akun';
    protected $primaryKey = 'Id_Akun';
    protected $keyType = 'string';
    public $incrementing = false;


    protected $fillable = [
        'Nama_Akun',
        'Password',
        'Id_Tim',
        'Id_Korwil',
        'Id_Mahasiswa',
        'role'
    ];

    public function getAuthIdentifierName()
    {
        return 'Id_Akun';
    }

    public function getAuthIdentifier()
    {
        return $this->Id_Akun;
    }

    protected $hidden = [
        'Password',
    ];

    public $timestamps = true;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->Id_Akun)) {
                $lastId = self::orderBy('Id_Akun', 'desc')->value('Id_Akun');
                $num = 1;
                if ($lastId && preg_match('/AK_(\\d+)/', $lastId, $matches)) {
                    $num = intval($matches[1]) + 1;
                }
                $model->Id_Akun = 'AK_' . str_pad($num, 3, '0', STR_PAD_LEFT);
            }
        });
    }

    public function getAuthPassword()
    {
        return $this->Password;
    }
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'Id_Mahasiswa', 'Id_Mahasiswa');
    }
    public function tim()
    {
        return $this->belongsTo(TimLannyJayaCerdas::class, 'Id_Tim', 'Id_Tim');
    }
    public function korwil()
    {
        return $this->belongsTo(Korwil::class, 'Id_Korwil', 'Id_Korwil');
    }
}
