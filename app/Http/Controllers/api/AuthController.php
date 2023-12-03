<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(StoreUserRequest $request)
    {
        $user = User::create($request->validated());
        return response()->json([
            'massage' => 'user created',
            'token' => $user->createToken('auth')->plainTextToken
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->validated())) return response()->json(['msg' => 'wrong credentials'], 401);

        Auth::user()->tokens()->delete();
        $token = Auth::user()->createToken('auth')->plainTextToken;
        return response()->json(['massage' => 'welcome', 'token' => $token]);
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        return response()->json([
            'massage' => 'logged Out'
        ]);
    }
}
