<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class GiaoTinh extends Model
{
    use HasFactory, SoftDeletes, HasRelationships;
    protected $dates = ['deleted_at'];

    protected $table = 'giao_tinh';

    protected $fillable = [
        'ten_giao_tinh',
        'dia_chi',
        'ten_nha_tho',
        'nguoi_khoi_tao',
        'ngay_thanh_lap',
    ];


    public function giaoPhan(){
        return $this->hasMany(GiaoPhan::class);
    }

    public  function giaoHat(){
        return $this->hasManyThrough(GiaoHat::class, GiaoPhan::class);
    }

    public function tuSi(){
        return $this->hasManyThrough(TuSi::class, GiaoPhan::class);
    }

    public function giaoXu(){
        return $this->hasManyDeep(GiaoXu::class,
            [GiaoPhan::class,GiaoHat::class]);
    }

    public function giaoDan(){
        return $this->hasManyDeep(ThanhVien::class,
            [GiaoPhan::class,GiaoHat::class, GiaoXu::class, SoGiaDinh::class]);
    }

    public function user($id){
        return User::find($id)->ho_va_ten;
    }
}
