<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFormRequest extends FormRequest
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
            'name' => 'required|min:6|max:30',
            'room' => 'required',
            'birth_day' => 'required|before:today',
            'start_at' => 'required|before:today',
            'status' => 'required',
            'auth' => 'required',
            'phone' => 'min:10|max:10|regex:/(^([0-9]+)(\d+)?$)/u',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng điền tên',
            'name.min' => 'Tên có độ dài từ 6~30 ký tự',
            'name.max' => 'Tên có độ dài từ 6~30 ký tự',
            'room.required' => 'Vui lòng chọn phòng',
            'birth_day.required' => 'Vui lòng chọn ngày sinh',
            'start_at.required' => 'Vui lòng chọn ngày bắt đầu làm việc',
            'phone.min' => 'Số điện thoại có độ dài 10 chữ số',
            'phone.max' => 'Số điện thoại có độ dài 10 chữ số',
            'phone.regex' => 'Số điện thoại có độ dài 10 chữ số',
            'birth_day.before' => 'Ngày sinh phải nhỏ hơn ngày hiện tại',
            'start_at.before' => 'Ngày làm việc phải nhỏ hơn ngày hiện tại',
        ];
    }
}
