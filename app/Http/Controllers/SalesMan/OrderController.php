<?php

namespace App\Http\Controllers\salesman;

use App\Classes\OrderStatus;
use App\Events\CartStatusChanged;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function nextState(Cart $cart)
    {
        $cart->nextStep();
        CartStatusChanged::dispatch($cart);
        return redirect()->route('sales.dashboard');
    }

    public function archive()
    {
        $carts = Auth::user()->restaurant->carts()->where('status',OrderStatus::Received)->paginate(3);
        return view('sales.order.archive',compact('carts'));
    }
}
