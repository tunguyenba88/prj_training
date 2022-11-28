<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use app\Models\User;
use Illuminate\Support\Str;
use App\Notifications\ResetPasswordRequest;

class ResetPasswordController extends Controller
{
    public function sendMail(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $password = Str::random(10);
        $listUser = array();
        $messages = array();
        User::where('email', $request->email)->update(['password' => bcrypt($password)]);
        $message = [
            'title' => __('messages.reset_password_title'),
            'task' => __('messages.reset_password_task'),
            'data' => $password,
        ];
        array_push($listUser, $user);
        array_push($messages, $message);

        $job = (new SendEmail($messages, $listUser));
        $this->dispatch($job);

        return redirect()->back();
    }
}
