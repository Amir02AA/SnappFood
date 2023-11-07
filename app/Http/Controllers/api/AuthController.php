<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register($request)
    {
        User::create($request->validated());
        return 'user created';
    }

    public function login(Request $request)
    {
        return (Auth::attempt($request->validate([
            'email' => ['required','email'],
            'password' => ['required','string']
        ]))) ?
            ['token' => Auth::user()->createToken('auth')->plainTextToken]
            : 'wrong credentials';
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        return 'logged Out';
    }

}
