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
      'noi_sinh',
      'ngay_sinh',
      'so_gia_dinh_id_2',
      'gioi_tinh',
      'chuc_vu_gd',
      'chuc_vu_gd_2',
      'ngay_mat',
      'giao_xu',
      'giao_phan',
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
        return $this->belongsTo(SoGiaDinh::class, 'so_gia_dinh_id','id');
    }
    public function soGiaDinh2(){
        return $this->belongsTo(SoGiaDinh::class, 'so_gia_dinh_id_2', 'id');
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



    public function scopeSearch($query, $term){
        $query->where(function ($query) use ($term){
           $query->where('ho_va_ten', 'like', "%".$term. "%");
        });
    }

    public function getUser(){
        return $this->belongsTo(User::class, 'nguoi_khoi_tao', 'id');
    }

    public function doanCa(){
        return $this->belongsToMany(ThanhVien::class,
            'tv_doan_ca',
            'thanh_vien_id',
            'doan_ca_id')->withTimestamps()->withPivot('truong_doan');
    }
}
