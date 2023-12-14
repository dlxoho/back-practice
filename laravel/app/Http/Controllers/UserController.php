<?php

namespace App\Http\Controllers;

use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function list(Request $request)
    {
        $rows = User::from('user as u')
            ->orderByDesc('created_at')
            ->get();
        return response()->json($rows);
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
}

