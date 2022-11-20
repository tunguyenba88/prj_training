<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFormRequest;
use App\Http\Services\EmployeeService;
use App\Models\Room;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function store(Request $request)
    {
        $rooms = Room::select('rooms.room_name', 'rooms.id')->get();

        $users = User::sortable()->paginate(5);
        return view('list', compact('users'))->with('rooms', $rooms);
    }

    public function sort()
    {
        $users = User::sortable()->paginate(5);
        return view('list')->with('users', $users);
    }

    public function search(Request $request)
    {
        $rooms = Room::select('rooms.room_name', 'rooms.id')->get();
        $filter = $request->query('form1');
        if (!empty($filter)) {
            $users = User::sortable()->where('name', 'LIKE', '%' . $filter . '%')->paginate(5);
        } else {
            $users = User::sortable()->paginate(5);
        }
        return view('list')->with('users', $users)->with('param', $filter)->with('rooms', $rooms);
    }

    public function filter(Request $request)
    {
        $rooms = Room::select('rooms.room_name', 'rooms.id')->get();

        $status = intval($request->status);
        $room = intval($request->room);
        if ($status && $room) {
            $users = User::sortable()->where('room_id', $room)->where('status', $status)->paginate(5);
        }
        if (!$room && !$status) {
            $users = User::sortable()->paginate(5);
        }
        if ($room && !$status) {
            $users = User::sortable()->where('room_id', $room)->paginate(5);
        }
        if (!$room && $status) {
            $users = User::sortable()->where('status', $status)->paginate(5);
        }
        return view('list', compact('users'))->with('rooms', $rooms);
    }

    public function destroy(Request $request)
    {
        $result = $this->employeeService->destroy($request);

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

    public function viewAdd()
    {
        $rooms = Room::select('rooms.room_name', 'rooms.id')->get();

        return view('add')->with('rooms', $rooms);
    }

    public function add(CreateFormRequest $request)
    {
        $checkEmail = User::where('email', (string)$request->input('email'))->first();
        if (!$checkEmail) {
            try {
                $user = new User();
                $user->name = (string)$request->input('name');
                $user->email = (string)$request->input('email');
                $user->room_id = (int)$request->input('room');
                $user->auth = (int)$request->input('auth');
                $user->birth_day = (string)$request->input('birth_day');
                $user->start_at = (string)$request->input('start_at');
                $user->status = (int)$request->input('status');
                $user->phone = (string)$request->input('phone');
                $user->password = 123456;
                if ($request->has('image')) {
                    $request->validate([
                        'image' => 'image|mimes:png,jpg,jpeg|max:5120'
                    ]);

                    $imageName = time() . '-' . $request->image->extension();

                    $request->image->move(public_path('images'), $imageName);

                    $user->image = '/images/' . $imageName;
                } else {
                    $user->image = '/images/default.jpeg';
                }
                $user->save();
                return redirect('list')->with('success', "Insert successfully");
            } catch (Exception $e) {
                return redirect('list/add')->with('error', "operation failed");
            }
        } else {
            return redirect('list/add')->with('error', "Email đã tồn tại");
        }
    }

    public function viewProfile(User $user)
    {
        return view('profile')->with('user', $user);
    }

    public function viewEdit(User $user)
    {
        return view('edit')->with('user', $user);
    }
    public function edit(User $user, CreateFormRequest $request)
    {
        $this->employeeService->edit($request, $user);

        return redirect('list');
    }
}
