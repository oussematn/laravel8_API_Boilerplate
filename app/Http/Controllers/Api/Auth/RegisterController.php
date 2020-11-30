<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    /**
     * Create User
     *
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RegisterRequest $request)
    {
        try {
            $user = User::create($request->validated());
            $user->save();

            return response([
                'status' => 'success',
                'data' => $user
            ], 200);
    
        } catch (\Exception $exception) {
            return response([
                'status' => 'error',
                'message' => "Failed to register user, please try again. {$exception->getMessage()}"
            ], 500);
        }
    }
}
