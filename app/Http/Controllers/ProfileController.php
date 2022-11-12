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

    public function update_profile(Request $request)
    {
        $user_id = Auth::user()->id;

        DB::table('users')
            ->where('id', $user_id)
            ->update(['birth_day' => $request->birth_day1, 'phone' => $request->phone1]);
        return redirect('profile');
    }
}
