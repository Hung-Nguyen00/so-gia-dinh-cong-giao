<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NhaDong extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'nha_dong';

    protected $fillable = [
      'ten_nha_dong',
      'dia_chi',
      'nguoi_khoi_tao',
      'ngay_thanh_lap'
    ];

    public function tuSi(){
        return $this->hasMany(TuSi::class, 'nha_dong_id');
    }

    public function user($id){
        return User::find($id) ? User::find($id)->ho_va_ten : null;
    }
    public function getUser(){
        return $this->belongsTo(User::class, 'nguoi_khoi_tao', 'id');
    }

}
