<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SoGiaDinh extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['delete_at'];

    protected $table = 'so_gia_dinh_cong_giao';

    protected $fillable = [
      'ma_so',
      'ngay_tao_so',
      'nguoi_khoi_tao',
      'giao_xu_id',
    ];

    public function giaoXu(){
        return $this->belongsTo(GiaoXu::class, 'giao_xu_id');
    }

    public function thanhVien(){
        return $this->hasMany(ThanhVien::class, 'so_gia_dinh_id');
    }

    public function user($id){
        return User::find($id)->ho_va_ten;
    }
}
