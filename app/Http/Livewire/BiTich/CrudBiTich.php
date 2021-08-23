<?php

namespace App\Http\Livewire\BiTich;

use App\Models\BiTich;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;

class CrudBiTich extends Component
{
    
    public  $all_bi_tich, $ten_bi_tich, $bi_tich_model, $hon_nhan;

    public function render()
    {
        return view('livewire.bi-tich.crud-bi-tich');
    }

    public function mount($all_bi_tich){
        $this->all_bi_tich = $all_bi_tich;
    }

    protected $rules = [
        'ten_bi_tich' => 'required:max:50',

    ];

    protected $messages = [
        'ten_bi_tich.required' => ':attribute không được phép trống',
        'ten_bi_tich.max' => ':attribute không được vượt quá :max',

    ];

    protected $validationAttributes = [
        'ten_bi_tich' => 'tên bí tích',

    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function edit($id){
        $this->ten_bi_tich = BiTich::find($id)->ten_bi_tich;
        $this->bi_tich_model = BiTich::find($id);
    }

    public function update(){
        $validateData = $this->validate();
        if ($this->bi_tich_model){
            $this->bi_tich_model->update(array_merge($validateData, ['nguoi_khoi_tao' => Auth::id()]));
            Toastr::success('Cập nhập tên bí tích thành công','Success');
            return redirect()->route('bi-tich.index');
        }else{
            Toastr::success('Không tìm thấy bí tích','Success');
            return redirect()->route('bi-tich.index');
        }

    }

    public function store(){
        $validateData = $this->validate();
        $string_lower =  Str::lower($validateData['ten_bi_tich']);
        if (strpos($string_lower, 'phối')){
            BiTich::create(array_merge($validateData, ['nguoi_khoi_tao' => Auth::id(), 'la_hon_nhan' => 1]));
        }else{
            BiTich::create(array_merge($validateData, ['nguoi_khoi_tao' => Auth::id()]));
        }
        Toastr::success('Thêm tên bí tích thành công','Success');
        return redirect()->route('bi-tich.index');
    }

    public function delete(){
        if ($this->bi_tich_model ){
            $this->bi_tich_model->delete();
            Toastr::success('Xóa thành công','Success');
            return redirect()->route('bi-tich.index');
        }else{
            Toastr::success('Không tìm thấy bí tích','Success');
            return redirect()->route('bi-tich.index');
        }
    }
}
