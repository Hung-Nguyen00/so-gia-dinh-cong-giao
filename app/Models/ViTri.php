<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ViTri extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table = 'vi_tri';
    protected $fillable = [
        'ten_vi_tri',
        'nguoi_khoi_tao'
    ];

    public function tuSi(){
        return $this->hasMany(TuSi::class, 'vi_tri_id');
    }

    public function user($id){
        return User::find($id) ? User::find($id)->ho_va_ten : null;
    }

    public function getUser(){
        return $this->belongsTo(User::class, 'nguoi_khoi_tao', 'id');
    }

}
