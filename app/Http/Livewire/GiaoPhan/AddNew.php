<?php

namespace App\Http\Livewire\GiaoPhan;

use App\Models\GiaoPhan;
use App\Models\GiaoTinh;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
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
        $ten_nha_tho,
        $nam_thanh_lap;

    protected $rules = [
        'ten_giao_phan' => 'required:max:100',
        'dia_chi' => 'required|max:250',
        'ngay_thanh_lap' => 'nullable|date',
        'nam_thanh_lap' => 'max:2500',
        'giao_tinh_id' => 'required',
        'ten_nha_tho' => 'required|max:100'
    ];

    protected $messages = [
        'ten_giao_phan.required' => ':attribute không được phép trống',
        'ten_giao_phan.max' => ':attribute không được vượt quá 100 kí tự',
        'dia_chi.required' => ':attribute không được phép trống',
        'ngay_thanh_lap.date'=> ':attribute buộc phải là giá trị ngày tháng năm',
        'giao_tinh_id.required' => ':attribute không được phép trống',
        'ten_nha_tho.required' => ':attribute không được phép trống',
        'ten_nha_tho.max' => ':attribute không được vượt quá 100 kí tự',
        'nam_thanh_lap.max' => ':attribute không được vượt quá :max'

    ];

    protected $validationAttributes = [
        'ten_giao_phan' => 'Tên giáo phận',
        'dia_chi' => 'Địa chỉ',
        'ngay_thanh_lap' => 'Ngày thành lập',
        'ten_giao_tinh' => 'Tên giáo tỉnh',
        'ten_nha_tho'   => 'Tên nhà thờ',
        'nam_thanh_lap' => 'Năm thành lập'
    ];

    public function mount($all_giao_phan){
        $this->all_giao_phan = $all_giao_phan;
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
        $this->dispatchBrowserEvent('contentChanged');
        $this->giao_tinh = GiaoTinh::all();
        return view('livewire.giao-phan.add-new');
    }

    public function clearData(){
        $this->ten_giao_phan = '';
        $this->dia_chi  = '';
        $this->giao_tinh_id = '';
        $this->ngay_thanh_lap = '';
        $this->ten_nha_tho = '';
        $this->nam_thanh_lap = '';
    }
    public function store()
    {
        $validatedData = $this->validate();
        $validatedData['ngay_thanh_lap'] = Carbon::parse($validatedData['ngay_thanh_lap'])->format('Y-m-d');
        GiaoPhan::create(array_merge($validatedData, ['nguoi_khoi_tao' => Auth::id()]));
        Toastr::success('Tạo giáo phận mới thành công','Thành công');
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
            $this->ten_nha_tho = $giao_phan->ten_nha_tho;
            $this->ten_giao_phan = $giao_phan->ten_giao_phan;
            $this->giao_tinh_id = $giao_phan->giao_tinh_id;
            $this->dia_chi = $giao_phan->dia_chi;

            // set ngay_thanh_lap if user input only year and vice verse
            if (\Carbon\Carbon::parse($giao_phan->ngay_thanh_lap)->format('d-m') == '01-01'){
                $this->nam_thanh_lap = \Carbon\Carbon::parse($giao_phan->ngay_thanh_lap)->format('Y') ;
            }else{
                $this->ngay_thanh_lap = $giao_phan->ngay_thanh_lap;
            }
        }
    }

    public function update(){
        $validatedData = $this->validate();
        $validatedData['ngay_thanh_lap'] = Carbon::parse($validatedData['ngay_thanh_lap'])->format('Y-m-d');

        GiaoPhan::find($this->giao_phan_id)
            ->update(array_merge($validatedData, ['nguoi_khoi_tao' => Auth::id()]));
        $this->cancel();
        Toastr::success('Cập nhập giáo phận thành công','Thành công');
        return redirect()->route('giao-phan.index');
    }

    public function delete(){
        $giao_phan = GiaoPhan::find($this->giao_phan_id );
        if ($giao_phan){
            $giao_phan->delete();
            Toastr::success('Xóa giáo phận thành công','Thành công');
            return redirect()->route('giao-phan.index');
        }else{
            Toastr::error('Không tìm thấy giáo phận','Lỗi');
            return redirect()->route('giao-phan.index');
        }
    }
}
