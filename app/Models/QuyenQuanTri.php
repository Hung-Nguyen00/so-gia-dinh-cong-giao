<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuyenQuanTri extends Model
{
    use HasFactory, SoftDeletes;


    protected $dates = ['deleted_at'];

    protected $table = 'quyen_quan_tri';

    public $timestamps;

    protected $fillable = [
        'ten_quyen'
    ];

    public  function users(){
        return $this->hasMany(User::class,'quyen_quan_tri_id', 'id');
    }

    public function getUser(){
        return $this->belongsTo(User::class, 'nguoi_khoi_tao', 'id');
    }
}
