<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEmail extends Model
{
    use HasFactory;

    protected $table = 'user_email';

    protected $fillable = [
        'create_by',
        'send_to',
        'mail_id',
        'status',
    ];
}
