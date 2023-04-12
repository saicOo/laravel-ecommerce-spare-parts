<?php

namespace Database\Seeders;
use Faker\Factory;
use App\Models\Car;
use App\Models\FactoryCar;
use Illuminate\Database\Seeder;

class CarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // $faker = Factory::create();
        $carsHyundaiAr = ['اكسنت اتش سي','اكسنت بي ان 7','الينترا سي ان 7','كريتا'];
        $carsHyundaiEn = ['Accent HC','Accent BN7','Elantra CN7','Creta'];
        $carsStartYear = [1994,1994,2020,1994,2014];
        $carsEndYear = [2017,2023,2023,2017,2019];
        foreach ($carsHyundaiAr as $i => $carHyundaiAr) {
            Car::create([
                'name_en' => $carsHyundaiEn[$i],
                'name_ar' => $carsHyundaiAr[$i],
                'start_year' => $carsStartYear[$i],
                'end_year' => $carsEndYear[$i],
                'factory_car_id' => 1,
            ]);
        }

        // Car::create([
        //     'name_en' => $faker->sentence(1),
        //     'name_ar' => $faker->sentence(1),
        //     'start_year' => 2000,
        //     'end_year' => 2020,
        //     'factory_car_id' => FactoryCar::inRandomOrder()->first()->id,
        // ]);
    }
}
