<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $brands = Brand::all();
        $products = Product::with(['category','brand'])
        ->when($request->search,function ($query) use ($request){ // if search
            return $query->where('name_en','Like','%'.$request->search.'%')->orWhere('name_ar','Like','%'.$request->search.'%');
        })->when($request->max_price,function ($q) use ($request){ // if price
            return $q->whereBetween('price',[$request->min_price,$request->max_price]);
        })->when($request->category_id,function ($q) use ($request){ // if category
            return $q->where('category_id', $request->category_id);
        })->when($request->brand_id,function ($q) use ($request){ // if brand
            return $q->whereIn('brand_id', json_decode($request->brand_id));
        })->latest()->paginate(12);
        return view('front.products.index', compact('products','brands'));
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // DB::table('users')
        //    ->whereFullText('bio', 'web developer')
        //    ->get();
        $products_silder = Product::inRandomOrder()->limit(6)->get();
        return view('front.products.show', compact('product','products_silder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
