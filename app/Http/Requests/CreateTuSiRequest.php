<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTuSiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ho_va_ten' => 'required|max:100',
            'ten_thanh_id' => 'required',
            'nha_dong_id' => 'nullable',
            'chuc_vu_id' => 'required',
            'la_tong_giam_muc' => 'max:1',
            'email' => 'email',
            'giao_tinh_id' => 'nullable',
            'gioi_tinh' => 'required',
            'giao_phan_id' =>'required',
            'ngay_nhan_chuc' => 'date|nullable',
            'ngay_sinh' => 'required|date|nullable',
            'ngay_mat' => 'date|nullable|after:ngay_sinh',
            'so_dien_thoai' =>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'dia_chi_hien_tai' => 'max:250|nullable',
            'noi_nhan_chuc' => 'max:250|nullable',
            'dang_du_hoc' => 'nullable',

        ];
    }

    public function messages()
    {
        return [
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
    }

    public function attributes()
    {
        return [
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
    }
}
