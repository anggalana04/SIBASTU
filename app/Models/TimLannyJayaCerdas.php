<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimLannyJayaCerdas extends Model
{
    protected $table = 'tim_lanny_jaya_cerdas';
    protected $primaryKey = 'Id_Tim';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'Id_Tim',
        'Nama',
        'Alamat',
        'No_Hp',
        'Email',
        'Jabatan'
    ];

    public function responDiskusi()
    {
        return $this->hasMany(ResponDiskusi::class, 'Id_Tim', 'Id_Tim');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->Id_Tim)) {
                $lastId = self::orderBy('Id_Tim', 'desc')->value('Id_Tim');
                $num = 1;
                if ($lastId && preg_match('/TLJ_(\\d+)/', $lastId, $matches)) {
                    $num = intval($matches[1]) + 1;
                }
                $model->Id_Tim = 'TLJ_' . str_pad($num, 3, '0', STR_PAD_LEFT);
            }
        });
    }
}
