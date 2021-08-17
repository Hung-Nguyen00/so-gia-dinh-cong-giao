<?php

namespace App\Http\Livewire\GiaoPhan;

use App\Models\GiaoPhan;
use App\Models\GiaoTinh;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddNew extends Component
{

    public  $giao_tinh,
        $ten_giao_phan,
        $dia_chi,
        $ngay_thanh_lap,
        $giao_tinh_id,
        $giao_phan_id,
        $all_giao_phan,
        $loading = false;

    protected $rules = [
        'ten_giao_phan' => 'required:max:100',
        'dia_chi' => 'required|max:250',
        'ngay_thanh_lap' => 'required|date',
        'giao_tinh_id' => 'required'
    ];

    protected $messages = [
        'ten_giao_phan.required' => ':attribute không được phép trống',
        'ten_giao_phan.max' => ':attribute không được vượt quá 100 kí tự',
        'dia_chi.required' => ':attribute không được phép trống',
        'ngay_thanh_lap.date'=> ':attribute buộc phải là giá trị ngày tháng năm',
        'ngay_thanh_lap.required' => ':attribute không được phép trống',
        'giao_tinh_id.required' => ':attribute không được phép trống',

    ];

    protected $validationAttributes = [
        'ten_giao_phan' => 'Tên giáo phận',
        'dia_chi' => 'Địa chỉ',
        'ngay_thanh_lap' => 'Ngày thành lập',
        'ten_giao_tinh' => 'Tên giáo tỉnh'
    ];

    public function mount($all_giao_phan){
        $this->all_giao_phan = $all_giao_phan;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        $this->giao_tinh = GiaoTinh::all();
        return view('livewire.giao-phan.add-new');
    }

    public function store()
    {
        $validatedData = $this->validate();
        GiaoPhan::create(array_merge($validatedData, ['nguoi_khoi_tao' => Auth::id()]));
        Toastr::success('Tạo giáo phận mới thành công','Success');
        return redirect()->route('giao-phan.index');
    }

    public function cancel(){
        $this->giao_phan_id = '';
        $this->ten_giao_phan = '';
        $this->ngay_thanh_lap = '';
        $this->giao_tinh_id = '';
        $this->dia_chi = '';
    }

    public function edit($id){
        $giao_phan = GiaoPhan::find($id);
        if ($giao_phan){
            $this->giao_phan_id = $giao_phan->id;
            $this->ten_giao_phan = $giao_phan->ten_giao_phan;
            $this->ngay_thanh_lap = $giao_phan->ngay_thanh_lap;
            $this->giao_tinh_id = $giao_phan->giao_tinh_id;
            $this->dia_chi = $giao_phan->dia_chi;
        }
    }


    public function update(){
        $validatedData = $this->validate();
        GiaoPhan::find($this->giao_phan_id)
            ->update(array_merge($validatedData, ['nguoi_khoi_tao' => Auth::id()]));
        $this->cancel();
        Toastr::success('Cập nhập giáo phận thành công','Success');
        return redirect()->route('giao-phan.index');
    }

    public function delete(){
        $giao_phan = GiaoPhan::find($this->giao_phan_id );
        if ($giao_phan){
            $giao_phan->delete();
            Toastr::success('Xóa giáo phận thành công','Success');
            return redirect()->route('giao-phan.index');
        }else{
            Toastr::error('Không tìm thấy giáo phận','Error');
            return redirect()->route('giao-phan.index');
        }
    }
}
