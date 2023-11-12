<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function loginSubmit(Request $request)
    {
        if (!Auth::attempt($request->validate([
            'email' => ['bail', 'required', 'string', 'email'],
            'password' => ['bail', 'required', 'string']
        ]))) {
            return back()->withErrors(['email' => 'invalid login']);
        }
        session()->regenerate();
        $route = Auth::user()->hasRole('admin')  ? 'admin.panel' : 'sales.dashboard';
        return redirect()->route($route);
    }

    public function registerStore(StoreUserRequest $request)
    {
        $user = $request->validated();
        $user['role'] = 2;
        User::create($user);
        return redirect()->route('login');
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        return redirect()->route('login');
    }
}
