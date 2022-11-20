<?php

namespace App\Http\Services;

use App\Models\Room;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;

class RoomService
{
    public function destroy($request)
    {
        $id = (int) $request->input('id');
        $room = Room::where('id', $id)->first();
        $user = User::where('room_id', $id)->first();

        if ($room && !$user) {
            return Room::where('id', $id)->delete();
        }

        return false;
    }

    public function edit($request, $room)
    {
        $room->room_name = (string)$request->input('name');
        $room->description = (string)$request->input('description');
        $room->manager_id = (int)$request->input('manager');
        $room->save();

        return true;
    }
}
