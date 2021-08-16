<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiaoHat extends Model
{
    use HasFactory;

    protected $table = 'giao_hat';

    protected $fillable = [
        'ten_giao_hat',
        'dia_chi',
        'ngay_thanh_lap',
        'nguoi_khoi_tao'
    ];

}
