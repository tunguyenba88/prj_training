<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeProfileRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'birth_day1' => 'required|before:today',
            'phone1' => 'min:10|max:10|regex:/(^([0-9]+)(\d+)?$)/u',
        ];
    }
    public function messages()
    {
        return [
            'birth_day.required' => 'Vui lòng chọn ngày sinh',
            'phone.min' => 'Số điện thoại có độ dài 10 chữ số',
            'phone.max' => 'Số điện thoại có độ dài 10 chữ số',
            'phone.regex' => 'Số điện thoại có độ dài 10 chữ số',
            'birth_day.before' => 'Ngày sinh phải nhỏ hơn ngày hiện tại',
        ];
    }
}
