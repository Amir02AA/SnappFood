<?php

namespace App\Http\Controllers\salesman;

use App\Classes\OrderStatus;
use App\Classes\SalesHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRestaurantProfileRequest;
use App\Models\Restaurant;
use App\Models\RestaurantTier;
use Illuminate\Http\Request;
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

    public function dashboard(Request $request)
    {
        $request->validate(['status' => ['nullable','in:1,2,3']]);
        if (Auth::user()->restaurant === null) {
            return redirect()->route('sales.profile');
        }

        return view('sales.dashboard', [
            'user' => Auth::user(),
            'orders' => SalesHelper::getSortedOrders($request->get('status'))
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
        $restaurant->address()->create([$validated]);

        return redirect()->route('sales.dashboard');
    }

    public function settingsStore(StoreRestaurantProfileRequest $request, Restaurant $restaurant)
    {
        $validated = array_filter($request->validated());
        $tiers = $validated['tiers'];
        $restaurant->update($request->safe()->except(['lang', 'long', 'address','tiers']));
        $restaurant->address->update($request->safe()->only(['name', 'lang', 'long', 'address']));
        $restaurant->tiers()->sync($tiers);

        return redirect()->route('sales.dashboard');
    }
}
