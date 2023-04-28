<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderReportController extends Controller
{
    public function index(Request $request)
    {
        if($request->exists('daterange')){
        $request->daterange = explode(" - ",$request->daterange);
           $request->daterange[0] = date('Y-m-d',strtotime($request->daterange[0]));
           $request->daterange[1] = date('Y-m-d',strtotime($request->daterange[1]));
        }
        $reports = Report::when($request->daterange,function ($query) use ($request){
            return $query->whereBetween('created_at',[$request->daterange[0],$request->daterange[1]]);
        })->latest()->paginate(30);
        return view('dashboard.orders.reports.index', compact('reports'));
    }
}
