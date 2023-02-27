<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Product;
use App\Models\Category;
use App\Models\Car;
use App\Models\Brand;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $country = ['japan','china','germany'];

        for ($i=0; $i < 30; $i++) {
            Product::create([
                'name_en' => $faker->sentence(2),
                'name_ar' => $faker->sentence(2),
                'description_en' => $faker->sentence(20),
                'description_ar' => $faker->sentence(20),
                'price' => rand(50,800),
                'purchase_price' => rand(20,500),
                'stock' => rand(20,200),
                'country' => $country[rand(0,2)],
                'start_year' => 2000,
                'end_year' => 2020,
                'category_id' => Category::where('category_type','sub_category')->inRandomOrder()->first()->id,
                'brand_id' => Brand::inRandomOrder()->first()->id,
                'car_id' => Car::inRandomOrder()->first()->id,
            ]);
        }

    }
}
