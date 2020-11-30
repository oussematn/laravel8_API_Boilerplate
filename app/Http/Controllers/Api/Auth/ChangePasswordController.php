<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\Auth\ChangePasswordRequest;

class ChangePasswordController extends Controller
{
    /**
     * Change password.
     *
     * @param ChangePasswordRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ChangePasswordRequest $request)
    {
        $user = User::where('email', '=', $request->get('email'))->first();
        $user->password = $request->get('password');
        $user->save();

        if (!$user) {
            return response()->json([
                'message' => 'We can\'t find a user with that e-mail address.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully change password'
        ], 200);
    }
}
