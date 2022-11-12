<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->input());

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ])) {
            return redirect()->route('profile');
        }

        return redirect()->back();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('login');;
    }

    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('profile');
        }
        return view('login');
    }
}
