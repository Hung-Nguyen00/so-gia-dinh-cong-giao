<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LichSuSgdcg extends Model
{
    use HasFactory;

    protected $table = 'lich_su_sgdcg';

    protected $fillable = [
        'giao_xu_id',
        'note',
        'sgdcg_id',
    ];
}
