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
        return Auth::user()->addresses;
    }

    public function store(StoreAddressRequest $request)
    {
        $validated=$request->validated();
        $validated['user_id'] = Auth::id();
        $address = Address::create($validated);
        return [
            'created Address' => $address
        ];
    }

    public function setCurrentAddress(Address $address)
    {
        Auth::user()->addresses->toQuery()->update(['is_selected' => false]);
        $address->is_selected = true;
        $address->save();
        return 'address: '.$address->name." selected";
    }
}
