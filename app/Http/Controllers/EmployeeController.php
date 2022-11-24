<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFormRequest;
use App\Http\Services\EmployeeService;
use App\Models\Department;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Imports\UsersImport;


class EmployeeController extends Controller
{
    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function store(Request $request)
    {
        $departments = Department::select('departments.department_name', 'departments.id')->get();
        if (Auth::user()->id == 1) {
            $users = User::sortable()->paginate(5);
        } else {
            $users = $this->employeeService->getUserRoom(Auth::user()->department_id)->paginate(5);
        }
        return view('employees.list', compact('users'))->with('departments', $departments);
    }

    public function sort()
    {
        $users = User::sortable()->paginate(5);
        return view('employees.list')->with('users', $users);
    }

    public function search(Request $request)
    {
        $departments = Department::select('departments.department_name', 'departments.id')->get();
        $filter = $request->query('form1');
        if (Auth::user()->id == 1) {
            if (!empty($filter)) {
                $users = User::sortable()->where('name', 'LIKE', '%' . $filter . '%')->paginate(5);
            } else {
                $users = User::sortable()->paginate(5);
            }
        } else {
            if (!empty($filter)) {
                $users = $this->employeeService->getUserRoom(Auth::user()->department_id)->where('name', 'LIKE', '%' . $filter . '%')->paginate(5);
            } else {
                $users = $this->employeeService->getUserRoom(Auth::user()->department_id)->paginate(5);
            }
        }

        return view('employees.list')->with('users', $users)->with('param', $filter)->with('departments', $departments);
    }

    public function filter(Request $request)
    {
        $departments = Department::select('departments.department_name', 'departments.id')->get();

        $status = intval($request->status);
        $department = intval($request->room);
        if (Auth::user()->id == 1) {
            if ($status && $department) {
                $users = User::sortable()->where('department_id', $department)->where('status', $status)->paginate(5);
            }
            if (!$department && !$status) {
                $users = User::sortable()->paginate(5);
            }
            if ($department && !$status) {
                $users = User::sortable()->where('department_id', $department)->paginate(5);
            }
            if (!$department && $status) {
                $users = User::sortable()->where('status', $status)->paginate(5);
            }
        } else {
            if ($status && $department) {
                $users = $this->employeeService->getUserRoom(Auth::user()->department_id)->where('status', $status)->paginate(5);
            }
            if (!$department && !$status) {
                $users = $this->employeeService->getUserRoom(Auth::user()->department_id)->paginate(5);
            }
            if ($department && !$status) {
                $users = $this->employeeService->getUserRoom(Auth::user()->department_id)->where('department_id', $department)->paginate(5);
            }
            if (!$department && $status) {
                $users = $this->employeeService->getUserRoom(Auth::user()->department_id)->where('status', $status)->paginate(5);
            }
        }

        return view('employees.list', compact('users'))->with('departments', $departments);
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
        $departments = Department::select('departments.department_name', 'departments.id')->get();

        return view('employees.add')->with('departments', $departments);
    }

    public function add(CreateFormRequest $request)
    {
        $checkEmail = User::where('email', (string)$request->input('email'))->first();
        if (!$checkEmail) {
            try {
                $user = new User();
                $user->name = (string)$request->input('name');
                $user->email = (string)$request->input('email');
                $user->department_id = (int)$request->input('room');
                $user->auth = (int)$request->input('auth');
                $user->birth_day = (string)$request->input('birth_day');
                $user->start_at = (string)$request->input('start_at');
                $user->status = (int)$request->input('status');
                $user->phone = (string)$request->input('phone');
                $user->password = bcrypt(123456);
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
                return redirect('employees')->with('success', "Insert successfully");
            } catch (Exception $e) {
                return redirect('employees/add')->with('error', "operation failed");
            }
        } else {
            return redirect('employees/add')->with('error', "Email đã tồn tại");
        }
    }

    public function viewProfile(User $user)
    {
        return view('profile')->with('user', $user);
    }

    public function viewEdit(User $user)
    {
        return view('employees.edit')->with('user', $user);
    }
    public function edit(User $user, CreateFormRequest $request)
    {
        $this->employeeService->edit($request, $user);

        return redirect('employees');
    }

    public function export_csv()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function import()
    {
        return view('imports.import');
    }

    public function import_csv(Request $request)
    {
        Excel::import(new UsersImport, $request->file('file'));
        return redirect()->back();
    }
}
