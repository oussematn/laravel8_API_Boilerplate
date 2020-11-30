<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\TokenRequest;
use JWTAuth;

class UserController extends Controller
{
    /**
     * Get the authenticated User.
     *
     * @param TokenRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(TokenRequest $request)
    {
        $user = JWTAuth::authenticate($request->token);

        return response()->json([
            'status' => 'success',
            'user' => $user
        ], 200);
    }
}
