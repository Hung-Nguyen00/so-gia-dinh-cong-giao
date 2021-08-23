<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateThanhVienRequest extends FormRequest
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
            'ngay_mat' => 'date|nullable',
            'nam_sinh' => 'numeric|nullable',
            'dia_chi' => 'max:250',
            'so_dien_thoai' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ];
    }

    public function messages()
    {
        return [
            'ho_va_ten.required' => ':attribute không được phép trống',
            'ten_thanh_id.required' =>':attribute không được phép trống',
            'ngay_sinh.date' => ':attribute phải là giá trị ngày tháng năm',
            'ngay_mat.date' => ':attribute phải là giá trị ngày tháng năm',
            'nam_sinh.numeric' => ':attribute phải là giá trị số',
            'so_dien_thoai.min' =>':attribute nhỏ hơn :min',
            'so_dien_thoai.regex' =>':attribute phải là giá trị số',
            'dia_chi.max' => ':attribute không vượt quá :max ký tự',
        ];
    }

    public function attributes()
    {
        return[
          'ho_va_ten' => 'Họ và tên',
          'ten_thanh_id' => 'Tên thánh',
          'ngay_sinh' => 'Ngày sinh',
          'ngay_mat' => 'Ngày mất',
          'nam_sinh' => 'Năm sinh',
          'so_dien_thoai' => 'Số điện thoại',
           'dia_chi' => 'Địa chỉ'
        ];
    }
}
