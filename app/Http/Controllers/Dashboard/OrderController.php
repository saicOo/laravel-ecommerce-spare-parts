<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $this->authorize('check-permissions', 'read_orders');

        $orders = Order::with('user')->when($request->search,function ($query) use ($request){
            return $query->where('name','Like','%'.$request->search.'%');
        })->latest()->paginate(10);
        return view('dashboard.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $this->authorize('check-permissions', 'read_orders');

        return view('dashboard.orders.show',compact('order'));
    }


    public function edit(Order $order)
    {
        $this->authorize('check-permissions', 'update_orders');

        return view('dashboard.orders.edit',compact('order'));
    }


    public function update(Request $request, Order $order)
    {
        $this->authorize('check-permissions', 'update_orders');

        $request->validate([
            'payment_status' => 'required|in:1,2,3',
            'tracking' => 'required|in:1,2,3,4,5',
            'address' => 'required|string|max:255',
            'building' => 'required|integer|max:1000',
            'apartment' => 'required|integer|max:100',
            'floor' => 'required|integer|max:50',
        ]);
        $order->update([
            'payment_status'=> $request->payment_status,
            'tracking'=> $request->tracking,
            'address'=> $request->address,
            'building'=> $request->building,
            'apartment'=> $request->apartment,
            'floor'=> $request->floor,
        ]);
        if($request->products){
            foreach ($order->products as $product) {
                if(in_array($product->id,$request->products)){
                    $order->products()->updateExistingPivot($product->id,[
                        'return_status' => true,
                    ]);
                    $product->update([
                        'stock' => $product->stock +  $product->pivot->quantity,
                    ]);
                }
            }
        }
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.orders.index');
    }

}
