<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function forgot()
    {
        $request->validate([
            "email" => "required|email",
        ]);

        $credentials = request()->all();
        $email = $credentials["email"];

        // Validation
        if (!$email || !preg_match("/(.+)@(.+)\.(.+)/i", $email))
            return response([
                "status" => "error",
                'email' => 'The provided email is incorrect.',
            ], 401);

        if (!User::where('email', $email)->first()) {
            return response([
                'status' => 'error',
                'message' => "email adresse doesn't exist!"
            ], 403);
        }

        Password::sendResetLink($credentials);

        return response()->json([
            "status" => "success",
            "msg" => 'Reset password link sent on your email!'
        ]);
    }

    public function reset()
    {
        $credentials = request()->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);

        $reset_password_status = Password::reset($credentials, function ($user, $password) {
            $user->password = $password;
            $user->save();
        });


        if ($reset_password_status == Password::INVALID_TOKEN) {
            return response()->json(["msg" => "Invalid token provided"], 400);
        }

        return view("auth\password_reset_success");
    }
}
