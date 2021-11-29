<?php

namespace App\Http\Livewire\SendingEmail;

use App\Models\Email;
use App\Models\GiaoXu;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;

class SendNotification extends Component
{


    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $content, $title, $all_emails, $email_id, $paginate_number=20;
    protected $queryString = ['email_id'];


    public function mount(){

        $this->email_id = request()->query('email_id', $this->email_id);
        $this->all_emails = Email::whereHas('sendingEmailByUser', function ($q){
            $q->where('create_by', Auth::id());
        })->orderBy('created_at', 'DESC')->get();
        if (! $this->email_id){
            $this->email_id = Email::latest()->first()->id;
        }
    }


    public function render()
    {
        $email_id = $this->email_id;
        $this->dispatchBrowserEvent('contentChanged');
        $users_success = User::whereHas('ownEmails', function ($q) use ($email_id){
            $q->where('user_email.mail_id', $email_id)->where('user_email.status', 'SUCCESS');
        })->whereHas('giaoPhan', function ($q){
            $q->where('id', Auth::user()->giao_phan_id);
        })->pluck('giao_xu_id');

        $users_pending = User::whereHas('ownEmails', function ($q) use ($email_id){
            $q->where('user_email.mail_id', $email_id)->where('user_email.status', 'PENDING');
        })->whereHas('giaoPhan', function ($q){
            $q->where('id', Auth::user()->giao_phan_id);
        })->pluck('giao_xu_id');

        $users_error = User::whereHas('ownEmails', function ($q) use ($email_id){
            $q->where('user_email.mail_id', $email_id)->where('user_email.status', 'ERROR');
        })->whereHas('giaoPhan', function ($q){
            $q->where('id', Auth::user()->giao_phan_id);
        })->pluck('giao_xu_id');

        $gx_success = GiaoXu::whereIn('id', $users_success)->with('giaoHat');
        $gx_pending = GiaoXu::whereIn('id', $users_pending)->with('giaoHat')->get();
        $gx_error = GiaoXu::whereIn('id', $users_error)->with('giaoHat')->get();

        $current_email = Email::where('id', $this->email_id)->first();
        if ($current_email){
            $this->content = $current_email->content;
            $this->title = $current_email->title;
        }

        return view('livewire.sending-email.send-notification')->with([
            'gxs' => $gx_success->paginate($this->paginate_number),
            'gx_pending' => $gx_pending,
            'gx_error' => $gx_error
        ]);
    }
}
