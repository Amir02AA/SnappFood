<?php

namespace App\Http\Controllers\salesman;

use App\Classes\OrderStatus;
use App\Classes\PaginateHelper;
use App\Classes\SalesHelper;
use App\Events\CartStatusChanged;
use App\Events\OrderCanceled;
use App\Http\Controllers\Controller;
use App\Http\Requests\SortArchiveRequest;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class OrderController extends Controller
{
    public function nextState(Order $order)
    {
        $this->authorize('change-status',$order);
        $order->nextStep();
        CartStatusChanged::dispatch($order);
        return redirect()->route('sales.dashboard');
    }

    public function archive(SortArchiveRequest $request)
    {
        $orders = SalesHelper::getSortedOrdersByDate(
                $request->validated('from'),
                $request->validated('to')
            );
        $totalIncome = $orders->get()->sum(function (Order $order) {return $order->total_price;});
        $paginate = PaginateHelper::getPaginateNumber($request->get('paginate'));
        $orders = $orders->paginate($paginate);
        return view('sales.order.archive', compact('orders', 'totalIncome'));
    }

    public function cancel(Order $order)
    {
        $this->authorize('delete',$order);
        OrderCanceled::dispatch($order);
        $order->delete();
        return redirect()->route('sales.dashboard');
    }

    public function show(Order $order)
    {
        $this->authorize('view',$order);
        return view('sales.order.show',compact('order'));
    }
}
