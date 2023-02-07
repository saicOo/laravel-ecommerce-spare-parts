<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\FactoryCar;
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
    public function index()
    {
        $factory_cars = FactoryCar::all();
        return view('dashboard.factory-cars.index', compact('factory_cars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $request->validate([
            'name_ar' => 'required|max:50|unique:factory_cars,name_ar',
            'name_en' => 'required|max:50|unique:factory_cars,name_en',
        ]);
        FactoryCar::create($request->all());
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.factory-cars.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FactoryCar  $factoryCar
     * @return \Illuminate\Http\Response
     */
    public function show(FactoryCar $factoryCar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FactoryCar  $factoryCar
     * @return \Illuminate\Http\Response
     */
    public function edit(FactoryCar $factoryCar)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FactoryCar  $factoryCar
     * @return \Illuminate\Http\Response
     */
    public function destroy(FactoryCar $factoryCar)
    {
        //
    }
}
