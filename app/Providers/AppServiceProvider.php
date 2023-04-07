<?php

namespace App\Providers;
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
        try {
            if(\App\Models\Report::whereDate('created_at',date('Y-m-d'))->doesntExist()){
            \App\Models\Report::create([
                'orders_amount'=> 0,
                'orders_count'=> 0,
                'purchases_amount'=> 0,
                'purchases_count'=> 0,
            ]);
        }

        $setting =  \App\Models\Setting::first();
        $primary_categories = \App\Models\Category::where('category_type','primary_category')->with('subCategories')->get();
        View::share('primary_categories', $primary_categories);
        View::share('setting', $setting);
        } catch (\Throwable $th) {
            
        }

    }
}
