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
            'department_name.required' => __('messages.department_name_required'),
            'department_name.min' => __('messages.department_name_min'),
            'department_name.max' => __('messages.department_name_min'),
            'description.max' => __('messages.description_max'),
        ];
    }
}
