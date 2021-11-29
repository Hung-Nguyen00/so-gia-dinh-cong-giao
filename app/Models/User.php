<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\LockableTrait;

class   User extends Authenticatable
{
    use HasFactory, Notifiable;
    use LockableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'email',
        'password',
        'so_dien_thoai',
        'ho_va_ten',
        'quyen_quan_tri_id',
        'giao_phan_id',
        'giao_xu_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function quanTri(){
        return $this->belongsTo(QuyenQuanTri::class, 'quyen_quan_tri_id', 'id');
    }

    public function giaoXu(){
        return $this->belongsTo(GiaoXu::class, 'giao_xu_id', 'id');
    }

    public function giaoPhan(){
        return $this->belongsTo(GiaoPhan::class, 'giao_phan_id', 'id');
    }

    public function sendEmails(){
        return $this->belongsToMany(Email::class, 'user_email', 'create_by', 'mail_id')
                    ->withTimestamps()->withPivot([
                    'status',
                    'send_to',
                    'mail_id',
                    'create_by'
            ]);
    }

    public function ownEmails(){
        return $this->belongsToMany(Email::class, 'user_email', 'send_to', 'mail_id')
            ->withTimestamps()->withPivot([
                'status',
                'send_to',
                'mail_id',
                'create_by'
            ]);
    }
}
