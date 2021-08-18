<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TuSi extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'ho_va_ten',
        'ngay_sinh',
        'dia_chi_hien_tai',
        'so_dien_thoai',
        'ngay_nhan_chuc',
        'noi_nhan_chuc',
        'dang_du_hoc',
        'nguoi_khoi_tao',
        'giao_phan_id',
        'giao_hat_id',
        'giao_xu_id',
        'ten_thanh_id',
    ];

    public function tenThanh(){
        return $this->belongsTo(TenThanh::class);
    }

    public function giaoPhan(){
        return $this->belongsTo(GiaoPhan::class);
    }

    public function giaoXu(){
        return $this->belongsTo(GiaoXu::class);
    }

    public function user($id){
        return User::find($id)->ho_va_ten;
    }
}
