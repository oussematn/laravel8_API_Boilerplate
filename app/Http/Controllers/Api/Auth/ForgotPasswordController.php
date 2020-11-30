<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Traits\PasswordRandom;
use App\Notifications\UserForgotPassword;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Notification;

class ForgotPasswordController extends Controller
{
    use PasswordRandom;

    /**
     * Forgot password.
     *
     * @param ForgotPasswordRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ForgotPasswordRequest $request)
    {
        $passwordRandom = $this->getRandomPassword();
        $user = User::where('email', '=', $request->get('email'))->first();

        if (!$user) {
            return response()->json([
                'message' => 'We can\'t find a user with that e-mail address.'
            ], 404);
        }

        Notification::send($user, new UserForgotPassword($user, $passwordRandom));

        $user->password = $passwordRandom;
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully change password'
        ], 200);
    }

    public function forgot()
    {
        /* 
            $to_name = ‘RECEIVER_NAME’;
            $to_email = ‘RECEIVER_EMAIL_ADDRESS’;
            $data = array(‘name’=>”Ogbonna Vitalis(sender_name)”, “body” => “A test mail”);
            Mail::send(‘emails.mail’, $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
            ->subject(Laravel Test Mail’);
            $message->from(‘SENDER_EMAIL_ADDRESS’,’Test Mail’);
        */
        /* 
            will recieve an email adresse
            send link to email with url to the page where the user can submit new password
        */
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

        /* Mail::mailer('smtp')->to('oussmiled@gmail.com')->send(new myMailer());
        return 'done'; */
    }
}
