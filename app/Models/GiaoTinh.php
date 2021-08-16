<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiaoTinh extends Model
{
    use HasFactory;

    protected $table = 'giao_tinh';

    protected $fillable = [
        'ten_giao_tinh',
        'dia_chi',
        'ngay_thanh_lap',
    ];
}
