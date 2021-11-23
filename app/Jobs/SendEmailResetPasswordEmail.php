<?php

namespace App\Jobs;

use App\Mail\ResetPasswordEmail;
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

class SendEmailResetPasswordEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $token, $email;

    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
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
        Mail::to($this->email)->send(new ResetPasswordEmail($this->token));
    }
    public function failed()
    {
        // Called when the job is failing...
        Toastr::success('Mail failed','Error');
    }
}
