<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
// Exel Category
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportCategory;
use App\Exports\ExportCategory;
// ./
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        $this->authorize('check-permissions', 'read_categories');
        $categories = Category::with('subCategories')->when($request->search,function ($query) use ($request){
            return $query->where('name_en','Like','%'.$request->search.'%')->orWhere('name_ar','Like','%'.$request->search.'%');
        })->latest('id')->paginate(10);
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('check-permissions', 'create_categories');
        $primary_categories = Category::where('category_type','primary_category')->get();
        return view('dashboard.categories.create',compact('primary_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('check-permissions', 'create_categories');
        $rules = [
            'name_ar' => 'required|max:50|unique:categories,name_ar',
            'name_en' => 'required|max:50|unique:categories,name_en',
            'category_type' => 'required|in:sub_category,primary_category',
        ];
        if($request->category_type === 'sub_category'){
            $rules += ['category_id' => 'required',];
            $request_data = $request->all();
        }else{
            $request_data = $request->except(['category_id']);
        }
        $request->validate($rules);
        Category::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.categories.index');
    }

    public function edit(Category $category)
    {
        $this->authorize('check-permissions', 'update_categories');
        $primary_categories = Category::where('category_type','primary_category')->get();
        return view('dashboard.categories.edit',compact('category','primary_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->authorize('check-permissions', 'update_categories');
        $request->validate([
            'name_ar' => 'required|max:50|unique:categories,name_ar,' . $category->id,
            'name_en' => 'required|max:50|unique:categories,name_ar,' . $category->id,
        ]);
        $category->update($request->all());
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($test,Request $request)
    {
        $this->authorize('check-permissions', 'delete_categories');
        $categories_arr = explode(",",$request->mass_delete);
        $categories_in = Category::whereIn('id', $categories_arr);
        $categories = $categories_in->with(['subCategories','products'])->get();
        foreach($categories as $category){
            if(isset($category->subCategories[0]) || isset($category->products[0])){
                return redirect()->back()->withErrors(__('site.cannot_delete'));
            }else{
                    $category->delete();
            }
        }
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.categories.index');
    }


    public function import(Request $request){
        $this->authorize('check-permissions', 'create_categories');
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);
        Excel::import(new ImportCategory,
                    $request->file('file')->store('files'));
        return redirect()->back();
    }

    public function exportCategories(Request $request){
        $this->authorize('check-permissions', 'create_categories');
        return Excel::download(new ExportCategory, 'categories.xlsx');
    }
}
