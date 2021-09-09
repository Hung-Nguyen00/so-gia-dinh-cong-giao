<?php

namespace App\Http\Livewire\Sgdcg;

use App\Models\GiaoHat;
use App\Models\GiaoPhan;
use App\Models\GiaoXu;
use App\Models\TenThanh;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SearchTvAddToSgdcg extends Component
{
    public $soGiaDinh,
        $giao_phan_id = null,
        $giao_xu_id = null,
        $ten_thanh_id = null,
        $ngay_sinh = null,
        $chuc_vu_gd,
        $thanh_vien_id = null;

    public function render()
    {
        $this->dispatchBrowserEvent('contentChanged');
        $all_giao_phan = GiaoPhan::select('id', 'ten_giao_phan')->get();
        $all_ten_thanh = TenThanh::select('id', 'ten_thanh')->get();
        $giao_phan_id = $this->giao_phan_id;

        $all_giao_xu = GiaoXu::with('giaoHat')
            ->whereHas('giaoHat', function ($q) use ($giao_phan_id){
                $q->where('giao_phan_id', $giao_phan_id);
        })->select('id', 'ten_giao_xu', 'giao_hat_id')->get();

        $thanh_vien = DB::table('thanh_vien as tv')
                    ->join('ten_thanh as tt' , 'tv.ten_thanh_id', '=', 'tt.id')
                    ->select('ngay_sinh', 'tt.id as ten_thanh_id','tv.id as thanh_vien_id', 'ten_thanh', 'ho_va_ten')
                    ->where('ngay_sinh', '=', $this->ngay_sinh)
                    ->where('ten_thanh_id', $this->ten_thanh_id)
                    ->get();
        return view('livewire.sgdcg.search-tv-add-to-sgdcg', compact(
            'all_giao_phan',
                    'all_giao_xu',
                        'all_ten_thanh',
                        'thanh_vien'));
    }

    public function mount($soGiaDinh){
        $this->soGiaDinh = $soGiaDinh;
    }

    public function store(){
        $thanh_vien_found = DB::table('thanh_vien')
            ->where('id', $this->thanh_vien_id)->limit(1);
        if ($thanh_vien_found){
            $thanh_vien_found->update([
               'so_gia_dinh_id_2' => $this->soGiaDinh->id,
               'chuc_vu_gd_2' => $this->chuc_vu_gd,
            ]);
            Toastr::success('Thêm mới thành công', 'Thành công');
            return redirect()->route('so-gia-dinh.show', $this->soGiaDinh);
        }
    }
}
