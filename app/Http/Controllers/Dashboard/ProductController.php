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
// Exel Product
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportProduct;
use App\Exports\ExportProduct;
// ./
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');

    }

    public function index(Request $request)
    {
        $this->authorize('check-permissions', 'read_products');

        $primary_categories = Category::where('category_type','primary_category')->with('subCategories')->get();
        $products = Product::with('category')->when($request->search,function ($query) use ($request){
            return $query->where('name_en','Like','%'.$request->search.'%')->orWhere('name_ar','Like','%'.$request->search.'%');
        })->when($request->category_id,function ($q) use ($request){
            return $q->where('category_id', $request->category_id);
        })->latest()->paginate(10);
        return view('dashboard.products.index', compact('products','primary_categories'));
    }


    public function create()
    {
        $this->authorize('check-permissions', 'create_products');

        $primary_categories = Category::where('category_type','primary_category')->with('subCategories')->get();
        $brands = Brand::all();
        $factory_cars = FactoryCar::all();
        return view('dashboard.products.create',compact('primary_categories','brands','factory_cars'));
    }


    public function store(Request $request)
    {
        $this->authorize('check-permissions', 'create_products');

        $rules= [
            'name_en' => 'required|max:50',
            'name_ar' => 'required|max:50',
            'description_en' => 'required|max:20000',
            'description_ar' => 'required|max:20000',
            'country' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'purchase_price' => 'required|numeric|max:100000',
            'price' => 'required|numeric|max:100000',
            'stock' => 'required|integer',
            'images' => 'array|max:4',
            'images.*' => 'image|mimes:jpg,png,jpeg,gif,svg',
        ];
        if(isset($request->car_id) || isset($request->start_year) || isset($request->end_year)){
            $rules += [
                'car_id' => 'required',
                'start_year' => 'required|digits:4|integer|min:1900|max:'.$request->end_year,
                'end_year' => 'required|digits:4|integer|min:1900'
            ];
        }
        $request->validate($rules);

    $request_data = $request->all();
    if($request->images){
        $images = [];
        foreach($request->images as $image){
            $imageName = Str::random(20) . uniqid()  . '.webp';
                Image::make($image)->encode('webp', 65)->resize(600, null, function ($constraint) {
                    $constraint->aspectRatio();
                    })->save(public_path('uploads/products/'.$imageName));
                    array_push($images, $imageName);
        }
        $request_data['images']  = $images;
    }

            Product::create($request_data);
            session()->flash('success', __('site.added_successfully'));
            return redirect()->route('dashboard.products.index');
    }


    public function show(Product $product)
    {
        $this->authorize('check-permissions', 'read_products');

        return view('dashboard.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $this->authorize('check-permissions', 'update_products');

        $primary_categories = Category::where('category_type','primary_category')->with('subCategories')->get();
        $brands = Brand::all();
        $factory_cars = FactoryCar::all();
        return view('dashboard.products.edit', compact('product','primary_categories','brands','factory_cars'));
    }


    public function update(Request $request, Product $product)
    {
        $this->authorize('check-permissions', 'update_products');

        $rules= [
            'name_en' => 'required|max:50',
            'name_ar' => 'required|max:50',
            'description_en' => 'required|max:20000',
            'description_ar' => 'required|max:20000',
            'country' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'purchase_price' => 'required|numeric|max:100000',
            'price' => 'required|numeric|max:100000',
            'stock' => 'required|integer',
            'images' => 'array|max:4',
            'images.*' => 'image|mimes:jpg,png,jpeg,gif,svg',
        ];
        if(isset($request->car_id) || isset($request->start_year) || isset($request->end_year)){
            $rules += [
                'car_id' => 'required',
                'start_year' => 'required|digits:4|integer|min:1900|max:'.$request->end_year,
                'end_year' => 'required|digits:4|integer|min:1900'
            ];
        }
        $request->validate($rules);
        $request_data = $request->all();
    if ($request->images) {
    $images = [];
    foreach($product->images as $imageName){
        if($imageName != "default.png"){
            File::delete(public_path('uploads/products/'.$imageName));
        }
    }
    foreach($request->images as $image){
        $imageName = Str::random(20) . uniqid()  . '.webp';
            Image::make($image)->encode('webp', 65)->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
                })->save(public_path('uploads/products/'.$imageName));
                array_push($images, $imageName);
    }
    $request_data['images']  = $images;
    }
    $product->update($request_data);
            session()->flash('success', __('site.added_successfully'));
            return redirect()->route('dashboard.products.index');
    }


    public function destroy($test,Request $request)
    {
        $this->authorize('check-permissions', 'delete_products');

        $products_arr = explode(",",$request->mass_delete);
        $products = Product::whereIn('id', $products_arr);
        $images_arr = $products->pluck('images')->toArray();
        foreach($images_arr as $image_arr){
            foreach($image_arr as $imageName){
                    if($imageName != "default.png"){
                        File::delete(public_path('uploads/products/'.$imageName));
                    }
                }
        }
        $products->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.products.index');
    }

    public function import(Request $request){
        $this->authorize('check-permissions', 'create_products');

        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);
        Excel::import(new ImportProduct,
                      $request->file('file')->store('files'));
        return redirect()->back();
    }

    public function exportProducts(Request $request){
        $this->authorize('check-permissions', 'create_products');

        return Excel::download(new ExportProduct, 'products.xlsx');
    }
}
