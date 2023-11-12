<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart;
use App\Models\Food;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Auth::user()->carts;
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
            'cart' => $cart,
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        return response()->json(['cart' => $cart]);
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
                'cart' => $cart
            ],422);
    }


    public function pay(Cart $cart)
    {
        $cart->update([
            'paid_date' => now()->toDateTimeString()
        ]);
        return response()->json([
            'massage' => 'thanks for your money',
            'paid for' => $cart
        ]);
    }
}
