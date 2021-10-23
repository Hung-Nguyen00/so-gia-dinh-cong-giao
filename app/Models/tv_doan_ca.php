<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tv_doan_ca extends Model
{
    use HasFactory;

    protected $table = 'tv_doan_ca';
    protected $fillable = [
      'thanh_vien_id',
      'doan_ca_id'
    ];
}
