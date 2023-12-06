<?php

namespace App\Http\Controllers\api;

use App\Classes\OrderStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function archive()
    {
        $orders = Auth::user()->orders()->where('status',OrderStatus::Received)->get();
        return response()->json([
            'massage' => 'Your previous Orders',
            'orders' => OrderResource::collection($orders)
        ]);
    }

    public function active()
    {
        $orders = Auth::user()->orders()->where('status','!=',OrderStatus::Received)->get();
        return response()->json([
            'massage' => 'Your Active Orders',
            'orders' => OrderResource::collection($orders)
        ]);
    }
}
