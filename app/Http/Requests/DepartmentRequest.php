<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
            'department_name' => 'required|min:3|max:50',
            'description' => 'max:255',
        ];
    }
    public function messages()
    {
        return [
            'department_name.required' => 'Vui lòng điền tên phòng',
            'department_name.min' => 'Tên bộ phận có độ dài 3~50 ký tự',
            'department_name.max' => 'Tên bộ phận có độ dài 3~50 ký tự',
            'description.max' => 'Mô tả có độ dài < 255 ký tự',
        ];
    }
}