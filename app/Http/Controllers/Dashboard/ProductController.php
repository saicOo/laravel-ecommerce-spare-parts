<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\FactoryCar;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::with('category')->when($request->search,function ($query) use ($request){
            return $query->where('name_en','Like','%'.$request->search.'%')->orWhere('name_ar','Like','%'.$request->search.'%');
        })->when($request->category_id,function ($q) use ($request){
            return $q->where('category_id', $request->category_id);
        })->latest()->paginate(10);
        return view('dashboard.products.index', compact('products','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $primary_categories = Category::where('category_type','primary_category')->with('subCategories')->get();
        $brands = Brand::all();
        $factory_cars = FactoryCar::all();
        return view('dashboard.products.create',compact('primary_categories','brands','factory_cars'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules= [
            'name_en' => 'required|max:50',
            'name_ar' => 'required|max:50',
            'description_en' => 'required|max:20000',
            'description_ar' => 'required|max:20000',
            'country' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'price' => 'required|numeric|max:100000',
            'stock' => 'required|integer',
            'image' => 'required|array|min:4|max:4',
            'image.*' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
        ];
        if(isset($request->car_id) || isset($request->start_year) || isset($request->end_year)){
            $rules += [
                'car_id' => 'required',
                'start_year' => 'required',
                'end_year' => 'required',
            ];
        }
        $request->validate($rules);

    $request_data = $request->all();
    $images = [];
    foreach($request->image as $image){

        $imageName = Str::random(20) . uniqid()  . '.webp';
            Image::make($image)->encode('webp', 65)->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
                })->save(public_path('uploads/products/'.$imageName));
                array_push($images, $imageName);
    }
    $request_data['image']  = $images;
            Product::create($request_data);
            session()->flash('success', __('site.added_successfully'));
            return redirect()->route('dashboard.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {

        return view('dashboard.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $primary_categories = Category::where('category_type','primary_category')->with('subCategories')->get();
        $brands = Brand::all();
        $factory_cars = FactoryCar::all();
        return view('dashboard.products.edit', compact('product','primary_categories','brands','factory_cars'));
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
        $rules= [
            'name_en' => 'required|max:50',
            'name_ar' => 'required|max:50',
            'description_en' => 'required|max:20000',
            'description_ar' => 'required|max:20000',
            'country' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'price' => 'required|numeric|max:100000',
            'stock' => 'required|integer',
        ];
        if(isset($request->image)){
            $rules += [
                'image' => 'required|array|min:4|max:4',
                'image.*' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
            ];
        }
        if(isset($request->car_id) || isset($request->start_year) || isset($request->end_year)){
            $rules += [
                'car_id' => 'required',
                'start_year' => 'required',
                'end_year' => 'required',
            ];
        }
        $request->validate($rules);
        $request_data = $request->all();
    if ($request->image) {
    $images = [];
    foreach($product->image as $imageName){
        File::delete(public_path('uploads/products/'.$imageName));
    }
    foreach($request->image as $image){
        $imageName = Str::random(20) . uniqid()  . '.webp';
            Image::make($image)->encode('webp', 65)->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
                })->save(public_path('uploads/products/'.$imageName));
                array_push($images, $imageName);
    }
    $request_data['image']  = $images;
    }
    $product->update($request_data);
            session()->flash('success', __('site.added_successfully'));
            return redirect()->route('dashboard.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($product,Request $request)
    {
        $products_arr = explode(",",$request->mass_delete);
        $products = Product::whereIn('id', $products_arr);
        foreach($products->select('image')->get() as $product_images){
                if($product_images->image){
                foreach($product_images->image as $imageName){
                    File::delete(public_path('uploads/products/'.$imageName));
                }
            }
        }
        $products->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.products.index');
    }
}
