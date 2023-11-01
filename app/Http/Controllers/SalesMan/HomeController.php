<?php

namespace App\Http\Controllers\SalesMan;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function profile()
    {
        return view('sales.profile');
    }

    public function dashboard()
    {
        return view('sales.dashboard');
    }

    public function settings()
    {
        return view('sales.settings');
    }

    public function profileStore()
    {

    }

    public function settingsStore()
    {

    }
}
