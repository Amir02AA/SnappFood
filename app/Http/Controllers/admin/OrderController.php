<?php

namespace App\Http\Controllers\admin;

use App\Classes\PaginateHelper;
use App\Classes\SalesHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\SortArchiveRequest;
use App\Models\Cart;
use App\Models\Order;

class OrderController extends Controller
{
    public function archive(SortArchiveRequest $request)
    {
        $orders = SalesHelper::getSortedOrdersByDate(
            $request->validated('from'),
            $request->validated('to'),
            true
        );
        $paginate = PaginateHelper::getPaginateNumber($request->get('paginate'));
        $totalIncome = $orders->get()->sum(fn(Order $order) => $order->total_fee_after_off);
        $orders = $orders->paginate($paginate);
        return view('admin.order.archive', compact('orders', 'totalIncome'));
    }

    public function show(Order $order)
    {
        return view('admin.order.show', compact('order'));
    }
}
