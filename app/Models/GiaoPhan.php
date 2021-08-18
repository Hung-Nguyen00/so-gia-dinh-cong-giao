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
        'ten_nha_tho',
        'ngay_thanh_lap',
        'nguoi_khoi_tao',
        'giao_tinh_id',
    ];


    public function giaoTinh(){
        return $this->belongsTo(GiaoTinh::class);
    }

    public function giaoHat(){
        return $this->hasMany(GiaoHat::class);
    }

    public function user($id){
        return User::find($id)->ho_va_ten;
    }

}
