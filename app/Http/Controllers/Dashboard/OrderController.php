<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::with('user')->when($request->search,function ($query) use ($request){
            return $query->where('name','Like','%'.$request->search.'%');
        })->latest()->paginate(10);
        return view('dashboard.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('dashboard.orders.show',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('dashboard.orders.edit',compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
