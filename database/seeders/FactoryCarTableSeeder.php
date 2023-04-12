<?php

namespace Database\Seeders;
use App\Models\FactoryCar;
use Illuminate\Database\Seeder;

class FactoryCarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $cars_en = ['Hyundai','Kia'];
        $cars_ar = ['هيونداى','كيا'];
        foreach ($cars_en as $i => $car_en) {
            FactoryCar::create([
                'name_en' => $cars_en[$i],
                'name_ar' => $cars_ar[$i],
            ]);
        }

    }
}
