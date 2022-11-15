<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'current_password' => 'required',
            'new_password' => 'required|min:6|max:30|regex:/(^([a-z0-9\*\"\$\%\&\'\(\)\*\+\,\-\.\/\:\;\<\=\>\?\@\[\]\^\_\`\{\}\~]+)(\d+)?$)/u',
            'confirm_password' => 'required|same:new_password',
        ];
    }
    public function messages()
    {
        return [
            'current_password.required' => 'Vui lòng điền lại mật khẩu cũ',
            'new_password.required' => 'Vui lòng điền lại mật khẩu mới',
            'confirm_password.required' => 'Vui lòng điền lại mật khẩu',
            'new_password.min' => 'Mật khẩu có độ dài từ 6 đến 30 ký tự',
            'new_password.max' => 'Mật khẩu có độ dài từ 6 đến 30 ký tự',
            'confirm_password.same' => 'Xác nhận lại mật khẩu',
            'new_password.regex' => 'Mật khẩu bao gồm chữ cái, số, ký tự đặc biệt',
        ];
    }
}
