<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddressRequest;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index()
    {
        return \response()->json(['addresses' => Auth::user()->addresses]);
    }

    public function store(StoreAddressRequest $request)
    {
        $validated = $request->validated();
        $address = Address::create($validated);
        return response()->json([
            'created Address' => $address
        ], 201);
    }

    public function setCurrentAddress(Address $address)
    {
        Auth::user()->addresses()->update(['is_selected' => false]);
        if ($address->user_id !== Auth::id())
            return response()->json(['massage' => 'address not found'], 404);
        $address->is_selected = true;
        $address->save();
        return response()->json(['massage' => 'selected', 'address_id' => $address->id]);
    }
}
