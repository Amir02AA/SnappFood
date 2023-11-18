<?php

namespace App\Http\Controllers\salesman;

use App\Classes\OrderStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRestaurantProfileRequest;
use App\Models\Restaurant;
use App\Models\RestaurantTier;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function profile()
    {
        if (Auth::user()->restaurant !== null) {
            return redirect()->route('sales.settings');
        }
        return view('sales.profile', [
            'user' => Auth::user(),
            'tiers' => RestaurantTier::all()
        ]);
    }

    public function dashboard()
    {
        if (Auth::user()->restaurant === null) {
            return redirect()->route('sales.profile');
        }

        return view('sales.dashboard', [
            'user' => Auth::user(),
            'carts' => Auth::user()->restaurant->carts()
                ->where('status', '!=', OrderStatus::Received)
                ->where('paid_date', '!=', null)
                ->get()
        ]);
    }

    public function settings()
    {
        if (Auth::user()->restaurant === null) {
            return redirect()->route('sales.profile');
        }
        return view('sales.settings', [
            'restaurant' => Auth::user()->restaurant,
            'tiers' => RestaurantTier::all()
        ]);
    }

    public function profileStore(StoreRestaurantProfileRequest $request)
    {
        $validated = $request->validated();
        $tiers = $validated['tiers'];
        $validated['user_id'] = Auth::user()->id;
        $restaurant = Restaurant::create(array_filter($validated));
        $restaurant->tiers()->sync($tiers);

        return redirect()->route('sales.dashboard');
    }

    public function settingsStore(StoreRestaurantProfileRequest $request, Restaurant $restaurant)
    {
        $validated = array_filter($request->validated());
        $tiers = $validated['tiers'];
        $validated['user_id'] = Auth::user()->id;
        $restaurant->update($validated);
        $restaurant->tiers()->sync($tiers);

        return redirect()->route('sales.dashboard');
    }
}
