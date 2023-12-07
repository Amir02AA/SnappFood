<?php

namespace App\Http\Controllers\salesman;

use App\Classes\PaginateHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateRequest;
use App\Models\Food;
use App\Models\Party;
use Illuminate\Http\Request;

class PartyController extends Controller
{
    public function index(PaginateRequest $request)
    {
        $paginate = PaginateHelper::getPaginateNumber($request->get('paginate'));
        $parties = Party::paginate($paginate);
        return view('sales.party.index',compact('parties'));
    }

    public function create(Food $food)
    {
        $this->authorize('create-party',$food);
        return view('sales.party.create', compact('food'));
    }

    public function store(Request $request, Food $food)
    {
        $this->authorize('create-party',$food);
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
        $this->authorize('delete-party',$food);
        $food->party->delete();
        return redirect()->route('sales.food.index');
    }
}
