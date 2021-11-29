<?php

namespace App\Http\Livewire\NhaDong;

use App\Models\NhaDong;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CrudNhaDong extends Component
{
    public $ten_nha_dong,
        $ngay_thanh_lap,
        $dia_chi,
        $nam_thanh_lap,
        $nha_dong_id,
        $all_nha_dong;

    protected $rules = [
        'ten_nha_dong' => 'required|max:50',
        'dia_chi' => 'required|max:100',
        'nam_thanh_lap' => 'digits:4',
        'ngay_thanh_lap' => 'nullable'
    ];

    protected $messages = [
        'ten_nha_dong.required' => ':attribute không được phép trống',
        'ten_nha_dong.max' => ':attribute không được vượt quá :max kí tự',
        'dia_chi.required' => ':attribute không được phép trống',
        'dia_chi.max' => ':attribute không vượt quá :max ký tự',
        'nam_thanh_lap.digits' => ':attribute chỉ được phép 4 chữ số',
        'ngay_thanh_lap.date' => ':attribute phải đúng dạng ngày tháng năm'
    ];

    protected $validationAttributes = [
        'ten_nha_dong' => 'Tên giáo xứ',
        'dia_chi' => 'Địa chỉ',
        'giao_hat_id' => 'Tên giáo hạt',
        'nam_thanh_lap' => 'Giá trị năm',
        'ngay_thanh_lap' => 'Ngày thành lập'
    ];

    public function mount($all_nha_dong){

        $this->all_nha_dong = $all_nha_dong;
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
        return view('livewire.nha-dong.crud-nha-dong');
    }
    public function clearData(){
        $this->ten_nha_dong = '';
        $this->ngay_thanh_lap = '';
        $this->dia_chi = '';
        $this->nam_thanh_lap = '';
        $this->nha_dong_id = '';
    }
    public function store()
    {
        $validatedData = $this->validate();
        $validatedData['ngay_thanh_lap'] = Carbon::parse($validatedData['ngay_thanh_lap'])->format('Y-m-d');
        NhaDong::create(array_merge($validatedData, ['nguoi_khoi_tao' => Auth::id()]));
        Toastr::success('Tạo mới thành công','Thành công');
        return redirect()->route('nha-dong.index');
    }

    public function cancel(){
        $this->nha_dong_id = '';
        $this->ten_nha_dong = '';
        $this->dia_chi = '';
        $this->nam_thanh_lap = '';
        $this->ngay_thanh_lap= '';
    }

    public function edit($id){
        $this->cancel();
        $nha_dong = NhaDong::find($id);
        if ($nha_dong){
            $this->nha_dong_id = $nha_dong->id;
            $this->ten_nha_dong = $nha_dong->ten_nha_dong;
            if (\Carbon\Carbon::parse($nha_dong->ngay_thanh_lap)->format('d-m') == '01-01' && strtotime($nha_dong->ngay_thanh_lap) < strtotime(2000)){
                $this->nam_thanh_lap = \Carbon\Carbon::parse($nha_dong->ngay_thanh_lap)->format('Y') ;
            }else{
                $this->ngay_thanh_lap = $nha_dong->ngay_thanh_lap;
            }
            $this->dia_chi = $nha_dong->dia_chi;
        }
    }


    public function update(){
        $validatedData = $this->validate();
        $validatedData['ngay_thanh_lap'] = Carbon::parse($validatedData['ngay_thanh_lap'])->format('Y-m-d');
        NhaDong::find($this->nha_dong_id)
            ->update(array_merge($validatedData, ['nguoi_khoi_tao' => Auth::id()]));
        $this->cancel();
        Toastr::success('Cập nhập thành công','Thành công');
        return redirect()->route('nha-dong.index');
    }

    public function delete(){
        $nha_dong = NhaDong::find($this->nha_dong_id );
        if ($nha_dong){
            $nha_dong->delete();
            Toastr::success('Xóa thành công','Thành công');
            return redirect()->route('nha-dong.index');
        }else{
            Toastr::error('Không tìm thấy','Lỗi');
            return redirect()->route('nha-dong.index');
        }
    }
    
   
}
