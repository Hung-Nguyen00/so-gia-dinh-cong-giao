<?php

namespace App\Http\Livewire\ChucVu;

use App\Models\ChucVu;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CrudChucVu extends Component
{

    public  $all_chuc_vu, $ten_chuc_vu, $chuc_vu_id, $chuc_vu_model;

    public function render()
    {
        return view('livewire.chuc-vu.crud-chuc-vu');
    }

    public function mount($all_chuc_vu){
        $this->all_chuc_vu = $all_chuc_vu;
    }

    protected $rules = [
        'ten_chuc_vu' => 'required:max:45',

    ];

    protected $messages = [
        'ten_chuc_vu.required' => ':attribute không được phép trống',
        'ten_chuc_vu.max' => ':attribute không được vượt quá :max',

    ];

    protected $validationAttributes = [
        'ten_chuc_vu' => 'tên chức vụ',

    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function clearData(){
        $this->ten_chuc_vu = '';
    }

    public function edit($id){
        $this->ten_chuc_vu = ChucVu::find($id)->ten_chuc_vu;
        $this->chuc_vu_model = ChucVu::find($id);
    }

    public function update(){
        $validateData = $this->validate();
        ChucVu::find($this->chuc_vu_id);
        if ($this->chuc_vu_model ){
            $this->chuc_vu_model->update(array_merge($validateData, ['nguoi_khoi_tao' => Auth::id()]));
            Toastr::success('Cập nhập tên chức vụ thành công','Thành công');
            return redirect()->route('chuc-vu.index');
        }else{
            Toastr::error('Không tìm thấy chức vụ','Lỗi');
            return redirect()->route('chuc-vu.index');
        }

    }

    public function store(){
        $validateData = $this->validate();
        ChucVu::create(array_merge($validateData, ['nguoi_khoi_tao' => Auth::id()]));
        Toastr::success('Thêm tên chức vụ thành công','Thành công');
        return redirect()->route('chuc-vu.index');
    }

    public function delete(){
        if ($this->chuc_vu_model ){
            $this->chuc_vu_model->delete();
            Toastr::success('Xóa thành công','Thành công');
            return redirect()->route('chuc-vu.index');
        }else{
            Toastr::error('Không tìm thấy chức vụ','Lỗi');
            return redirect()->route('chuc-vu.index');
        }
    }
}
