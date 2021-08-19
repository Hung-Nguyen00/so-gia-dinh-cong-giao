<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GiaoHat extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'giao_hat';

    protected $fillable = [
        'ten_giao_hat',
        'dia_chi',
        'ngay_thanh_lap',
        'nguoi_khoi_tao',
        'giao_phan_id'
    ];

    public function giaoPhan(){
        return $this->belongsTo(GiaoPhan::class);
    }

    public function giaoXu(){
        return $this->hasMany(GiaoXu::class);
    }

    public function tuSi(){
        return $this->hasMany(TuSi::class);
    }

    public function user($id){
        return User::find($id)->ho_va_ten;
    }


}
