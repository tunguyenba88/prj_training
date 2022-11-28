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
            'name.required' => __('messages.name_required'),
            'name.min' => __('messages.name_min'),
            'name.max' => __('messages.name_max'),
            'room.required' => __('messages.room_required'),
            'birth_day.required' => __('messages.birth_day_required'),
            'start_at.required' => __('messages.start_at_required'),
            'phone.min' => __('messages.phone_min'),
            'phone.max' => __('messages.phone_max'),
            'phone.regex' => __('messages.phone_regex'),
            'birth_day.before' => __('messages.birth_day_before'),
            'start_at.before' => __('messages.start_at_before'),
        ];
    }
}
