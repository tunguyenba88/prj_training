<?php

namespace App\Http\Controllers;

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

    public function update_profile(Request $request)
    {
        $user_id = Auth::user()->id;

        DB::table('users')
            ->where('id', $user_id)
            ->update(['birth_day' => $request->birth_day1, 'phone' => $request->phone1]);
        return redirect('profile');
    }

    public function change_password()
    {
        return view('changePassword');
    }

    public function change_password_custom(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);
        $user_id = Auth::user()->id;
        $password = DB::table('users')->where('id', $user_id)->get('password');
        $current_password = $request->current_password;
        if (!(Hash::check($current_password, $password[0]->password))) {
            return redirect()->back()->with("error", "Nhập sai mật khẩu");
        }
        $new_password = $request->new_password;
        if (Hash::check($new_password, $password[0]->password)) {
            return redirect()->back()->with("error", "Trùng với mật khẩu cũ");
        }
        $confirm_password = $request->confirm_password;

        if (!($confirm_password == $new_password)) {
            return redirect()->back()->with("error", "Khác");
        }

        DB::table('users')
            ->where('id', $user_id)
            ->update(['password' => bcrypt($new_password)]);

        return redirect('profile')->with("success", "Đổi mật khẩu thành công !");
    }
}
