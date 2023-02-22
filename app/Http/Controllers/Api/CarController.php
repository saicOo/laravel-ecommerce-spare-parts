<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{

    public function index(Request $request)
    {
        $cars = Car::when($request->factoryCarId,function ($q) use ($request){
            return $q->where('factory_car_id', $request->factoryCarId);
        })->latest('id')->get();
        return json_encode($cars);
    }

    public function show(Car $car)
    {
        return json_encode($car);
    }

}
