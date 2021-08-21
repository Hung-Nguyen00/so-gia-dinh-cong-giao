<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GiaoTinh extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'giao_tinh';

    protected $fillable = [
        'ten_giao_tinh',
        'dia_chi',
        'ten_nha_tho',
        'nguoi_khoi_tao',
        'ngay_thanh_lap',
    ];


    public function giaoPhan(){
        return $this->hasMany(GiaoPhan::class);
    }

    public  function giaoHat(){
        return $this->hasManyThrough(GiaoHat::class, GiaoPhan::class);
    }

    public function user($id){
        return User::find($id)->ho_va_ten;
    }
}
