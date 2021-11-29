<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendingEmailRequest extends FormRequest
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
            'title' => 'required|max:255',
            'content' => 'required|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => ':attribute không được phép trống',
            'title.max' => ':attribute không được vượt quá :max kí tự',
            'content.required' => ':attribute không được phép trống',
            'content.max' => ':attribute không được vượt quá :max kí tự',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Chủ đề',
            'content' => 'Nội dung'
        ];
    }
}
