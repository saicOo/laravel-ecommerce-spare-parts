<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Brand;
// Exel Brand
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportBrand;
use App\Exports\ExportBrand;
// ./
use Illuminate\Http\Request;

class BrandController extends Controller
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
        $brands = Brand::when($request->search,function ($query) use ($request){
            return $query->where('name_en','Like','%'.$request->search.'%')->orWhere('name_ar','Like','%'.$request->search.'%');
        })->latest('id')->paginate(10);
        return view('dashboard.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required|max:50|unique:brands,name_ar',
            'name_en' => 'required|max:50|unique:brands,name_en',
        ]);
        Brand::create($request->all());
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.brands.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('dashboard.brands.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name_ar' => 'required|max:50|unique:brands,name_ar,' . $brand->id,
            'name_en' => 'required|max:50|unique:brands,name_en,' . $brand->id,
        ]);
        $brand->update($request->all());
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.brands.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($test,Request $request)
    {
        $brands_arr = explode(",",$request->mass_delete);
        $brands_in = Brand::whereIn('id', $brands_arr);
        $brands = $brands_in->with('products')->get();
        foreach($brands as $brand){
            if(isset($brand->products[0])){
                return redirect()->back()->withErrors(__('site.cannot_delete'));
            }else{
                $brand->delete();
            }
        }
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.brands.index');
    }

    public function import(Request $request){
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);
        Excel::import(new ImportBrand,
                    $request->file('file')->store('files'));
        return redirect()->back();
    }

    public function exportBrands(Request $request){
        return Excel::download(new ExportBrand, 'brands.xlsx');
    }

}
