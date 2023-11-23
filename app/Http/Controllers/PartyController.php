<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Party;
use Illuminate\Http\Request;

class PartyController extends Controller
{
    public function index()
    {
        $parties = Party::paginate(4);
        return view('sales.party.index',compact('parties'));
    }

    public function create(Food $food)
    {
        if ($food->party !== null) return redirect()->route('sales.food.index');
        return view('sales.party.create', compact('food'));
    }

    public function store(Request $request, Food $food)
    {
        $validated = $request->validate([
            'count' => ['required', 'numeric', 'between:1,10'],
            'percent' => ['required', 'numeric', 'between:30,80'],
        ]);
        $validated['food_id'] = $food->id;

        Party::create($validated);
        return redirect()->route('sales.food.index');
    }

    public function destroy(Food $food)
    {
        $food->party->delete();
        return redirect()->route('sales.food.index');
    }
}
