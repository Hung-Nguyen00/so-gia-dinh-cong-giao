<?php

namespace App\Http\Livewire\DoanCa;

use App\Models\GiaoXu;
use App\Models\TenThanh;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class AddingThanhVien extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $ca_doan, $ho_va_ten, $ngay_sinh, $ten_thanh_id, $so_dien_thoai, $paginate_number=20;
    protected $queryString = ['ho_va_ten', 'ngay_sinh', 'ten_thanh_id', 'so_dien_thoai'];


    public function mount($ca_doan){
        $this->ho_va_ten = request()->query('ho_va_ten', $this->ho_va_ten);
        $this->ngay_sinh = request()->query('ngay_sinh', $this->ngay_sinh);
        $this->ten_thanh_id = request()->query('ten_thanh_id', $this->ten_thanh_id);
        $this->so_dien_thoai = request()->query('so_dien_thoai', $this->so_dien_thoai);
        $this->ca_doan = $ca_doan;
    }


    public function render()
    {

        $this->dispatchBrowserEvent('contentChanged');
        # search tv from GX to add new members to this.CaDoan
        $giao_ho = GiaoXu::where('giao_xu_hoac_giao_ho', Auth::user()->giao_xu_id)
            ->orWhere('id', Auth::user()->giao_xu_id)
            ->pluck('id')->toArray();


        $ca_doan_id = $this->ca_doan->id;
        $tv_ca_doan = \App\Models\ThanhVien::whereHas('doanCa', function ($q) use ($ca_doan_id){
           $q->where('doan_ca_id', $ca_doan_id);
        })->pluck('id');

        $all_tv_adding = DB::table('thanh_vien as tv')
            ->leftJoin('ten_thanh as t', 't.id', '=', 'tv.ten_thanh_id')
            ->leftJoin('so_gia_dinh_cong_giao as sgd', 'sgd.id', '=', 'tv.so_gia_dinh_id')
            ->leftJoin('so_gia_dinh_cong_giao as sgd2', 'sgd2.id', '=', 'tv.so_gia_dinh_id_2')
            ->leftJoin('giao_xu as gx', 'gx.id', '=', 'sgd.giao_xu_id')
            ->leftJoin('giao_xu as gx1', 'gx1.id', '=', 'sgd2.giao_xu_id')
            ->whereIn('gx.id', $giao_ho)
            ->select(
                'tv.ho_va_ten',
                'tv.id as tv_id',
                'ten_thanh',
                'tv.so_dien_thoai',
                'ngay_sinh'
            );

        if ($this->ho_va_ten){
            $all_tv_adding->where('ho_va_ten', 'like', "%$this->ho_va_ten%");
        }
        if ($this->ngay_sinh){
            $all_tv_adding->where('ngay_sinh', $this->ngay_sinh);
        }
        if ($this->so_dien_thoai){
            $all_tv_adding->where('so_dien_thoai', $this->so_dien_thoai);
        }
        if ($this->ten_thanh_id){
            $all_tv_adding->where('ten_thanh_id', $this->ten_thanh_id);
        }

        $all_tv_adding = $all_tv_adding->paginate($this->paginate_number);
        $all_ten_thanh = TenThanh::select('id', 'ten_thanh')->get();
        return view('livewire.doan-ca.adding-thanh-vien')
            ->with(compact('all_tv_adding', 'all_ten_thanh', 'tv_ca_doan'));
    }


    public function addThanhVien($id){
        $this->ca_doan->thanhVien()->attach($id);
        $this->dispatchBrowserEvent('alert',
            ['type' => 'success', 'message' => 'Thêm thành công']);
    }

    public function deleteThanhVien($id){
        $this->ca_doan->thanhVien()->detach($id);
        $this->dispatchBrowserEvent('alert',
            ['type' => 'success', 'message' => 'Xóa thành công']);
    }
}
