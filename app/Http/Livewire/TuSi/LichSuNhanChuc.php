<?php

namespace App\Http\Livewire\TuSi;

use Brian2694\Toastr\Facades\Toastr;
use Livewire\Component;

class LichSuNhanChuc extends Component
{

    public $tu_si, $lich_su_nhan_chuc, $ngay_nhan_chuc, $noi_nhan_chuc, $chuc_vu, $single_nhan_chuc;

    public function render()
    {
        $this->lich_su_nhan_chuc = \App\Models\LichSuNhanChuc::where('tu_si_id', $this->tu_si->id)->get();
        return view('livewire.tu-si.lich-su-nhan-chuc');
    }

    public function mount($tu_si){
        $this->tu_si = $tu_si;
    }

    public function  edit($id){
        $this->single_nhan_chuc = \App\Models\LichSuNhanChuc::find($id);
    }

    public function delete(){
        if ($this->single_nhan_chuc){
            $this->single_nhan_chuc->delete();
            Toastr::success('Xóa thành công','Thành công');
        }else{
            Toastr::error('Không tìm thấy','Lỗi');
        }
        return redirect()->route('tu-si.edit', $this->tu_si);
    }
}
