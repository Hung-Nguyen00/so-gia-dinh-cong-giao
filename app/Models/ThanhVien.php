<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ThanhVien extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['delete_at'];

    protected $table = 'thanh_vien';

    protected $fillable = [
      'ho_va_ten',
      'ngay_sinh',
      'ngay_mat',
      'quan_he',
      'dia_chi_hien_tai',
      'so_dien_thoai',
      'so_gia_dinh_id',
      'ten_thanh_id',
      'nguoi_khoi_tao',
    ];

    public function tenThanh(){
        return $this->belongsTo(TenThanh::class, 'ten_thanh_id');
    }

    public function soGiaDinh(){
        return $this->belongsTo(SoGiaDinh::class, 'so_gia_dinh_id');
    }

    public function biTich(){
        return $this->belongsToMany(BiTich::class,
            'bi_tich_da_nhan', 'thanh_vien_id', 'bi_tich_id')
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

}
