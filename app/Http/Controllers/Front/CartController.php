<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
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
        $setting = Setting::first();
        $products_silder = Product::inRandomOrder()->limit(6)->get();
        $products = auth()->user()->products;
        $sub_total = auth()->user()->products()->sum(\DB::raw('products.price * product_user.quantity'));
        $tax_amount = $sub_total * ($setting->tax / 100);
        $total_price = $sub_total + $tax_amount + $setting->shipping;
        return view('front.cart.index',compact('products','tax_amount','sub_total','total_price','products_silder'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' =>Rule::unique('product_user')->where(function ($query) use ($request) {
                return $query->where('product_id', $request->product_id)
                   ->where('user_id', auth()->user()->id);
             })
        ]);
        auth()->user()->products()->attach($request->product_id,['quantity' => $request->quantity]);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->back();
    }

    public function update(Request $request,User $user)
    {
        $products = $request->products ? $request->products : [];
        if($request->exists('clear')){
            auth()->user()->products()->detach();
        }

        if ($request->exists('update')) {
            foreach(auth()->user()->products as $product){
            if(!in_array($product->id,$products)){
                auth()->user()->products()->detach($product->id);
            }
            }
            foreach($products as $index => $product_id){
                auth()->user()->products()->updateExistingPivot($product_id,[
                    'quantity'=> $request->quantity[$index],
                ]);
            }
        }

        return redirect()->back();
    }

}
