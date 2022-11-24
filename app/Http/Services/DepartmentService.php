<?php

namespace App\Http\Services;

use App\Models\Department;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;

class DepartmentService
{
    public function destroy($request)
    {
        $id = (int) $request->input('id');
        $department = Department::where('id', $id)->first();
        $user = User::where('department_id', $id)->first();

        if ($department && !$user) {
            return Department::where('id', $id)->delete();
        }

        return false;
    }

    public function edit($request, $department)
    {
        $department->department_name = (string)$request->input('department_name');
        $department->description = (string)$request->input('description');
        $department->manager_id = (int)$request->input('manager');
        $department->save();

        return true;
    }
}
