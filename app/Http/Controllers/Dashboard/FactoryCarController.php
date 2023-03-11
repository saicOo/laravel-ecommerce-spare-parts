<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\FactoryCar;
// Exel Factory Car
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportFactoryCar;
use App\Exports\ExportFactoryCar;
// ./
use Illuminate\Http\Request;

class FactoryCarController extends Controller
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
        $this->authorize('check-permissions', 'read_cars');
        $factory_cars = FactoryCar::when($request->search,function ($query) use ($request){
            return $query->where('name_en','Like','%'.$request->search.'%')->orWhere('name_ar','Like','%'.$request->search.'%');
        })->latest('id')->paginate(10);
        return view('dashboard.factory-cars.index', compact('factory_cars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('check-permissions', 'create_cars');
        return view('dashboard.factory-cars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('check-permissions', 'create_cars');
        $request->validate([
            'name_ar' => 'required|string|max:50|unique:factory_cars,name_ar',
            'name_en' => 'required|string|max:50|unique:factory_cars,name_en',
        ]);
        FactoryCar::create($request->all());
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.factory-cars.index');
    }

    public function edit(FactoryCar $factoryCar)
    {
        $this->authorize('check-permissions', 'update_cars');
        return view('dashboard.factory-cars.edit',compact('factoryCar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FactoryCar  $factoryCar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FactoryCar $factoryCar)
    {
        $this->authorize('check-permissions', 'update_cars');
        $request->validate([
            'name_ar' => 'required|string|max:50|unique:factory_cars,name_ar,' . $factoryCar->id,
            'name_en' => 'required|string|max:50|unique:factory_cars,name_en,' . $factoryCar->id,
        ]);
        $factoryCar->update($request->all());
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.factory-cars.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FactoryCar  $factoryCar
     * @return \Illuminate\Http\Response
     */
    public function destroy($test,Request $request)
    {
        $this->authorize('check-permissions', 'delete_cars');
        $factoryCars_arr = explode(",",$request->mass_delete);
        $factoryCars_in = FactoryCar::whereIn('id', $factoryCars_arr);
        $factoryCars = $factoryCars_in->with('cars')->get();
        foreach($factoryCars as $factoryCar){
            if(isset($factoryCar->cars[0])){
                return redirect()->back()->withErrors(__('site.cannot_delete'));
            }else{
                $factoryCar->delete();
            }
        }
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.factory-cars.index');
    }

    public function import(Request $request){
        $this->authorize('check-permissions', 'create_cars');
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);
        Excel::import(new ImportFactoryCar,
                    $request->file('file')->store('files'));
        return redirect()->back();
    }

    public function exportfactoryCars(Request $request){
        $this->authorize('check-permissions', 'create_cars');
        return Excel::download(new ExportFactoryCar, 'factoryCars.xlsx');
    }

}
