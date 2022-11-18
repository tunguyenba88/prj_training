<?php

namespace App\Http\Controllers;

use App\Http\Services\EmployeeService;
use App\Models\User;
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
        $room = 0;
        if ($request->select) {
            $select = intval($request->select);
            if ($select == 1) {
                $users = User::sortable()->active()->paginate(5);
            } else {
                $users = User::sortable()->deActive()->paginate(5);
            }
            return view('list', compact('users'))->with('select', $select)->with('room', $room);
        }
        $select = 0;
        $users = User::sortable()->paginate(5);
        return view('list', compact('users'))->with('select', $select)->with('room', $room);
    }

    public function sort()
    {
        $users = User::sortable()->paginate(5);
        return view('list')->with('users', $users);
    }

    public function search(Request $request)
    {
        $filter = $request->query('form1');
        if (!empty($filter)) {
            $users = User::sortable()->where('name', 'LIKE', '%' . $filter . '%')->paginate(5);
        } else {
            $users = User::sortable()->paginate(5);
        }
        return view('list')->with('users', $users)->with('users', $users)->with('param', $filter);
    }

    public function filterRoom(Request $request)
    {
        $select = 0;
        if ($request->room) {
            $room = intval($request->room);
            $users = User::sortable()->where('room_id', $room)->paginate(5);
            return view('list', compact('users'))->with('room', $room)->with('select', $select);
        }
        $room = 0;
        $users = User::sortable()->paginate(5);
        return view('list', compact('users'))->with('room', $room)->with('select', $select);
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
    public function viewEdit(User $user)
    {
        return view('edit')->with('user', $user);
    }
    public function edit(User $user, Request $request)
    {
        $this->employeeService->edit($request, $user);

        return redirect('list');
    }
}
