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
        'ten_giao_tinh' => 'required:max:100',
        'dia_chi' => 'required|max:250',
        'ngay_thanh_lap' => 'nullable|date',
        'nam_thanh_lap' => 'max:2500',
        'giao_tinh_id' => 'required',
        'ten_nha_tho' => 'required|max:100'
    ];

    protected $messages = [
        'ten_giao_tinh.required' => ':attribute không được phép trống',
        'ten_giao_tinh.max' => ':attribute không được vượt quá 100 kí tự',
        'dia_chi.required' => ':attribute không được phép trống',
        'ngay_thanh_lap.date'=> ':attribute buộc phải là giá trị ngày tháng năm',
        'ten_nha_tho.required' => ':attribute không được phép trống',
        'ten_nha_tho.max' => ':attribute không được vượt quá 100 kí tự',
        'nam_thanh_lap.max' => ':attribute không được vượt quá :max'

    ];

    protected $validationAttributes = [
        'ten_giao_tinh' => 'Tên giáo tỉnh',
        'dia_chi' => 'Địa chỉ',
        'ngay_thanh_lap' => 'Ngày thành lập',
        'ten_nha_tho'   => 'Tên nhà thờ',
        'nam_thanh_lap' => 'Năm thành lập'
    ];

    public function mount($all_giao_tinh){
        $this->all_giao_tinh = $all_giao_tinh;
    }

    public function updated($propertyName)
    {
        if ($this->nam_thanh_lap != null){
            $this->ngay_thanh_lap = '01/01/'.$this->nam_thanh_lap;
        }
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
            $this->ten_nha_tho = $giao_tinh->ten_nha_tho;
            $this->ten_giao_tinh = $giao_tinh->ten_giao_tinh;
            $this->dia_chi = $giao_tinh->dia_chi;
            // set ngay_thanh_lap if user input only year and vice verse
            if (\Carbon\Carbon::parse($giao_tinh->ngay_thanh_lap)->format('d-m') == '01-01'){
                $this->nam_thanh_lap = \Carbon\Carbon::parse($giao_tinh->ngay_thanh_lap)->format('Y') ;
            }else{
                $this->ngay_thanh_lap = $giao_tinh->ngay_thanh_lap;
            }
        }
    }

    public function update(){
        $validatedData = $this->validate();
        $validatedData['ngay_thanh_lap'] = Carbon::parse($validatedData['ngay_thanh_lap'])->format('Y-m-d');

        GiaoTinh::find($this->giao_tinh_id)
            ->update(array_merge($validatedData, ['nguoi_khoi_tao' => Auth::id()]));
        $this->cancel();
        Toastr::success('Cập nhập giáo tỉnh thành công','Thành công');
        return redirect()->route('giao-tinh.index');
    }

}
