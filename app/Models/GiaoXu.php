<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiaoXu extends Model
{
    use HasFactory;

    protected $table = 'giao_xu';

    protected $fillable = [
        'ten_giao_xu',
        'dia_chi',
        'ngay_thanh_lap',
        'nguoi_khoi_tao',
        'giao_hat_id',
    ];

    public function giaoHat(){
        return $this->belongsTo(GiaoHat::class);
    }

}
