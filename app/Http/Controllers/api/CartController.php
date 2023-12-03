<?php

namespace App\Http\Controllers\api;

use App\Classes\UserHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\PayRequest;
use App\Http\Requests\api\StoreCartRequest;
use App\Http\Requests\api\UpdateCartRequest;
use App\Http\Resources\CartResource;
use App\Http\Resources\OrderResource;
use App\Models\Cart;
use App\Models\Food;
use App\Models\OffCode;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = Auth::user()->carts;
        if ($carts->isEmpty()) return response()->json(['massage' => 'there is no carts'], 404);
        return CartResource::collection($carts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request)
    {
        $this->authorize('create', Cart::class);
        $food = Food::query()->find($request->validated('food_id'));
        $cart = Cart::relatedCart($food->restaurant_id)->firstOrCreate([
            'user_id' => Auth::id(),
            'restaurant_id' => $food->restaurant_id,
            'address_id' => Auth::user()->current_address->id
        ]);
        UserHelper::cartFoodPivotUpdate($cart, $food->id, $request->validated('count'));
        return response()->json(['cart' => new CartResource($cart),], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        $this->authorize('view', [Cart::class, $cart]);
        return response()->json(['cart' => new CartResource($cart)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request)
    {
        $food = Food::query()->find($request->validated('food_id'));
        $cart = Cart::relatedCart($food->restaurant_id)->first();
        if (!$cart)
            return response()->json(['massage' => 'you must add your item to a new cart'], 404);
        $cart->food()->updateExistingPivot($food->id, ['count' => $request->validated('count')]);

        if ((int)$request->validated('count') === 0)
            $cart->food()->detach($request->validated('food_id'));

        if (!UserHelper::afterCartUpdateCheck($cart))
            return response()->json(['massage' => 'cart deleted', 'cart_id' => $cart->id]);

        return response()->json(['massage' => 'cart updated', 'cart' => new CartResource($cart)], 422);
    }


    public function pay(Cart $cart, PayRequest $request)
    {
        $this->authorize('pay', [Cart::class, $cart]);
        $offCode = OffCode::query()->where('code', $request->get('code'))->first();
        $cart->update(['off_code_id' => $offCode?->id,]);
        $order = UserHelper::createOrderForCart($cart);
        $cart->delete();
//        CartPaid::dispatch($cart);
        return response()->json([
            'massage' => 'thanks for your money',
            'data' => new OrderResource($order)
        ]);
    }
}
