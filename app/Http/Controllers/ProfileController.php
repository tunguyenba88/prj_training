<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function store()
    {
        $user = Auth::user();

        return view('profile', ['user' => $user]);
    }

    public function view_profile(Request $request)
    {

        $user = DB::table('users')->where('id', $request);
        return view('profile', ['user' => $request]);
    }

    public function update(Request $request)
    {
    }

    public function update_view()
    {
        $user = Auth::user();
        return view('update_view', ['user' => $user]);
    }
}
