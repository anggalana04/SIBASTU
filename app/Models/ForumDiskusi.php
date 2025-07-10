<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumDiskusi extends Model
{
    protected $table = 'forum_diskusi';
    protected $primaryKey = 'Id_Forum_Diskusi';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'Id_Forum_Diskusi',
        'Nama_Mahasiswa',
        'Judul',
        'Deskripsi'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'Nama_Mahasiswa', 'Nama_Mahasiswa');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->Id_Forum_Diskusi)) {
                $lastId = self::orderBy('Id_Forum_Diskusi', 'desc')->value('Id_Forum_Diskusi');
                $num = 1;
                if ($lastId && preg_match('/FT_(\\d+)/', $lastId, $matches)) {
                    $num = intval($matches[1]) + 1;
                }
                $model->Id_Forum_Diskusi = 'FT_' . str_pad($num, 3, '0', STR_PAD_LEFT);
            }
        });
    }
}
