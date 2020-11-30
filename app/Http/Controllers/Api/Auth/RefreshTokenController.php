<?php

namespace App\Http\Controllers\Api\Auth;

use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseApiToken;

class RefreshTokenController extends Controller
{
    use ResponseApiToken;

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get()
    {
        try {
            return $this->respondWithToken(auth()->refresh());

        } catch (JWTException $e) {
            return $this->json(['message' => "Error: {$e->getMessage()}"], 500);
        }

    }
}
