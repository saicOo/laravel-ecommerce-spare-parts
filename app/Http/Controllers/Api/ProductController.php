<?php

namespace App\Http\Controllers\Api;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if(isset($request['term']['term'])){

            $products = Product::with('car')->when($request['term']['term'],function ($query) use ($request){
               return $query->where('name_en','Like','%'.$request['term']['term'].'%')
               ->orWhere('name_ar','Like','%'.$request['term']['term'].'%')
               ->orWhere('id','Like','%'.$request['term']['term'].'%');
           })->limit(10)->get();
           return response()->json($products);
        }
    }

    public function show(Product $product)
    {
        return json_encode($product);
    }
}
