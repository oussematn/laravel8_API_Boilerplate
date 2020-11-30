<?php

namespace App\Http\Controllers\Api\Auth;

use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\TokenRequest;
use Illuminate\Http\Request;
use JWTAuth;

class LogoutController extends Controller
{
    /**
     * Log the user out (Invalidate the token).
     *
     * @param TokenRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(TokenRequest $request)
    {
        try {

            JWTAuth::invalidate($request->token);
            auth()->logout();

            return response()->json([
                'status' => 'success',
                'message' => 'Successfully logged out'
            ], 200);
        } catch (JWTException $exception) {
            return response()->json([
                'status' => 'error',
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }
}
