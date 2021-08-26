<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTuDongRequest extends FormRequest
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
            'ten_dong' => 'required|max:100|nullable',
            'chuc_vu_id' => 'required',
            'email' => 'email|nullable',
            'ngay_sinh' => 'required|date',
            'so_dien_thoai' =>'digits:10|numeric|nullable',
            'dia_chi_hien_tai' => 'max:250|nullable',
            'vi_tri_id' => 'nullable'
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
            'ngay_sinh.date' => ':attribute phải là giá trị ngày tháng năm',
            'ngay_sinh.required' => ':attribute không được phép trống',
            'so_dien_thoai.digits' => ':attribute chỉ có 10 chữ số',
            'so_dien_thoai.numeric' => ':attribute phải là chữ số',
            'email.email' => 'Giá trị nhập phải đúng dạng email',
            'ten_dong.max' => 'Tên dòng không được vượt quá 100 ký tự'
        ];
    }

    public function attributes()
    {
        return [
            'ho_va_ten'  => 'Họ và tên',
            'ten_thanh_id'   => 'Tên thánh',
            'chuc_vu_id'      => 'Chức vụ',
            'dia_chi_hien_tai' => 'Địa chỉ hiện tại',
            'ngay_sinh' => 'Ngày tháng năm sinh',
            'so_dien_thoai' => 'Số điện thoại',
        ];
    }
}
