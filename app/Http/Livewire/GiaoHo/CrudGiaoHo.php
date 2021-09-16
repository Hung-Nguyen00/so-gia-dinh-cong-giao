<?php

namespace App\Http\Livewire\GiaoHo;

use App\Models\GiaoXu;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CrudGiaoHo extends Component
{
    public  $giao_xu,
        $ten_giao_xu,
        $ngay_thanh_lap,
        $dia_chi,
        $nam_thanh_lap,
        $giao_hat_id,
        $giao_xu_id,
        $change_to_giao_xu,
        $all_giao_ho,
        $giao_ho_id;

    protected $rules = [
        'ten_giao_xu' => 'required:max:100',
        'dia_chi' => 'required|max:250',
        'nam_thanh_lap' => 'max:2500',
        'ngay_thanh_lap' => 'date|nullable',
    ];

    protected $messages = [
        'ten_giao_xu.required' => ':attribute không được phép trống',
        'ten_giao_xu.max' => ':attribute không được vượt quá 100 kí tự',
        'dia_chi.required' => ':attribute không được phép trống',
        'dia_chi.max' => ':attribute không vượt quá :max ký tự',
        'nam_thanh_lap.max' => ':attribute không được phép lớn hơn :max',
        'ngay_thanh_lap.date' => ':attribute phải đúng dạng ngày tháng năm'
    ];

    protected $validationAttributes = [
        'ten_giao_xu' => 'Tên giáo họ',
        'dia_chi' => 'Địa chỉ',
        'nam_thanh_lap' => 'Giá trị năm',
        'ngay_thanh_lap' => 'Ngày thành lập'
    ];

    public function mount($all_giao_ho){

        $this->all_giao_ho = $all_giao_ho;
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
        return view('livewire.giao-ho.crud-giao-ho');
    }

    public function clearData(){
        $this->ten_giao_xu = '';
        $this->ngay_thanh_lap = '';
        $this->dia_chi = '';
        $this->nam_thanh_lap = '';
        $this->giao_hat_id = '';
        $this->giao_xu_id = '';
        $this->change_to_giao_xu = '';
    }
    public function store()
    {
        $validatedData = $this->validate();
        // take giao_hat_id to GiaoHo which is GiaoXu table)
        $giao_xu = GiaoXu::find(Auth::user()->giao_xu_id);
        $validatedData['ngay_thanh_lap'] = Carbon::parse($validatedData['ngay_thanh_lap'])->format('Y-m-d');
        // create new item
        GiaoXu::create(array_merge($validatedData, [
            'nguoi_khoi_tao' => Auth::id(),
            'giao_hat_id' => $giao_xu->giao_hat_id,
            'giao_xu_hoac_giao_ho' => $giao_xu->id
        ]));

        Toastr::success('Tạo giáo họ mới thành công','Thành công');
        return redirect()->route('giao-ho.index');
    }

    public function cancel(){
        $this->giao_ho_id = '';
        $this->ten_giao_xu = '';
        $this->dia_chi = '';
        $this->nam_thanh_lap = '';
        $this->ngay_thanh_lap= '';
    }

    // set value when click edit a item
    public function edit($id){
        $this->cancel();
        $giao_ho = GiaoXu::find($id);
        if ($giao_ho){
            $this->giao_ho_id = $giao_ho->id;
            $this->ten_giao_xu = $giao_ho->ten_giao_xu;
            $this->giao_hat_id = $giao_ho->giao_hat_id;
            $this->dia_chi = $giao_ho->dia_chi;
            //  set nam_thanh_lap = field ngay_thanh_lap if it's only year and  vice versa
            if (\Carbon\Carbon::parse($giao_ho->ngay_thanh_lap)->format('d-m') == '01-01'){
                $this->nam_thanh_lap = \Carbon\Carbon::parse($giao_ho->ngay_thanh_lap)->format('Y') ;
            }else{
                $this->ngay_thanh_lap = $giao_ho->ngay_thanh_lap;
            }
        }
    }


    public function update(){
        $validatedData = $this->validate();
        // find giao_hat_id to set giao_hat_id of Giao Ho
        $giao_xu_parent = GiaoXu::find(Auth::user()->giao_xu_id);
        $validatedData['ngay_thanh_lap'] = Carbon::parse($validatedData['ngay_thanh_lap'])->format('Y-m-d');
        // up growth to GiaoXu form GiaoHo
        GiaoXu::find($this->giao_ho_id)->update(array_merge($validatedData, [
                'nguoi_khoi_tao' => Auth::id(),
                'giao_xu_hoac_giao_ho' => $giao_xu_parent->id,
                'giao_hat_id' => $giao_xu_parent->giao_hat_id,
            ]));
        // reset field
        $this->cancel();
        // notify to interface
        Toastr::success('Cập nhập giáo họ thành công','Thành công');
        return redirect()->route('giao-ho.index');
    }

    public function delete(){
        $giao_xu = GiaoXu::find($this->giao_ho_id);
        if ($giao_xu){
            $giao_xu->delete();
            Toastr::success('Xóa giáo họ thành công','Thành công');
            return redirect()->route('giao-ho.index');
        }else{
            Toastr::error('Không tìm thấy giáo họ','Lỗi');
            return redirect()->route('giao-ho.index');
        }
    }

}
