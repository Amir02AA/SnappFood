<?php

namespace App\Http\Controllers\SalesMan;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRestaurantProfileRequest;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function profile()
    {
        return view('sales.profile');
    }

    public function dashboard()
    {
        if (Auth::user()->restaurant == null){
            return redirect()->route('sales.profile');
        }
        return view('sales.dashboard',[
            'user' => Auth::user()
        ]);
    }

    public function settings()
    {
        return view('sales.settings',[
            'user'=> Auth::user()
        ]);
    }

    public function profileStore(StoreRestaurantProfileRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::user()->id;
        Restaurant::create(array_filter($validated));

        return redirect()->route('sales.dashboard');
    }

    public function settingsStore()
    {

    }
}
