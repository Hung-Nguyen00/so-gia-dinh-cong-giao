<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateThanhVienRequest extends FormRequest
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
            'ngay_sinh' => 'date|nullable',
            'gioi_tinh' => 'required',
            'noi_sinh' => 'required|max:50',
            'chuc_vu_gd' => 'required',
            'ngay_mat' => 'date|nullable',
            'nam_sinh' => 'numeric|nullable',
            'dia_chi_hien_tai' => 'max:250',
            'so_dien_thoai' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ];
    }

    public function messages()
    {
        return [
            'ho_va_ten.required' => ':attribute không được phép trống',
            'ngay_sinh.date' => ':attribute phải là giá trị ngày tháng năm',
            'ngay_mat.date' => ':attribute phải là giá trị ngày tháng năm',
            'nam_sinh.numeric' => ':attribute phải là giá trị số',
            'so_dien_thoai.min' =>':attribute nhỏ hơn :min',
            'noi_sinh.required' => 'Nơi sinh không được phép trống',
            'gioi_tinh.required' => 'Giới tính không được phép trống',
            'so_dien_thoai.regex' =>':attribute phải là giá trị số',
            'dia_chi_hien_tai.max' => ':attribute không vượt quá :max ký tự',
            'chuc_vu_gd.required' => 'Chức vụ trong gia đình không được trống',
            'noi_sinh.max' => 'Nơi sinh không được phép vượt quá :max ký tự'
        ];
    }

    public function attributes()
    {
        return[
            'ho_va_ten' => 'Họ và tên',
            'ngay_sinh' => 'Ngày sinh',
            'ngay_mat' => 'Ngày mất',
            'nam_sinh' => 'Năm sinh',
            'so_dien_thoai' => 'Số điện thoại',
            'dia_chi_hien_tai' => 'Địa chỉ'
        ];
    }
}
