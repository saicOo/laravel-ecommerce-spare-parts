<?php

namespace App\Http\Controllers\Dashboard;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');

    }

    public function index(){

        //----------
        //-- Monthly sales and purchases data stats
        //----------
        $sales_amount_paid = Order::select(
            \DB::raw('SUM(total_price) as subtotal'),
            \DB::raw("EXTRACT(YEAR FROM `created_at`) as year"),
            \DB::raw("EXTRACT(MONTH FROM `created_at`) as month")
          )->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])
          ->groupBy('month', 'year')->where('payment_status',1)->get();
        $sales_amount_unpaid = Order::select(
            \DB::raw('SUM(total_price) as subtotal'),
            \DB::raw("EXTRACT(YEAR FROM `created_at`) as year"),
            \DB::raw("EXTRACT(MONTH FROM `created_at`) as month")
          )->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])
          ->groupBy('month', 'year')->where('payment_status',3)->get();

        $total_sales = Order::where('payment_status',1)->sum('total_price');
        $orders_count = Order::count();
        $categories_count = Category::count();
        $brands_count = Brand::count();
        $products_count = Product::count();
        $clients_count = User::count();
        $admins_count = Admin::count();
        return view('dashboard.index',compact('admins_count','clients_count','products_count'
        ,'categories_count','orders_count','total_sales','brands_count','sales_amount_paid','sales_amount_unpaid'));
    }
}
