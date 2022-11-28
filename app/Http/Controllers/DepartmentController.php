<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Http\Services\DepartmentService;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    protected $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::leftJoin('users', 'departments.manager_id', '=', 'users.id')->select('departments.*', 'users.name')->paginate(5);
        return view('department.list')->with('departments', $departments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function viewAdd()
    {
        $users = User::where('auth', 2)->select('users.name', 'users.id')->get();
        return view('department.add')->with('users', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request)
    {
        // dd($request->all());
        $department = new Department();
        $department->department_name = (string)$request->input('department_name');
        $department->description = (string)$request->input('description');
        $department->manager_id = (int)$request->input('manager');
        $department->save();
        return redirect('department');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        $users = User::where('auth', 2)->select('users.name', 'users.id')->get();
        return view('department.edit')->with('department', $department)->with('users', $users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department, DepartmentRequest $request)
    {
        $this->departmentService->edit($request, $department);

        return redirect('department');
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
        $result = $this->departmentService->destroy($request);

        if ($result) {
            return response()->json([
                'error' => false,
                'message' => __('messages.delete_department_fail')
            ]);
        }
        return response()->json([
            'error' => true,
            'message' => __('messages.delete_department_fail')
        ]);
    }
}
