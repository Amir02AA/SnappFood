<?php

namespace App\Http\Controllers\admin;

use App\Classes\PaginateHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateRequest;
use App\Models\RestaurantTier;
use Illuminate\Http\Request;

class RestaurantTierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PaginateRequest $request)
    {
        $paginate = PaginateHelper::getPaginateNumber($request->get('paginate'));
        return view('admin.restaurants.index', [
            'restaurants' => RestaurantTier::paginate($paginate)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.restaurants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['bail','required','string','between:4,20','unique:restaurant_tiers']
        ]);
        RestaurantTier::create($validated);
        return redirect()->route('admin.restaurants.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(RestaurantTier $restaurant)
    {
        return redirect()->route('admin.restaurants.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RestaurantTier $restaurant)
    {
        return view('admin.restaurants.edit', compact('restaurant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RestaurantTier $restaurant)
    {
        $validated = $request->validate([
            'name' => ['bail','required','string','between:4,20','unique:restaurant_tiers']
        ]);
        $restaurant->update($validated);
        return redirect()->route('admin.restaurants.edit',$restaurant);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RestaurantTier $restaurant)
    {
        $restaurant->delete();
        return redirect()->route('admin.restaurants.index');
    }
}
