<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
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
            'room_id' => $row[8],
            'password' => bcrypt(123456),
        ]);
    }
}
