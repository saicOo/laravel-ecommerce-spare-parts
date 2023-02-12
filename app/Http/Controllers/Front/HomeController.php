<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }
    public function index(){
        $categories = Category::where('category_type','sub_category')->inRandomOrder()->limit(5)->with('products')->get();
        return view('front.index',compact('categories'));
    }
}
