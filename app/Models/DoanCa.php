<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoanCa extends Model
{
    use HasFactory;

    protected $table = 'doan_ca';

    protected $fillable = [
      'ten_doan_ca',
      'ngay_bon_mang',
      'ten_thanh_id',
        'giao_xu_id',
    ];

    public function tenThanh(){
        return $this->belongsTo(TenThanh::class);
    }

    public function thanhvien(){
        return $this->belongsToMany(ThanhVien::class,
            'tv_doan_ca',
            'doan_ca_id',
            'thanh_vien_id')->withTimestamps()->withPivot('truong_doan');
    }
}
