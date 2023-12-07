<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\WebLoginRequest;
use App\Models\Cart;
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

    public function loginSubmit(WebLoginRequest $request)
    {
        if (!Auth::attempt($request->validated())) {
            return back()->withErrors(['email' => 'invalid login']);
        }
        session()->regenerate();
        $route = Auth::user()->hasRole('admin')  ? 'admin.panel' : 'sales.profile';
        return redirect()->route($route);
    }

    public function registerStore(StoreUserRequest $request)
    {
        $user = $request->validated();
        User::create($user)->assignRole('sales');
        return redirect()->route('login');
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        return redirect()->route('login');
    }
}
