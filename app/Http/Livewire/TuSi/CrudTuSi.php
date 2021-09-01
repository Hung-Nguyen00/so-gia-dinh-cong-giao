<?php

namespace App\Http\Livewire\TuSi;

use App\Models\ChucVu;
use App\Models\TenThanh;
use App\Models\TuSi;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CrudTuSi extends Component
{

    public function render()
    {
        $this->dispatchBrowserEvent('contentChanged');
        if (Auth::user()->quanTri->ten_quyen !== 'admin'){
            return view('livewire.tu-si.crud-tu-si', [
                'all_tu_si' => TuSi::with(['giaoPhan', 'giaoHat', 'giaoXu', 'tenThanh', 'chucVu'])
                    ->where('giao_phan_id', Auth::user()->giao_phan_id)
                    ->orderBy('created_at', 'DESC')
                    ->get(),
                'all_chuc_vu' => ChucVu::all(),
                'all_ten_thanh' => TenThanh::orderBy('ten_thanh')->get(),
                    ]
            );
        }else{
            return view('livewire.tu-si.crud-tu-si', [
                    'all_tu_si' => TuSi::with(['giaoPhan', 'giaoHat', 'giaoXu', 'tenThanh', 'chucVu'])
                        ->orderBy('created_at', 'DESC')
                        ->get(),
                    'all_chuc_vu' => ChucVu::all(),
                    'all_ten_thanh' => TenThanh::orderBy('ten_thanh')->get(),
                ]
            );
        }

    }
    public function mount(){

    }
}
