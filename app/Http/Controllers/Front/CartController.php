<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
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
        $products_silder = Product::inRandomOrder()->limit(6)->get();
        $products = auth()->user()->products;
        $total_price = auth()->user()->products->sum('pivot.price');
        return view('front.cart.index',compact('products','total_price','products_silder'));
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
        auth()->user()->products()->attach($request->product_id,['quantity' => $request->quantity]);
        return redirect()->back();
    }

    public function show(User $user)
    {
        //
    }


    public function edit(User $user)
    {
        //
    }

    public function update(Request $request,User $user)
    {
        if($request->exists('clear')){
            auth()->user()->products()->detach();
        }

        if ($request->exists('update')) {
            foreach(auth()->user()->products as $product){
            if(!in_array($product->id,$request->products)){
                auth()->user()->products()->detach($product->id);
            }
            }
            foreach($request->products as $index => $product_id){
                auth()->user()->products()->updateExistingPivot($product_id,[
                    'quantity'=> $request->quantity[$index],
                ]);
            }
        }

        return redirect()->back();
    }


    public function destroy($product_id)
    {
            auth()->user()->products()->wherePivot('product_id','=',$product_id)->detach();

        return redirect()->back();
    }
}
