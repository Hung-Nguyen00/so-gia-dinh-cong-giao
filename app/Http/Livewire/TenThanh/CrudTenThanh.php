<?php

namespace App\Http\Livewire\TenThanh;

use App\Models\TenThanh;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CrudTenThanh extends Component
{
    public  $all_ten_thanh, $ten_thanh, $ten_thanh_id, $ten_thanh_model;

    public function render()
    {
        return view('livewire.ten-thanh.crud-ten-thanh');
    }

    public function mount($all_ten_thanh){
        $this->all_ten_thanh = $all_ten_thanh;
    }

    protected $rules = [
        'ten_thanh' => 'required:max:50',

    ];

    protected $messages = [
        'ten_thanh.required' => ':attribute không được phép trống',
        'ten_thanh.max' => ':attribute không được vượt quá :max',

    ];

    protected $validationAttributes = [
        'ten_thanh' => 'Tên thánh',

    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function edit($id){
        $this->ten_thanh = TenThanh::find($id)->ten_thanh;
        $this->ten_thanh_model = TenThanh::find($id);
    }

    public function update(){
        $validateData = $this->validate();
        TenThanh::find($this->ten_thanh_id);
        if ($this->ten_thanh_model ){
            $this->ten_thanh_model->update(array_merge($validateData, ['nguoi_khoi_tao' => Auth::id()]));
            Toastr::success('Cập nhập tên thánh thành công','Success');
            return redirect()->route('ten-thanh.index');
        }else{
            Toastr::success('Không tìm thấy tên thánh','Success');
            return redirect()->route('ten-thanh.index');
        }

    }

    public function store(){
        $validateData = $this->validate();
        TenThanh::create(array_merge($validateData, ['nguoi_khoi_tao' => Auth::id()]));
        Toastr::success('Thêm tên thánh thành công','Success');
        return redirect()->route('ten-thanh.index');
    }

    public function delete(){
        if ($this->ten_thanh_model ){
            $this->ten_thanh_model->delete();
            Toastr::success('Xóa thành công','Success');
            return redirect()->route('ten-thanh.index');
        }else{
            Toastr::success('Không tìm thấy tên thánh','Success');
            return redirect()->route('ten-thanh.index');
        }
    }

}
