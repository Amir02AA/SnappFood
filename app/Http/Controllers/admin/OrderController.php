<?php

namespace App\Http\Controllers\admin;

use App\Classes\SalesHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\SortArchiveRequest;
use App\Models\Cart;

class OrderController extends Controller
{
    public function archive(SortArchiveRequest $request)
    {
        $carts = SalesHelper::getSortedOrdersByDate(
            $request->validated('from'),
            $request->validated('to'),
            true
        );
        $totalIncome = $carts->get()->sum(fn(Cart $cart) => $cart->total_fee_after_off);
        $carts = $carts->paginate(5);
        return view('admin.order.archive', compact('carts', 'totalIncome'));
    }

    public function show(Cart $cart)
    {
        return view('admin.order.show', compact('cart'));
    }
}
