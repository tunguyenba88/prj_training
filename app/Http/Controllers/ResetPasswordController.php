<?php

namespace App\Http\Controllers;

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
        dd($request->email);
        $user = User::where('email', $request->email)->firstOrFail();
        $passwordReset = PasswordReset::updateOrCreate([
            'email' => $user->email,
        ], [
            'token' => Str::random(60),
        ]);
        if ($passwordReset) {
            $user->notify(new ResetPasswordRequest($passwordReset->token));
        }

        return response()->json([
            'message' => 'We have e-mailed your password reset link!',
            'error' => false,
        ]);
    }

    public function reset(Request $request, $token)
    {
        $passwordReset = PasswordReset::where('token', $token)->firstOrFail();
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();

            return response()->json([
                'message' => 'This password reset token is invalid.',
            ], 422);
        }
        $user = User::where('email', $passwordReset->email)->firstOrFail();
        $updatePasswordUser = $user->update($request->only('password'));
        $passwordReset->delete();

        return response()->json([
            'success' => $updatePasswordUser,
        ]);
    }
}
