<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TuSi extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'tu_si';

    protected $fillable = [
        'ho_va_ten',
        'ngay_sinh',
        'email',
        'nha_dong_id',
        'gioi_tinh',
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
        'chuc_vu_id',
        'bat_dau_phuc_vu',
        'ket_thuc_phuc_vu',
        'vi_tri_id'
    ];

    public function tenThanh(){
        return $this->belongsTo(TenThanh::class, 'ten_thanh_id', 'id');
    }


    public function getTenThanh($id){
        $ten_thanh = TenThanh::find($id);
        if ($ten_thanh != null){
            return $ten_thanh->ten_thanh ;
        }
    }
    public function giaoPhan(){
        return $this->belongsTo(GiaoPhan::class, 'giao_phan_id', 'id');
    }

    public function giaoHat(){
        return $this->belongsTo(GiaoHat::class, 'giao_hat_id', 'id');
    }

    public function giaoXu(){
        return $this->belongsTo(GiaoXu::class, 'giao_xu_id', 'id');
    }

    public function chucVu(){
        return $this->belongsTo(ChucVu::class,'chuc_vu_id', 'id');
    }

    public function viTri(){
        return $this->belongsTo(ViTri::class, 'vi_tri_id');
    }

    public function biTichDaNhan(){
        return $this->hasMany(BiTichDaNhan::class, 'tu_si_id');
    }

    public function nhaDong(){
        return $this->belongsTo(NhaDong::class, 'nha_dong_id','id');
    }
    public function user($id){
        return User::find($id) ? User::find($id)->ho_va_ten : null;
    }
}
