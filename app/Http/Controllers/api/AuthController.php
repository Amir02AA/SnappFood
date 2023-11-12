<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(StoreUserRequest $request)
    {
        $user = User::create($request->validated());
        return response()->json([
            'msg' => 'user created',
            'token' => $user->createToken('auth')->plainTextToken
        ],201);
    }

    public function login(Request $request)
    {
        return (Auth::attempt($request->validate([
            'email' => ['required','email'],
            'password' => ['required','string']
        ]))) ?
            response()->json(['token' => Auth::user()->createToken('auth')->plainTextToken])
            : response()->json(['msg'=>'wrong credentials'],401);
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        return response()->json([
            'msg' => 'logged Out'
        ]);
    }

}
