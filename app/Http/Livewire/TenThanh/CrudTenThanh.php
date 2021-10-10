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
        'ten_thanh' => 'required|max:45|unique:ten_thanh,ten_thanh',
    ];

    protected $messages = [
        'ten_thanh.required' => ':attribute không được phép trống',
        'ten_thanh.max' => ':attribute không được vượt quá :max',
        'ten_thanh.unique' => ':attribute đã tồn tại'
    ];

    protected $validationAttributes = [
        'ten_thanh' => 'Tên thánh',

    ];


    public function clearData(){
        $this->ten_thanh = '';
    }
    public function edit($id){
       $ten_thanh = TenThanh::find($id);
        $this->ten_thanh = $ten_thanh->ten_thanh;
        $this->ten_thanh_model = $ten_thanh;
    }

    public function update(){
        $validatedData = $this->validate([
            'ten_thanh' => 'required|max:50',
        ],[
            'ten_thanh.required' => ':attribute không được phép trống',
            'ten_thanh.max' => ':attribute không được vượt quá :max',
         ]
        );
        TenThanh::find($this->ten_thanh_id);
        if ($this->ten_thanh_model){
            $this->ten_thanh_model->update(array_merge($validatedData, ['nguoi_khoi_tao' => Auth::id()]));
            Toastr::success('Cập nhập tên thánh thành công','Thành công');
            return redirect()->route('ten-thanh.index');
        }else{
            Toastr::error('Không tìm thấy','Lỗi');
            return redirect()->route('ten-thanh.index');
        }

    }

    public function store(){
        $validateData = $this->validate();
        TenThanh::create(array_merge($validateData, ['nguoi_khoi_tao' => Auth::id()]));
        Toastr::success('Thêm tên thánh thành công','Thành công');
        return redirect()->route('ten-thanh.index');
    }

    public function delete(){
        if ($this->ten_thanh_model ){
            $this->ten_thanh_model->delete();
            Toastr::success('Xóa thành công','Thành công');
            return redirect()->route('ten-thanh.index');
        }else{
            Toastr::error('Không tìm thấy ','Lỗi');
            return redirect()->route('ten-thanh.index');
        }
    }

}
