<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class GiaoPhan extends Model
{
    use HasFactory, SoftDeletes, HasRelationships;
    protected $dates = ['deleted_at'];

    protected $table = 'giao_phan';

    protected $fillable = [
        'ten_giao_phan',
        'dia_chi',
        'ten_nha_tho',
        'ngay_thanh_lap',
        'nguoi_khoi_tao',
        'giao_tinh_id',
    ];


    public function giaoTinh(){
        return $this->belongsTo(GiaoTinh::class);
    }

    public function giaoHat(){
        return $this->hasMany(GiaoHat::class);
    }

    public function giaoXu(){
        return $this->hasManyThrough(GiaoXu::class, GiaoHat::class);
    }

    public function giaoDan(){
        return $this->hasManyDeep(ThanhVien::class, [GiaoHat::class, GiaoXu::class, SoGiaDinh::class]);
    }

    public function tuSi(){
        return $this->hasMany(TuSi::class, 'giao_phan_id', 'id');
    }
    public  function hoGiaDinh(){
        return $this->hasManyDeep(SoGiaDinh::class, [GiaoHat::class, GiaoXu::class]);
    }

    public function user($id){
        return User::find($id) ? User::find($id)->ho_va_ten : null;
    }
    public function getUser(){
        return $this->belongsTo(User::class, 'nguoi_khoi_tao', 'id');
    }
}
