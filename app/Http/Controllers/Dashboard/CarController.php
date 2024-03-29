<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\FactoryCar;
// Exel Car
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportCar;
use App\Exports\ExportCar;
// ./
use Illuminate\Http\Request;

class CarController extends Controller
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
        $factoryCars = FactoryCar::all();
        $cars = Car::with('FactoryCar')->when($request->search,function ($query) use ($request){
            return $query->where('name_en','Like','%'.$request->search.'%')->orWhere('name_ar','Like','%'.$request->search.'%');
        })->when($request->factory_car_id,function ($q) use ($request){
            return $q->where('factory_car_id', $request->factory_car_id);
        })->latest('id')->paginate(10);
        return view('dashboard.cars.index', compact('cars','factoryCars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('check-permissions', 'create_cars');
        $factory_cars = FactoryCar::all();
        return view('dashboard.cars.create',compact('factory_cars'));
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
            'name_ar' => 'required|max:50',
            'name_en' => 'required|max:50',
            'start_year' => 'required|digits:4|integer|min:1900|max:'.$request->end_year,
            'end_year' => 'required|digits:4|integer|min:1900|max:'.date("Y"),
        ]);
        Car::create($request->all());
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.cars.index');
    }

    public function edit(Car $car)
    {
        $this->authorize('check-permissions', 'update_cars');

        $factory_cars = FactoryCar::all();
        return view('dashboard.cars.edit',compact('factory_cars','car'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        $this->authorize('check-permissions', 'update_cars');

        $request->validate([
            'name_ar' => 'required|max:50',
            'name_en' => 'required|max:50',
            'start_year' => 'required|digits:4|integer|min:1900|max:'.$request->end_year,
            'end_year' => 'required|digits:4|integer|min:1900|max:'.date("Y"),
        ]);
        $car->update($request->all());
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.cars.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy($test,Request $request)
    {
        $this->authorize('check-permissions', 'delete_cars');
        $cars_arr = explode(",",$request->mass_delete);
        $cars_in = Car::whereIn('id', $cars_arr);
        $cars = $cars_in->with('products')->get();
        foreach($cars as $car){
            if(isset($car->products[0])){
                return redirect()->back()->withErrors(__('site.cannot_delete'));
            }else{
                $car->delete();
            }
        }
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.cars.index');
    }

    public function import(Request $request){
        $this->authorize('check-permissions', 'create_cars');
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);
        Excel::import(new ImportCar,
                    $request->file('file')->store('files'));
        return redirect()->back();
    }

    public function exportCars(Request $request){
        $this->authorize('check-permissions', 'create_cars');
        return Excel::download(new ExportCar, 'cars.xlsx');
    }
}
