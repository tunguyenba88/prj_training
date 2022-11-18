<?php

namespace App\Http\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmployeeService
{
    public function destroy($request)
    {
        $id = (int) $request->input('id');
        $user = User::where('id', $id)->first();

        if ($user) {
            return User::where('id', $id)->delete();
        }

        return false;
    }

    public function edit($request, $user)
    {
        $user->name = (string)$request->input('name');
        $user->room_id = (int)$request->input('room');
        $user->auth = (int)$request->input('auth');
        $user->birth_day = (string)$request->input('birth_day');
        $user->start_at = (string)$request->input('start_at');
        $user->image = (string)$request->input('image');
        $user->status = (int)$request->input('status');
        $user->phone = (string)$request->input('phone');
        $user->save();

        return true;
    }
}