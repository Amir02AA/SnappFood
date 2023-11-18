<?php

namespace App\Http\Controllers\salesman;

use App\Classes\OrderStatus;
use App\Events\CartStatusChanged;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function nextState(Cart $cart)
    {
        $cart->nextStep();
        CartStatusChanged::dispatch($cart);
        return redirect()->route('sales.dashboard');
    }

    public function cancel(Cart $cart)
    {
        $cart->delete();
        return redirect()->route('sales.dashboard');
    }

    public function archive()
    {
        return 'archive';
    }
}
