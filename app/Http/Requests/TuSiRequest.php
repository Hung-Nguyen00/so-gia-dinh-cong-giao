<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TuSiRequest extends FormRequest
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
            'chuc_vu_id' => 'required',
            'giao_phan_id' =>'required',
            'ngay_nhan_chuc' => 'date|nullable',
            'ngay_sinh' => 'date|nullable',
            'ngay_mat' => 'date|nullable',
            'so_dien_thoai' =>'max:11|numeric',
            'dia_chi_hien_tai' => 'max:250|nullable',
            'noi_nhan_chuc' => 'max:250|nullable',
            'bat_dau_phuc_vu' => 'date|nullable',
            'ket_thuc_phuc_vu' => 'date|nullable',
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
            'ngay_nhan_chuc.date' => ':attribute phải là giá trị ngày tháng năm',
            'bat_dau_phuc_vu.date' => ':attribute phải là giá trị ngày tháng năm',
            'ngay_mat.date' => ':attribute phải là giá trị ngày tháng năm',
            'ngay_sinh.date' => ':attribute phải là giá trị ngày tháng năm',
            'ket_thuc_phuc_vu.date' => ':attribute phải là giá trị ngày tháng năm',
            'so_dien_thoai.max' => ':attribute không được vượt quá :max',
            'so_dien_thoai.numeric' => ':attribute phải là chữ số'
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
