<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Korwil extends Model
{
    protected $table = 'korwil';
    protected $primaryKey = 'Id_Korwil';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'Id_Korwil',
        'Nama_Korwil'
    ];

    public function responDiskusi()
    {
        return $this->hasMany(ResponDiskusi::class, 'Id_Korwil', 'Id_Korwil');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->Id_Korwil)) {
                $lastId = self::orderBy('Id_Korwil', 'desc')->value('Id_Korwil');
                $num = 1;
                if ($lastId && preg_match('/KW_(\\d+)/', $lastId, $matches)) {
                    $num = intval($matches[1]) + 1;
                }
                $model->Id_Korwil = 'KW_' . str_pad($num, 3, '0', STR_PAD_LEFT);
            }
        });
    }
}
