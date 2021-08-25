<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BiTichDaNhan extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];


    protected $table = 'bi_tich_da_nhan';
    protected $fillable = [
        'thanh_vien_id',
        'bi_tich_id',
        'ngay_dien_ra',
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
        'nguoi_khoi_tao',
        'tu_si_id',
    ];

    public function tuSi(){
        return $this->belongsTo(TuSi::class, 'tu_si_id');
    }

    public function getBiTich($id){
        return BiTich::find($id);
    }



}
