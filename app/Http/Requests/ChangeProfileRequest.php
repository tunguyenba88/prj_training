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
            'birth_day.required' => __('messages.birth_day_required'),
            'phone.min' => __('messages.phone_min'),
            'phone.max' => __('messages.phone_max'),
            'phone.regex' => __('messages.phone_regex'),
            'birth_day.before' => __('messages.birth_day_before'),
        ];
    }
}
