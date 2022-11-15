<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
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

    public function updateProfile(Request $request)
    {
        $user_id = Auth::user()->id;

        DB::table('users')
            ->where('id', $user_id)
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
        $password = DB::table('users')->where('id', $user_id)->first('password');
        $current_password = $request->current_password;
        if (!(Hash::check($current_password, $password->password))) {
            return redirect()->back()->with("error", "Nhập sai mật khẩu");
        }
        $new_password = $request->new_password;
        if (Hash::check($new_password, $password->password)) {
            return redirect()->back()->with("error", "Trùng với mật khẩu cũ");
        }

        DB::table('users')
            ->where('id', $user_id)
            ->update(['password' => bcrypt($new_password)]);

        return redirect('profile')->with("success", "Đổi mật khẩu thành công !");
    }
}
