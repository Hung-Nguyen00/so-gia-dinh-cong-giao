<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBiTichRequest extends FormRequest
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
            'ngay_dien_ra' => 'required|date',
            'noi_dien_ra' => 'required|max:250',
            'ten_nguoi_do_dau' => 'required',
            'ten_thanh_nguoi_do_dau',
            'ngay_sinh_nguoi_do_dau',
            'ten_nguoi_lam_chung_1',
            'ten_thanh_nguoi_lam_chung_1',
            'ngay_sinh_nguoi_lam_chung_1',
            'ten_nguoi_lam_chung_2',
            'ten_thanh_nguoi_lam_chung_2',
            'ngay_sinh_nguoi_lam_chung_2',
            'nguoi_khoi_tao',
            'tu_si_id',
        ];
    }
}
