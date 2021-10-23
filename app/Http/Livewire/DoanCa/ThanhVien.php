<?php

namespace App\Http\Livewire\DoanCa;

use App\Models\GiaoXu;
use App\Models\TenThanh;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;



class ThanhVien extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $ca_doan, $ten_thanh_vien, $paginate_number=20;
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
            ->with(compact('all_thanh_vien', 'all_ten_thanh'));
    }


    public function cancel(){

    }


    public function edit($id){

    }

    public function store(){

    }

    public function updated(){

    }

    public function delete(){

    }
}
