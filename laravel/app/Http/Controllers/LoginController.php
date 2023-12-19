<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // login
    public function login (Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->toArray()
            ],422);
        }

        if (!$token = Auth::guard('laravel:users')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            return response()->json([
                'message' => 'Unauthorized'
            ],401);
        }

        return $this->responseWithToken($token);
    }

    // logout
    public function logout (): \Illuminate\Http\JsonResponse
    {
        try {
            Auth::guard('laravel:users')->logout();
            return response()->json([
               'result' => 'success'
            ]);
        } catch (\Exception $e) {
            return response()->json([
               'message' => $e->getMessage()
            ]);
        }
    }

    private function responseWithToken($token): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('laravel:users')->factory()->getTTL() * 60
        ]);
    }
}
