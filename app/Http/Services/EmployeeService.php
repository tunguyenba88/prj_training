<?php

namespace App\Http\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;

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
        $user->status = (int)$request->input('status');
        $user->phone = (string)$request->input('phone');
        $user->save();

        if ($request->has('image')) {
            $request->validate([
                'image' => 'image|mimes:png,jpg,jpeg|max:5120'
            ]);

            $user_id = $user->id;

            $imageName = time() . '-' . $user_id . '.' . $request->image->extension();

            $request->image->move(public_path('images'), $imageName);

            DB::table('users')
                ->where('id', $user_id)
                ->update(['image' => '/images/' . $imageName]);
        }
        return true;
    }

    public function getUserRoom($room_id)
    {
        return User::sortable()->where('room_id', $room_id);
    }
}
