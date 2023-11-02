<?php

namespace App\Http\Controllers\SalesMan;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRestaurantProfileRequest;
use App\Models\Restaurant;
use App\Models\RestaurantTier;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function profile()
    {
        return view('sales.profile', [
            'user' => Auth::user(),
            'tiers' => RestaurantTier::all()
        ]);
    }

    public function dashboard()
    {
        if (Auth::user()->restaurant == null) {
            return redirect()->route('sales.profile');
        }
        return view('sales.dashboard', [
            'user' => Auth::user()
        ]);
    }

    public function settings()
    {
        return view('sales.settings', [
            'restaurant' => Auth::user()->restaurant,
            'tiers' => RestaurantTier::all()
        ]);
    }

    public function profileStore(StoreRestaurantProfileRequest $request)
    {
        $validated = $request->validated();
        $tiers = $validated['tiers'];
        unset($validated['tiers']);
        $validated['user_id'] = Auth::user()->id;

        $restaurant = Restaurant::create(array_filter($validated));
        $restaurant->tiers()->sync($tiers);

        return redirect()->route('sales.dashboard');
    }

    public function settingsStore(StoreRestaurantProfileRequest $request, Restaurant $restaurant)
    {
        $validated = array_filter($request->validated());
        $tiers = $validated['tiers'];
        unset($validated['tiers']);
        $validated['user_id'] = Auth::user()->id;

        $restaurant->update($validated);
        $restaurant->tiers()->sync($tiers);

        return redirect()->route('sales.dashboard');
    }
}
