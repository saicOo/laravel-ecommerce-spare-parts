<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function show(Order $order)
    {
        $checkOrder = auth()->user()->orders()->find($order->id)->get();
        if($checkOrder){
            return view('front.orders.show', compact('order'));
        }
    }

}
