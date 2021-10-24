<?php

namespace App\Http\Livewire\DoanCa;

use App\Models\TenThanh;
use App\Models\tv_doan_ca;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;



class ThanhVien extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $ca_doan, $ten_thanh_vien, $paginate_number=20, $thanh_vien, $tv_id, $ten_thanh_vien_delete;
    protected $queryString = ['ten_thanh_vien', 'paginate_number'];



    public function mount($ca_doan){
        $this->ten_thanh_vien = request()->query('ten_thanh_vien', $this->ten_thanh_vien);
        $this->paginate_number = request()->query('paginate_number', $this->paginate_number);

        $this->ca_doan = $ca_doan;

    }


    public function render()
    {
        $this->dispatchBrowserEvent('contentChanged');
        $all_ten_thanh =TenThanh::all();
        $ca_doan_id = $this->ca_doan->id;
        $all_thanh_vien = DB::table('thanh_vien as tv')
            ->join('ten_thanh as t', 't.id', '=', 'tv.ten_thanh_id')
            ->join('so_gia_dinh_cong_giao as sgd', 'sgd.id','=', 'tv.so_gia_dinh_id')
            ->join('tv_doan_ca as tvdc', 'tvdc.thanh_vien_id', '=', 'tv.id')
            ->join('doan_ca as dc', 'dc.id', '=', 'tvdc.doan_ca_id')
            ->where('dc.id', $ca_doan_id)
            ->orderBy('tvdc.truong_doan', 'DESC')
            ->select(
                'tv.ho_va_ten',
                'tv.id as tv_id',
                'ten_thanh',
                'sgd.id as sdg_id',
                'tv.so_dien_thoai',
                'tvdc.id as tvdc_id',
                'ngay_sinh',
                'tvdc.truong_doan'
            )->paginate(10, ['*'], $pageName='all_thanh_vien');
        # search tv
        if ($this->ten_thanh_vien){
            $all_thanh_vien->where('tv.ho_va_ten', 'like', "%$this->ten_thanh_vien%");
        }
        return view('livewire.doan-ca.thanh-vien')
            ->with(compact('all_ten_thanh', 'all_thanh_vien'));
    }

    public function cancel(){
        $this->ten_thanh_vien = '';
        $this->ten_thanh_vien_delete = '';
        $this->tv_id = '';
    }


    public function edit($id){
        $thanh_vien = DB::table('thanh_vien')
            ->whereId($id)
            ->select('id', 'ho_va_ten')->first();
        if ($thanh_vien){
            $this->tv_id = $id;
            $this->ten_thanh_vien_delete = $thanh_vien->ho_va_ten;
        }
    }

    public function store(){

    }

    public function toggleTruongDoan($tvdc_id){
        $tvdc = DB::table('tv_doan_ca')->select('id', 'truong_doan')->whereId($tvdc_id)->first();
        if($tvdc){
           $truong_doan = $tvdc->truong_doan == 1 ? 0 : 1;
            DB::table('tv_doan_ca')->select('id', 'truong_doan')->whereId($tvdc_id)->update([
                'truong_doan' => $truong_doan
            ]);
            $this->dispatchBrowserEvent('alert',
                ['type' => 'success', 'message' => 'Cập nhập thành công']);
        }else{
            $this->dispatchBrowserEvent('alert',
                ['type' => 'error', 'message' => 'Không tìm thấy thành viên']);
        }
    }

    public function delete(){
        if ($this->ca_doan){
            $this->ca_doan->thanhVien()->detach($this->tv_id);
            $this->dispatchBrowserEvent('alert',
                ['type' => 'success', 'message' => 'Xóa thành công']);
            $this->emit('delete');
        }else{
            $this->dispatchBrowserEvent('alert',
                ['type' => 'error', 'message' => 'Không tìm thấy thành viên']);
            $this->emit('delete');
        }

    }
}
