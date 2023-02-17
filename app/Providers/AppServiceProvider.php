<?php

namespace App\Providers;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $setting =  \App\Models\Setting::first();
        $primary_categories = Category::where('category_type','primary_category')->with('subCategories')->get();
        View::share('primary_categories', $primary_categories);
        View::share('setting', $setting);
    }
}
