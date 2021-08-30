<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChucVu extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];


    protected $table = 'chuc_vu';

    protected $fillable = [
        'ten_chuc_vu',
        'nguoi_khoi_tao'
    ];

    public function tuSi(){
        return $this->hasMany(TuSi::class, 'chuc_vu_id', 'id');
    }

    public function user($id){
        return User::find($id) ? User::find($id)->ho_va_ten : null;
    }
}
