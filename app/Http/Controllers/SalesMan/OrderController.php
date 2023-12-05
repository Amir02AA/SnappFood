<?php

namespace App\Http\Controllers\salesman;

use App\Classes\OrderStatus;
use App\Classes\SalesHelper;
use App\Events\CartStatusChanged;
use App\Events\OrderCanceled;
use App\Http\Controllers\Controller;
use App\Http\Requests\SortArchiveRequest;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function nextState(Order $order)
    {
        $order->nextStep();
//        CartStatusChanged::dispatch($order);
        return redirect()->route('sales.dashboard');
    }

    public function archive(SortArchiveRequest $request)
    {
        $orders = SalesHelper::getSortedOrdersByDate(
                $request->validated('from'),
                $request->validated('to')
            );
        $totalIncome = $orders->get()->sum(function (Order $order) {return $order->total_price;});
        $orders = $orders->paginate(5);
        return view('sales.order.archive', compact('orders', 'totalIncome'));
    }

    public function cancel(Order $order)
    {
        OrderCanceled::dispatch($order);
        $order->delete();
        return redirect()->route('sales.dashboard');
    }

    public function show(Order $order)
    {
        if ($order->restaurant->isNot(Auth::user()->restaurant)) return redirect()->route('sales.order.archive');

        return view('sales.order.show',compact('order'));
    }
}
