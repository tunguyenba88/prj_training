<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function store(Request $request)
    {
        $remember = isset($request->checkbox) ? true : false;
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ], $remember)) {
            return redirect()->route('profile');
        }
        Session::flash('error', __('messages.wrong_email'));
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
