<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\StoreAddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AddressController extends Controller
{
    public function index()
    {
        return \response()->json(
            ['addresses' => AddressResource::collection(Auth::user()->addresses)]
        );
    }

    public function store(StoreAddressRequest $request)
    {
        $validated = $request->validated();
        $address = Auth::user()->address()->create($validated);
        return response()->json([
            'created Address' => new AddressResource($address)
        ], 201);
    }

    public function setCurrentAddress(Address $address)
    {
        if ($address->addressable->isNot(Auth::user()))
            return response()->json(['massage' => 'address not found'], 404);
        Auth::user()->addresses()->update(['is_selected' => false]);
        $address->update(['is_selected' => true]);
        return response()->json(['massage' => 'selected', 'address_id' => $address->id]);
    }
}
