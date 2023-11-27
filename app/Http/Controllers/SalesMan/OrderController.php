<?php

namespace App\Http\Controllers\salesman;

use App\Classes\OrderStatus;
use App\Classes\SalesHelper;
use App\Events\CartStatusChanged;
use App\Http\Controllers\Controller;
use App\Http\Requests\SortArchiveRequest;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function nextState(Cart $cart)
    {
        $cart->nextStep();
        CartStatusChanged::dispatch($cart);
        return redirect()->route('sales.dashboard');
    }

    public function archive(SortArchiveRequest $request)
    {
        $carts = Auth::user()->restaurant->carts()->where('status', OrderStatus::Received);
        if ($request->anyFilled(['from', 'to']))
            $carts = SalesHelper::getSortedOrdersByDate(
                $request->validated('from'),
                $request->validated('to')
            );
        $carts = $carts->get();
        $totalIncome = $carts
            ->sum(function (Cart $cart) {
                return $cart->total_fee_after_off;
            });
        return view('sales.order.archive', compact('carts', 'totalIncome'));
    }
}
