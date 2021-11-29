<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $table = 'email';

    protected $fillable = [
        'title',
        'content',
    ];

    public function sendingEmailByUser(){
        return $this->belongsToMany(User::class, 'user_email', 'mail_id', 'create_by');
    }

}
