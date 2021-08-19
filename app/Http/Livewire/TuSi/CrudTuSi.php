<?php

namespace App\Http\Livewire\TuSi;

use App\Models\ChucVu;
use Livewire\Component;

class CrudTuSi extends Component
{
    public $current_chuc_vu, $all_tu_si, $all_chuc_vu;


    public function render()
    {
        return view('livewire.tu-si.crud-tu-si');
    }


    public function mount($all_tu_si){
        $this->all_tu_si = $all_tu_si[0];
        $this->current_chuc_vu = ChucVu::find($all_tu_si[1]);
        $this->all_chuc_vu = ChucVu::all();
    }

}
