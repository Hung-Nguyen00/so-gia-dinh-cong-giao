<?php

namespace App\Http\Livewire\GiaoXu;

use App\Models\GiaoHat;
use App\Models\GiaoTinh;
use App\Models\GiaoXu;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CrudGiaoXu extends Component
{
    public  $giao_hat,
        $ten_giao_xu,
        $ngay_thanh_lap,
        $dia_chi,
        $nam_thanh_lap,
        $giao_hat_id,
        $giao_xu_id,
        $all_giao_xu;

    protected $rules = [
        'ten_giao_xu' => 'required:max:100',
        'dia_chi' => 'required|max:250',
        'nam_thanh_lap' => 'max:2500',
        'giao_hat_id' => 'required',
        'ngay_thanh_lap' => 'date|nullable'
    ];

    protected $messages = [
        'ten_giao_xu.required' => ':attribute không được phép trống',
        'ten_giao_xu.max' => ':attribute không được vượt quá 100 kí tự',
        'dia_chi.required' => ':attribute không được phép trống',
        'dia_chi.max' => ':attribute không vượt quá :max ký tự',
        'giao_hat_id.required' => ':attribute không được phép trống',
        'nam_thanh_lap.max' => ':attribute không được phép lớn hơn :max',
        'ngay_thanh_lap.date' => ':attribute phải đúng dạng ngày tháng năm'
    ];

    protected $validationAttributes = [
        'ten_giao_xu' => 'Tên giáo xứ',
        'dia_chi' => 'Địa chỉ',
        'giao_hat_id' => 'Tên giáo hạt',
        'nam_thanh_lap' => 'Giá trị năm',
        'ngay_thanh_lap' => 'Ngày thành lập'
    ];

    public function mount($all_giao_xu){

        $this->all_giao_xu = $all_giao_xu;
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
        $this->giao_hat = GiaoHat::all();
        return view('livewire.giao-xu.crud-giao-xu');
    }
 
    public function store()
    {
        $validatedData = $this->validate();
        $validatedData['ngay_thanh_lap'] = Carbon::parse($validatedData['ngay_thanh_lap'])->format('Y-m-d');
        GiaoXu::create(array_merge($validatedData, ['nguoi_khoi_tao' => Auth::id()]));
        Toastr::success('Tạo giáo xứ mới thành công','Thành công');
        return redirect()->route('giao-xu.index');
    }

    public function cancel(){
        $this->giao_xu_id = '';
        $this->ten_giao_xu = '';
        $this->giao_hat_id = '';
        $this->dia_chi = '';
        $this->nam_thanh_lap = '';
        $this->ngay_thanh_lap= '';
    }

    public function edit($id){
        $this->cancel();
        $giao_xu = GiaoXu::find($id);
        if ($giao_xu){
            $this->giao_xu_id = $giao_xu->id;
            $this->ten_giao_xu = $giao_xu->ten_giao_xu;

            if (\Carbon\Carbon::parse($giao_xu->ngay_thanh_lap)->format('d-m') == '01-01'){
                $this->nam_thanh_lap = \Carbon\Carbon::parse($giao_xu->ngay_thanh_lap)->format('Y') ;
            }else{
                $this->ngay_thanh_lap = $giao_xu->ngay_thanh_lap;
            }
            $this->giao_hat_id = $giao_xu->giao_hat_id;
            $this->dia_chi = $giao_xu->dia_chi;
        }
    }


    public function update(){
        $validatedData = $this->validate();
        $validatedData['ngay_thanh_lap'] = Carbon::parse($validatedData['ngay_thanh_lap'])->format('Y-m-d');
        GiaoXu::find($this->giao_xu_id)
            ->update(array_merge($validatedData, ['nguoi_khoi_tao' => Auth::id()]));
        $this->cancel();
        Toastr::success('Cập nhập giáo xứ thành công','Thành công');
        return redirect()->route('giao-xu.index');
    }

    public function delete(){
        $giao_xu = GiaoXu::find($this->giao_xu_id );
        if ($giao_xu){
            $giao_xu->delete();
            Toastr::success('Xóa giáo xứ thành công','Thành công');
            return redirect()->route('giao-xu.index');
        }else{
            Toastr::error('Không tìm thấy giáo xứ','Lỗi');
            return redirect()->route('giao-xu.index');
        }
    }
  
}
