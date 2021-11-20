<?php

namespace App\Listeners;

use App\Events\SendingEmailAfterChuyenXu;
use App\Models\SoGiaDinh;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class MailAfterChuyenXu
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SendingEmailAfterChuyenXu  $event
     * @return void
     */
    public function handle(SendingEmailAfterChuyenXu $event)
    {
        $sgd = SoGiaDinh::with(['thanhVien' => function ($q){
            $q->where('chuc_vu_gd', 'Cha')->with('tenThanh');
        }])->where('id',$event->sgd_id)->first();
        $users = User::where('giao_xu_id', $event->giao_xu_id)->select('email')->get();
        $data = [];
        foreach($sgd->thanhVien as $tv){
            $data['ten_thanh_id'] = $tv->tenThanh->id;
            $data['ho_va_ten'] = $tv->ho_va_ten;
            break;
        }
        foreach ($users as $user){
            Mail::to($user->email)->send(new \App\Mail\SendingEmailAfterChuyenXu($data));
        }
    }
}
