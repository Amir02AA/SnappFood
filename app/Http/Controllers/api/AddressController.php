<?php

namespace App\Http\Controllers\api;

use App\Classes\PaginateHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\StoreAddressRequest;
use App\Http\Requests\PaginateRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use App\Models\Cart;
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
        $address = Auth::user()->addresses()->create($validated);
        return response()->json([
            'created Address' => new AddressResource($address)
        ], 201);
    }

    public function setCurrentAddress(Address $address)
    {
        $this->authorize('set-current',$address);
        Auth::user()->addresses()->update(['is_selected' => false]);
        $address->update(['is_selected' => true]);
        return response()->json(['massage' => 'selected', 'address_id' => $address->id]);
    }
}
