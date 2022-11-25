<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class UsersImport implements ToModel, WithValidation, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;

    public function onFailure(Failure ...$failures)
    {
        $exception = ValidationException::withMessages(collect($failures)->map->toArray()->all());
        throw $exception;
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new User([
            'name' => $row[0],
            'email' => $row[1],
            'birth_day' => $row[2],
            'start_at' => $row[3],
            'status' => $row[4],
            'image' => $row[5],
            'phone' => $row[6],
            'auth' => $row[7],
            'department_id' => $row[8],
            'password' => bcrypt(123456),
        ]);
    }

    public function rules(): array
    {
        return [
            '0' => ['required', 'min:6', 'max:30'],
            '1' => ['required', 'email'],
            '2' => ['required', 'before:today'],
            '3' => ['required', 'before:today'],
            '4' => ['required'],
            '6' => ['min:10', 'max:10', 'regex:/(^([0-9]+)(\d+)?$)/u'],
            '7' => ['required'],
            '8' => ['required'],
        ];
    }

    /**
     * @return array
     */
    public function customValidationAttributes()
    {
        return [
            '0.required' => 'Thiếu tên',
            '1.required' => 'Thiếu email',
            '2.before' => 'Ngày sinh phải nhỏ hơn ngày hiện tại',
            '2.required' => 'Thiếu ngày sinh',
            '3.before' => 'Ngày làm việc phải nhỏ hơn ngày hiện tại',
            '3.required' => 'Thiếu ngày bắt đầu làm việc',
            '4.required' => 'Thiếu trạng thái',
            '6.min' => 'Số điện thoại có độ dài 10 chữ số',
            '6.max' => 'Số điện thoại có độ dài 10 chữ số',
            '6.regex' => 'Số điện thoại có độ dài 10 chữ số',
            '8.required' => 'Thiếu phòng',
        ];
    }
}
