<?php

namespace App\Http\Livewire\GiaoHat;

use App\Models\GiaoHat;
use App\Models\GiaoPhan;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CrudGiaoHat extends Component
{
    public  $giao_phan,
        $ten_giao_hat,
        $ngay_thanh_lap,
        $nam_thanh_lap,
        $giao_phan_id,
        $giao_hat_id,
        $all_giao_hat,
        $ten_nha_tho,
        $loading = false;

    protected $rules = [
        'ten_giao_hat' => 'required:max:100',
        'nam_thanh_lap' => 'max:2500',
        'giao_phan_id' => 'required',
        'ngay_thanh_lap' => 'date|nullable'
    ];

    protected $messages = [
        'ten_giao_hat.required' => ':attribute không được phép trống',
        'ten_giao_hat.max' => ':attribute không được vượt quá 100 kí tự',
        'giao_phan_id.required' => ':attribute không được phép trống',
        'nam_thanh_lap.max' => ':attribute không được phép lớn hơn :max',
        'ngay_thanh_lap.date' => ':attribute phải đúng dạng ngày tháng năm'
    ];

    protected $validationAttributes = [
        'ten_giao_hat' => 'Tên giáo hạt',
        'giao_phan_id' => 'Tên giáo hạt',
        'nam_thanh_lap' => 'Giá trị năm',
        'ngay_thanh_lap' => 'Ngày thành lập'
    ];

    public function mount($all_giao_hat){

        $this->all_giao_hat = $all_giao_hat;
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
        $this->giao_phan = GiaoPhan::all();
        return view('livewire.giao-hat.crud-giao-hat');
    }

    public function store()
    {
        $validatedData = $this->validate();
        $validatedData['ngay_thanh_lap'] = Carbon::parse($validatedData['ngay_thanh_lap'])->format('Y-m-d');
        GiaoHat::create(array_merge($validatedData, ['nguoi_khoi_tao' => Auth::id()]));
        Toastr::success('Tạo giáo hạt mới thành công','Success');
        return redirect()->route('giao-hat.index');
    }

    public function cancel(){
        $this->giao_hat_id = '';
        $this->ten_giao_hat = '';
        $this->ngay_thanh_lap = '';
        $this->giao_phan_id = '';
        $this->nam_thanh_lap = '';
    }

    public function edit($id){
        $this->cancel();
        $giao_hat = GiaoHat::find($id);
        if ($giao_hat){
            $this->giao_hat_id = $giao_hat->id;
            $this->ten_giao_hat = $giao_hat->ten_giao_hat;
            if (\Carbon\Carbon::parse($giao_hat->ngay_thanh_lap)->format('d-m') == '01-01'){
                $this->nam_thanh_lap = \Carbon\Carbon::parse($giao_hat->ngay_thanh_lap)->format('Y');
            }else{
                $this->ngay_thanh_lap = $giao_hat->ngay_thanh_lap;
            }
            $this->giao_phan_id = $giao_hat->giao_phan_id;
            $this->dia_chi = $giao_hat->dia_chi;
        }
    }


    public function update(){
        $validatedData = $this->validate();
        $validatedData['ngay_thanh_lap'] = Carbon::parse($validatedData['ngay_thanh_lap'])->format('Y-m-d');
        GiaoHat::find($this->giao_hat_id)
                ->update(array_merge($validatedData, ['nguoi_khoi_tao' => Auth::id()]));
        $this->cancel();
        Toastr::success('Cập nhập giáo hạt thành công','Success');
        return redirect()->route('giao-hat.index');
    }

    public function delete(){
        $giao_hat = GiaoHat::find($this->giao_hat_id );
        if ($giao_hat){
            $giao_hat->delete();
            Toastr::success('Xóa giáo hạt thành công','Success');
            return redirect()->route('giao-hat.index');
        }else{
            Toastr::error('Không tìm thấy giáo hạt','Error');
            return redirect()->route('giao-hat.index');
        }
    }
  
}
