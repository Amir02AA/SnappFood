<?php

namespace App\Http\Controllers\api;

use App\Classes\OrderStatus;
use App\Events\CartPaid;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\StoreCartRequest;
use App\Http\Requests\api\UpdateCartRequest;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Food;
use App\Models\OffCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CartResource::collection(Auth::user()->carts()->where('paid_date',null)->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request)
    {
        $food = Food::query()->find($request->validated('food_id'));
        $restaurantId = $food->restaurant_id;
        $count = $request->validated('count');

        $cart = Cart::relatedCart($restaurantId)->get()->first();

        $cart = (!$cart) ? Cart::create([
            'user_id' => Auth::id(),
            'restaurant_id' => $restaurantId,
        ]) : $cart;

        $cart->food()->attach($food->id, ['count' => $count]);

        return response()->json([
            'cart' => new CartResource($cart),
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        return response()->json(['cart' => new CartResource($cart)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request)
    {
        $food = Food::query()->find($request->validated('food_id'));
        $count = $request->validated('count');
        $cart = Cart::relatedCart($food->restaurant_id)->get()->first();
        $cart?->food()->updateExistingPivot($food->id, ['count' => $count,]);

        return (!$cart) ?
            response()->json([
                'massage' => 'you must add your item to a new cart'
            ])
            : response()->json([
                'massage' => 'updated',
                'cart' => new CartResource($cart)
            ], 422);
    }


    public function pay(Cart $cart, Request $request)
    {
        if ($cart->paid_date) return response()->json(['massage' => 'Already Paid'], 404);
        if (!$cart->user->current_address) return response()->json(['massage' => 'Please Select an Address'], 404);

        $request->validate([
            'code' => 'nullable|string|max:100|exists:off_codes,code'
        ]);
        $offCode = OffCode::query()->where('code',$request->get('code'))->first();

        $cart->update([
            'paid_date' => now()->toDateTimeString(),
            'address_id' => $cart->user->current_address->id,
            'off_code_id' => $offCode?->id,
            'status' => OrderStatus::Wait
        ]);
//        CartPaid::dispatch($cart);
        return response()->json([
            'massage' => 'thanks for your money',
            'data' => new CartResource($cart)
        ]);
    }
}
