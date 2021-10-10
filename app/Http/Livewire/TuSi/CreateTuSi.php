<?php

namespace App\Http\Livewire\TuSi;

use App\Models\ChucVu;
use App\Models\GiaoPhan;
use App\Models\NhaDong;
use App\Models\TenThanh;
use App\Models\TuSi;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateTuSi extends Component
{

    public $tu_si, $giao_hat_id, $giao_xu_id, $ten_thanh_id, $vi_tri_id, $nha_dong_id, $giao_phan_id, $chuc_vu_id;
    public $ho_va_ten,
        $la_tong_giam_muc,
        $giao_tinh_id,
        $ngay_sinh,
        $email,
        $ngay_mat,
        $gioi_tinh,
        $dia_chi_hien_tai,
        $so_dien_thoai,
        $ngay_nhan_chuc,
        $noi_nhan_chuc,
        $dang_du_hoc;

    public function render()
    {
        $this->dispatchBrowserEvent('contentChanged');
        $all_ten_thanh = TenThanh::orderBy('ten_thanh')->get();
        $all_giao_phan = GiaoPhan::with('giaoTinh')->get();
        $all_nha_dong = NhaDong::select('id', 'ten_nha_dong')->get();
        $all_chuc_vu = ChucVu::select('id', 'ten_chuc_vu')->get();
        return view('livewire.tu-si.create-tu-si', compact('all_chuc_vu',
            'all_ten_thanh', 'all_giao_phan', 'all_nha_dong'));
    }


    protected $rules = [
        'ho_va_ten' => 'required|max:45',
        'ten_thanh_id' => 'required',
        'nha_dong_id' => 'nullable',
        'chuc_vu_id' => 'required',
        'la_tong_giam_muc' => 'max:1',
        'email' => 'email|nullable',
        'giao_tinh_id' => 'nullable',
        'gioi_tinh' => 'required',
        'giao_phan_id' =>'required',
        'ngay_nhan_chuc' => 'date|nullable',
        'ngay_sinh' => 'required|date|nullable',
        'ngay_mat' => 'date|nullable|after:ngay_sinh',
        'so_dien_thoai' =>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        'dia_chi_hien_tai' => 'max:100|nullable',
        'noi_nhan_chuc' => 'max:100|nullable',
        'dang_du_hoc' => 'nullable',
    ];

    protected $messages = [
        'ho_va_ten.required' => ':attribute không được phép trống',
        'ten_thanh_id.required' => ':attribute không được phép trống',
        'chuc_vu_id.required' => ':attribute không được phép trống',
        'giao_phan_id.required' => ':attribute không được phép trống',
        'dia_chi_hien_tai.max' => ':attribute không được vượt quá :max',
        'noi_nhan_chuc.max' => ':attribute không được vượt quá :max',
        'noi_nhan_chuc.required' => ':attribute không được phép trống',
        'ngay_nhan_chuc.date' => ':attribute phải là giá trị ngày tháng năm',
        'ngay_nhan_chuc.required' => ':attribute không được phép trống',
        'bat_dau_phuc_vu.date' => ':attribute phải là giá trị ngày tháng năm',
        'ngay_mat.date' => ':attribute phải là giá trị ngày tháng năm',
        'ngay_mat.after' => ':attribute không được nhỏ hơn hoặc bằng ngày sinh',
        'ngay_sinh.date' => ':attribute phải là giá trị ngày tháng năm',
        'ngay_sinh.required' => ':attribute không được phép trống',
        'so_dien_thoai.min' => ':attribute không được nhỏ hơn :min ký tự',
        'so_dien_thoai.regex' => ':attribute phải là chữ số',
        'email.email' => 'Giá trị nhập phải đúng dạng email',
        'la_tong_giam_muc.max' => 'Chức vị không trùng khớp',
        'gioi_tinh.required' => 'Giới tính không được phép trống'
    ];

    protected $validationAttributes = [
        'ho_va_ten'  => 'Họ và tên',
        'ten_thanh_id'   => 'Tên thánh',
        'chuc_vu_id'      => 'Chức vụ',
        'giao_phan_id'   => 'Giáo phận',
        'dia_chi_hien_tai' => 'Địa chỉ hiện tại',
        'noi_nhan_chuc' => 'Nơi nhận chức',
        'ngay_sinh' => 'Ngày tháng năm sinh',
        'ngay_mat' => 'Ngày mất',
        'ngay_nhan_chuc' => 'Ngày nhận chức',
        'bat_dau_phuc_vu'  => 'Ngày bắt đầu phục vụ',
        'ket_thuc_phuc_vu'  => 'Ngày kết thúc phục vụ',
        'so_dien_thoai' => 'Số điện thoại'
    ];

    public function  store(){
        $validateData = $this->validate();
        $this->dang_du_hoc = $this->dang_du_hoc ? 1 : 0;
        $tusi = TuSi::create(array_merge($validateData, ['nguoi_khoi_tao' => Auth::id(), 'dang_du_hoc' => $this->dang_du_hoc]));
        if ($tusi){
            Toastr::success('Thêm mới tu sĩ thành công','Thành công');
            return redirect()->route('tu-si.edit', $tusi);
        }
    }
}
