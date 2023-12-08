<?php

namespace App\Http\Controllers\salesman;

use App\Classes\OrderStatus;
use App\Classes\PaginateHelper;
use App\Classes\SalesHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShowOrdersRequest;
use App\Http\Requests\StoreRestaurantProfileRequest;
use App\Models\Restaurant;
use App\Models\RestaurantTier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    public function profile()
    {
        if (Gate::allows('visit-site')) {
            return redirect()->route('sales.dashboard');
        }
        return view('sales.profile', [
            'user' => Auth::user(),
            'tiers' => RestaurantTier::all()
        ]);
    }

    public function dashboard(ShowOrdersRequest $request)
    {
        $paginate = PaginateHelper::getPaginateNumber($request->get('paginate'));
        return view('sales.dashboard', [
            'user' => Auth::user(),
            'orders' => SalesHelper::getSortedOrders($request->get('status'))->paginate($paginate)
        ]);
    }

    public function settings()
    {
        Gate::authorize('visit-site');
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
        $restaurant = Restaurant::create($validated);
        $restaurant->tiers()->sync($tiers);
        $restaurant->address()->create($validated);

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
