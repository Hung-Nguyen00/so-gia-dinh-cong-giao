<?php

namespace App\Jobs;

use App\Models\SoGiaDinh;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailAfterChuyenXu implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $tries = 3;
    protected $sgd_id, $giao_xu_id;

    public function __construct($sgd_id, $giao_xu_id)
    {
        $this->sgd_id = $sgd_id;
        $this->giao_xu_id = $giao_xu_id;
        $this->queue = 'default'; //choose a queue name
        $this->connection = 'database';
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $sgd = SoGiaDinh::with(['thanhVien' => function ($q){
            $q->where('chuc_vu_gd', 'Cha')->with('tenThanh');
        }])->where('id', $this->sgd_id)->first();
        $users = User::where('giao_xu_id', $this->giao_xu_id)->select('email')->get();
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
    public function failed()
    {
        // Called when the job is failing...
        Toastr::success('Mail fail','Error');
    }
}
