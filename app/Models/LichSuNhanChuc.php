<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LichSuNhanChuc extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'lich_su_nhan_chuc';
    protected $fillable = [
        'ngay_nhan_chuc',
        'chuc_vu',
        'noi_nhan_chuc',
        'tu_si_id',
        'nguoi_khoi_tao'
    ];
}
