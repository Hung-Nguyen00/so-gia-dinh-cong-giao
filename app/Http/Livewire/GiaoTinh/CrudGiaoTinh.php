<?php

namespace App\Http\Livewire\GiaoTinh;

use App\Models\GiaoTinh;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CrudGiaoTinh extends Component
{

    public  $giao_tinh,
        $ten_giao_tinh,
        $dia_chi,
        $ngay_thanh_lap,
        $giao_tinh_id,
        $all_giao_tinh,
        $ten_nha_tho,
        $nam_thanh_lap;

    protected $rules = [
        'ten_giao_tinh' => 'required:max:45',
    ];

    protected $messages = [
        'ten_giao_tinh.required' => ':attribute không được phép trống',
        'ten_giao_tinh.max' => ':attribute không được vượt quá 100 kí tự',
    ];

    protected $validationAttributes = [
        'ten_giao_tinh' => 'Tên giáo tỉnh',
    ];

    public function mount($all_giao_tinh){
        $this->all_giao_tinh = $all_giao_tinh;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.giao-tinh.crud-giao-tinh');
    }

    public function cancel(){
        $this->giao_tinh_id = '';
        $this->ten_giao_tinh = '';
        $this->ngay_thanh_lap = '';
        $this->giao_tinh_id = '';
        $this->dia_chi = '';
    }

    public function edit($id){
        $giao_tinh = GiaoTinh::find($id);
        if ($giao_tinh){
            $this->giao_tinh_id = $giao_tinh->id;
            $this->ten_giao_tinh = $giao_tinh->ten_giao_tinh;
        }
    }

    public function update(){
        $validatedData = $this->validate();
        GiaoTinh::find($this->giao_tinh_id)
            ->update(array_merge($validatedData, ['nguoi_khoi_tao' => Auth::id()]));
        $this->cancel();
        Toastr::success('Cập nhập giáo tỉnh thành công','Thành công');
        return redirect()->route('giao-tinh.index');
    }

}
