<?php

namespace App\Http\Controllers\Api;

use Hash;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function postLogin(Request $request): JsonResponse
    {

        $user = User::where('email', $request->getUser())->first();

        if (!$user || !Hash::check($request->getPassword(), $user->password)) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Invalid basic auth'
            ], 401);
        }

        return response()->json([
            'status' => 'OK',
            'token' => $user->createToken('API Token')->plainTextToken,
            'token_type' => 'Bearer'
        ]);
    }
}
