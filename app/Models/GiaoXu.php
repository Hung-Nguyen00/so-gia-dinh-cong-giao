<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GiaoXu extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'giao_xu';

    protected $fillable = [
        'ten_giao_xu',
        'dia_chi',
        'ngay_thanh_lap',
        'nguoi_khoi_tao',
        'giao_xu_hoac_giao_ho',
        'giao_hat_id',
    ];

    public function giaoHat(){
        return $this->belongsTo(GiaoHat::class);
    }

    public function tuSi(){
        return $this->hasMany(TuSi::class);
    }

    public function giaoHo(){
        return $this->hasMany(GiaoXu::class ,'giao_xu_hoac_giao_ho')->with('giaoHo');
    }

    public function getGiaoHo($id){
        $ten_giao_ho = GiaoXu::find($id)->ten_giao_xu;
        if ($ten_giao_ho){
            return $ten_giao_ho;
        }else{
            return null;
        }
    }
    public function user($id){
        return User::find($id)->ho_va_ten;
    }
}
