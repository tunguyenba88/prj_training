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
        User::where('email', $request->email)->update(['password' => bcrypt($password)]);
        $message = [
            'title' => 'Reset Password',
            'data' => $password,
        ];

        $job = (new SendEmail($message,  $user));
        $this->dispatch($job);

        return redirect()->back();
    }
}
