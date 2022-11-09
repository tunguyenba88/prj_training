<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ListEmployeeController extends Controller
{
    public function store()
    {
        $user = Auth::user();
        $role = $user->auth;
        $users = DB::table('users')->get();
        if ($user->auth < 3) {
            // $users = DB::table('users')->get();
            // return view('list', ['users' => $users]);
            return view('list', ['users' => $users, 'role' => $role]);
        }
        return redirect('profile');
    }
}
