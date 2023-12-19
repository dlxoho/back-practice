<?php

namespace App\Http\Controllers;

use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function list(Request $request)
    {
        $rows = User::from('user as u')
            ->orderByDesc('created_at')
            ->get();
        return response()->json($rows);
    }

    public function store (Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required',
                'age' => 'required',
                'memo' => 'required',
                'password' => 'required'
            ]
        );

        if ($validator->fails()) {
            return \response()->json([
                'message' => $validator->errors()->toArray()
            ],422);
        }

        try {
            $user = User::create([
               '__uid' => Str::uuid()->toString(),
               'name' => $request->input('name'),
               'email' => $request->input('email'),
               'age' => $request->input('age'),
               'memo' => $request->input('memo'),
               'password' => Hash::make($request->input('password')),
               'created_at' => now()
            ]);

            return \response()->json([
               'result' => 'success',
               'data' => $user
            ]);
        } catch (\Exception $e) {
            return \response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }

    public function show(User $user)
    {
        return response()->json($user);
    }

    public function delete(User $user)
    {
        try {
            $user->delete();
            return \response()->json([
               'result' => 'success'
            ]);
        } catch (\Exception $e) {
            return \response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }

    public function me ()
    {
        return \response()->json(Auth::guard('laravel:users')->user());
    }
}

