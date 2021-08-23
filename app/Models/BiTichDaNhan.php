<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiTichDaNhan extends Model
{
    use HasFactory;

    protected $fillable = [
        'ngay_dien_ra',
        'noi_dien_ra',
        'ten_nguoi_do_dau',
        'ten_thah_nguoi_do_dau',
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
}
