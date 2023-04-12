<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\FactoryCar;
use App\Models\Car;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request)
    {

        $brands = Brand::all();
        $factoryCars = FactoryCar::all();
        $products = Product::with(['category','brand'])
        ->when($request->search,function ($query) use ($request){ // if search
            return $query->where('name_en','Like','%'.$request->search.'%')->OrWhere('name_ar','Like','%'.$request->search.'%');
        })->when($request->car_id,function ($query) use ($request){ // if car
            return $query->whereHas('car', function ($query) use ($request) {
                $query->where('id',$request->car_id)->where('start_year','<=',$request->year)->where('end_year','>=',$request->year);
            });
        })->when($request->max_price,function ($q) use ($request){ // if price
            return $q->whereBetween('price',[$request->min_price,$request->max_price]);
        })->when($request->category_id,function ($q) use ($request){ // if category
            return $q->where('category_id', $request->category_id);
        })->when($request->brand_id,function ($q) use ($request){ // if brand
            return $q->whereIn('brand_id', json_decode($request->brand_id));
        })->latest()->paginate(12);
        return view('front.products.index', compact('products','brands','factoryCars'));
    }

    public function show(Product $product)
    {
        $products_silder = Product::inRandomOrder()->limit(6)->get();
        return view('front.products.show', compact('product','products_silder'));
    }
    public function getCarYearsAjax(Request $request)
    {
        $data['years'] = Car::where('factory_car_id',$request->factoryCarId)->get();
    return json_encode($data);
    }


}
