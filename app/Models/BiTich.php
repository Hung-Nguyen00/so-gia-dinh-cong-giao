<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BiTich extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['delete_at'];

    protected $table = 'bi_tich';
    protected $fillable = [
        'ten_bi_tich',
        'la_hon_nhan',
        'nguoi_khoi_tao'
    ];

    public function thanhVien(){
        return $this->belongsToMany(ThanhVien::class,
            'bi_tich_da_nhan', 'bi_tich_id', 'thanh_vien_id')
            ->withTimestamps()->withPivot(
                ['ngay_dien_ra',
                  'noi_dien_ra',
                  'ten_nguoi_do_dau',
                  'ten_thanh_nguoi_do_dau',
                  'ngay_sinh_nguoi_do_dau',
                  'ten_nguoi_lam_chung_1',
                  'ten_thanh_nguoi_lam_chung_1',
                  'ngay_sinh_nguoi_lam_chung_1',
                  'ten_nguoi_lam_chung_2',
                  'ten_thanh_nguoi_lam_chung_2',
                  'ngay_sinh_nguoi_lam_chung_2',
                  'nguoi_khoi_tao']);
    }

    public function user($id){
        return User::find($id)->ho_va_ten;
    }
}
