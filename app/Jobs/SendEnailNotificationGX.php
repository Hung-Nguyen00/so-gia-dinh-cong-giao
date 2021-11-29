<?php

namespace App\Jobs;

use App\Models\Email;
use App\Models\User;
use App\Models\UserEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendEnailNotificationGX implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $giao_xu_id, $email_content, $email_id;

    public function __construct($giao_xu_id, $email_content, $email_id)
    {
        $this->giao_xu_id = $giao_xu_id;
        $this->email_content = $email_content;
        $this->email_id = $email_id;
        $this->queue = 'notification'; //choose a queue name
        $this->connection = 'database';
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $users = User::whereIn('giao_xu_id', $this->giao_xu_id)->select('id', 'email')->get();
        foreach ($users as $user){
            $user_email = UserEmail::where('send_to', $user->id)->where('mail_id', $this->email_id)->first();
            Mail::to($user->email)->send(new \App\Mail\SendEnailNotificationGX($this->email_content));
            $user_email->status = 'SUCCESS';
            $user_email->save();
            if (Mail::failures()) {
                $user_email->update([
                    'status' => 'ERROR'
                ]);
            }
        }
    }
}
