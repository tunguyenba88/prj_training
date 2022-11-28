<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeProfileRequest;
use App\Http\Requests\PasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function store()
    {
        $user = Auth::user();
        return view('profile', ['user' => $user]);
    }
    public function updateProfile()
    {
        $user = Auth::user();
        return view('layout.userEdit', ['user' => $user]);
    }
    public function updateProfileCustom(ChangeProfileRequest $request)
    {
        $user_id = Auth::user()->id;

        User::where('id', $user_id)
            ->update(['birth_day' => $request->birth_day1, 'phone' => $request->phone1]);
        return redirect('profile');
    }

    public function changePassword()
    {
        return view('changePassword');
    }

    public function changePasswordCustom(PasswordRequest $request)
    {

        $user_id = Auth::user()->id;
        $password = User::where('id', $user_id)->first('password');
        $current_password = $request->current_password;
        if (!(Hash::check($current_password, $password->password))) {
            return redirect()->back()->with("error", __('messages.wrong_password'));
        }
        $new_password = $request->new_password;
        if (Hash::check($new_password, $password->password)) {
            return redirect()->back()->with("error", __('messages.duplicate_password'));
        }

        User::where('id', $user_id)->update(['password' => bcrypt($new_password)]);

        return redirect('profile')->with("success", __('messages.password_success'));
    }
}
