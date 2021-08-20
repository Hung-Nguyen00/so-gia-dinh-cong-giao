<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LichSuCongTac extends Model
{
    use HasFactory;

    protected $table = 'lich_su_cong_tac';
    protected $fillable = [
      'ten_giao_phan',
        'ten_giao_xu',
        'ten_giao_hat',
        'ten_giao_ho',
        'bat_dau_phuc_vu',
        'ket_thuc_phuc_vu',
        'tu_si_id',
        'ten_vi_tri'
    ];
}
