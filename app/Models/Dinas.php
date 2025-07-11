<?php
// filepath: c:\laragon\www\SIBASTU\app\Models\Dinas.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dinas extends Model
{
    protected $table = 'dinas';
    protected $primaryKey = 'Id_Dinas';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'Id_Dinas',
        'Nama_Dinas',
    ];
}
