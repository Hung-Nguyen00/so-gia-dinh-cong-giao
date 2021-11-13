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
      'la_nhap_xu',
      'nguoi_khoi_tao',
      'giao_xu_id',
    ];

    public function giaoXu(){
        return $this->belongsTo(GiaoXu::class, 'giao_xu_id');
    }

    public function thanhVien(){
        return $this->hasMany(ThanhVien::class, 'so_gia_dinh_id', 'id');
    }

    public function thanhVienSo2(){
        return $this->hasMany(ThanhVien::class, 'so_gia_dinh_id_2', 'id');
    }

    public function lichSuChuyenXu(){
        return $this->belongsToMany(GiaoXu::class,
            'lich_su_sgdcg',
            'sgdcg_id',
            'giao_xu_id')
            ->withTimestamps()
            ->withPivot([
            'created_at',
            'giao_xu_id',
            'note',
            'sgdcg_id',
        ]);
    }

    public function user($id){
        return User::find($id) ? User::find($id)->ho_va_ten : null;
    }

    public function getUser(){
        return $this->belongsTo(User::class, 'nguoi_khoi_tao', 'id');
    }

    public function getTenGiaoXu($id){
        $gx = GiaoXu::find($id);
        return $gx ? $gx->ten_giao_xu : '';
    }
}
