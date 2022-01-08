<?php

namespace App\Http\Livewire\TuSi;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ViTri extends Component
{
    public  $all_vi_tri, $ten_vi_tri, $vi_tri_model;
    
    public function render()
    {
        return view('livewire.tu-si.vi-tri');
    }

    public function mount(){
        $this->all_vi_tri = \App\Models\ViTri::with('getUser')
            ->withCount('tuSi')
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    protected $rules = [
        'ten_vi_tri' => 'required|max:45',

    ];

    protected $messages = [
        'ten_vi_tri.required' => ':attribute không được phép trống',
        'ten_vi_tri.max' => ':attribute không được vượt quá :max',

    ];

    protected $validationAttributes = [
        'ten_vi_tri' => 'Tên thánh',

    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public  function clearData(){
        $this->ten_vi_tri = '';
    }

    public function edit($id){
        $this->ten_vi_tri = \App\Models\ViTri::find($id)->ten_vi_tri;
        $this->vi_tri_model = \App\Models\ViTri::find($id);
    }

    public function update(){
        $validateData = $this->validate();
        if ($this->vi_tri_model){
            $this->vi_tri_model->update(array_merge($validateData, ['nguoi_khoi_tao' => Auth::id()]));
            Toastr::success('Cập nhập tên thánh thành công','Thành công');
            return redirect()->route('vi-tri.index');
        }else{
            Toastr::error('Không tìm thấy tên thánh','Thành công');
            return redirect()->route('vi-tri.index');
        }

    }

    public function store(){
        $validateData = $this->validate();
        \App\Models\ViTri::create(array_merge($validateData, ['nguoi_khoi_tao' => Auth::id()]));
        Toastr::success('Thêm tên thánh thành công','Thành công');
        return redirect()->route('vi-tri.index');
    }

    public function delete(){
        if ($this->vi_tri_model ){
            $this->vi_tri_model->delete();
            Toastr::success('Xóa thành công','Thành công');
            return redirect()->route('vi-tri.index');
        }else{
            Toastr::error('Không tìm thấy tên thánh','Lỗi');
            return redirect()->route('vi-tri.index');
        }
    }
}
