<?php

namespace App\Http\Livewire\SendingEmail;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SendEmail extends Component
{

    public $users, $title, $content;


    public function mount(){
        $this->users = User::with('giaoXu')
                        ->where('giao_phan_id', Auth::user()->giao_phan_id)
                        ->whereNotNull('giao_xu_id')
                        ->where('id', '<>', Auth::id())
                        ->get();
    }

    protected $rules = [
        'title' => 'required|max:255',
        'content' => 'required|max:1000',
    ];

    protected $messages = [
        'title.required' => ':attribute không được phép trống',
        'title.max' => ':attribute không được vượt quá :max kí tự',
        'content.required' => ':attribute không được phép trống',
        'content.max' => ':attribute không được vượt quá :max kí tự',
    ];

    protected $validationAttributes = [
        'title' => 'Chủ đề',
        'content' => 'Nội dung'
    ];

    public function render()
    {
        return view('livewire.sending-email.send-email');
    }

}
