<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiaoPhan extends Model
{
    use HasFactory;

    protected $table = 'giao_phan';

    protected $fillable = [
        'ten_giao_phan',
        'dia_chi',
        'ngay_thanh_lap',
        'nguoi_khoi_tao'
    ];
}
