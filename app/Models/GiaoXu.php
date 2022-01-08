<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Znck\Eloquent\Traits\BelongsToThrough;

class GiaoXu extends Model
{
    use HasFactory, SoftDeletes, BelongsToThrough;
    protected $dates = ['deleted_at'];

    protected $table = 'giao_xu';

    protected $fillable = [
        'ten_giao_xu',
        'dia_chi',
        'ngay_thanh_lap',
        'nguoi_khoi_tao',
        'giao_xu_hoac_giao_ho',
        'giao_hat_id',
    ];

    protected static function boot() {
        parent::boot();

        static::deleting(function($q) {
            $q->giaoHo()->delete();
            $q->giaoDan()->delete();
            $q->hoGiaDinh()->delete();
            $q->tuSi()->update(['giao_xu_id' => null]);
            $q->hoGiaDinh()->delete();
            $q->lichSuSgdcg();
        });
    }

    public function giaoHat(){
        return $this->belongsTo(GiaoHat::class);
    }

    public function tuSi(){
        return $this->hasMany(TuSi::class);
    }

    public function giaoHo(){
        return $this->hasMany(GiaoXu::class ,'giao_xu_hoac_giao_ho')->with('giaoHo');
    }

    public function giaoPhan(){
        return $this->belongsToThrough(GiaoPhan::class, GiaoHat::class);
    }

    public function giaoDan(){
        return $this->hasManyThrough(ThanhVien::class, SoGiaDinh::class);
    }

    public function getTenGiaoXu($id){
        $giao_xu = GiaoXu::find($id);
        return  $giao_xu ? $giao_xu->ten_giao_xu : '';
    }

    public function hoGiaDinh(){
        return $this->hasMany(SoGiaDinh::class, 'giao_xu_id', 'id');
    }

    public function lichSuSgdcg(){
        return $this->belongsToMany(GiaoXu::class,'lich_su_sgdcg',
            'giao_xu_id', 'sgdcg_id')
            ->withTimestamps()
            ->withPivot([
            'created_at',
            'giao_xu_id',
            'note',
            'sgdcg_id',
        ]);
    }

    public function getGiaoHo($id){
        $ten_giao_ho = GiaoXu::find($id)->ten_giao_xu;
        if ($ten_giao_ho){
            return $ten_giao_ho;
        }else{
            return null;
        }
    }

    public function getOwnUser(){
        return $this->hasMany(User::class);
    }

    public function getUser(){
        return $this->belongsTo(User::class, 'nguoi_khoi_tao', 'id');
    }
}
