<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Http\Services\RoomService;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    protected $roomService;

    public function __construct(RoomService $roomService)
    {
        $this->roomService = $roomService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::leftJoin('users', 'rooms.manager_id', '=', 'users.id')->select('rooms.*', 'users.name')->paginate(5);
        return view('room.room')->with('rooms', $rooms);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function viewAdd()
    {
        $users = User::where('auth', 2)->select('users.name', 'users.id')->get();
        return view('room.add')->with('users', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $room = new Room();
        $room->room_name = (string)$request->input('name');
        $room->description = (string)$request->input('description');
        $room->manager_id = (int)$request->input('manager');
        $room->save();
        return redirect('room')->with('success', "Insert successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        $users = User::where('auth', 2)->select('users.name', 'users.id')->get();
        return view('room.edit')->with('room', $room)->with('users', $users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room, RoomRequest $request)
    {
        $this->roomService->edit($request, $room);

        return redirect('room');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $result = $this->roomService->destroy($request);

        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Successfull'
            ]);
        }
        return response()->json([
            'error' => true,
        ]);
    }
}
