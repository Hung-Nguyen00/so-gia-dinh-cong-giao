<?php

namespace App\Http\Livewire\TuSi;

use App\Models\LichSuCongTac;
use Brian2694\Toastr\Facades\Toastr;
use Livewire\Component;

class LichSuPhucVu extends Component
{
    public $tu_si, $lich_su_cong_tac, $single_cong_tac;

    public function render()
    {
        $this->lich_su_cong_tac = LichSuCongTac::where('tu_si_id', $this->tu_si->id)->orderBy('id', 'DESC')->get();
        return view('livewire.tu-si.lich-su-phuc-vu');
    }

    public function mount($tu_si){
        $this->tu_si = $tu_si;
    }


    public function  edit($id){
        $this->single_cong_tac = LichSuCongTac::find($id);
    }

    public function delete(){
        if ($this->single_cong_tac){
            $this->single_cong_tac->delete();
            Toastr::success('Xóa thành công','Thành công');
        }else{
            Toastr::error('Không tìm thấy','Lỗi');
        }
        return redirect()->route('tu-si.edit', $this->tu_si);
    }

}
