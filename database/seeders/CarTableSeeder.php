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
        $faker = Factory::create();
        for ($i=0; $i < 20; $i++) {
            Car::create([
                'name_en' => $faker->sentence(1),
                'name_ar' => $faker->sentence(1),
                'start_year' => 2000,
                'end_year' => 2020,
                'factory_car_id' => FactoryCar::inRandomOrder()->first()->id,
            ]);
        }
    }
}
