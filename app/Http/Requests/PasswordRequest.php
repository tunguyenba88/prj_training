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
            'current_password.required' => __('messages.current_password_required'),
            'new_password.required' => __('messages.new_password_required'),
            'confirm_password.required' => __('messages.confirm_password_required'),
            'new_password.min' => __('messages.new_password_min'),
            'new_password.max' => __('messages.new_password_max'),
            'confirm_password.same' => __('messages.confirm_password_same'),
            'new_password.regex' => __('messages.new_password_regex'),
        ];
    }
}
