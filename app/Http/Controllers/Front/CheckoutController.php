<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = auth()->user()->products;
        $total_price = auth()->user()->products()->sum(\DB::raw('products.price * product_user.quantity'));
        return view('front.checkout.index',compact('products','total_price'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        // switch ($request->selector) {
        //     case "cash":
        //         dd('cash');
        //       break;
        //     case "payment":
        //         dd('payment');
        //       break;
        //     default:
        //      return redirect()->back();
        //   }

        $order = Order::create([
            'user_id' =>  $user->id,
        ]);
        $total_price = 0;
         // start foreach
         foreach ($user->products as $product) {

            $order->products()->attach($product->id,['quantity' => $product->pivot->quantity,
            'price' => $product->price ]);

            $product->update([
                    'stock' => $product->stock - $product->pivot->quantity,
                            ]);

        $total_price +=  $product->price * $product->pivot->quantity;
        } // end foeach
        
        $order->update([
            'total_price' => $total_price,
        ]);// end update order data table

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
