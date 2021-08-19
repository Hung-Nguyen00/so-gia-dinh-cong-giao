<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TenThanh extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'ten_thanh';

    protected $fillable = [
        'ten_thanh',
        'nguoi_khoi_tao'
    ];

    public function tuSi(){
        return $this->hasMany(TuSi::class, 'ten_thanh_id', 'id');
    }

    public function user($id){
        return User::find($id)->ho_va_ten;
    }


}
