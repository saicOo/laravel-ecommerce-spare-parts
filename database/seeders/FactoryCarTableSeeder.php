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
        $cars_en = ['BMW','Audi','Honda','MG'];
        $cars_ar = ['بي ام دبليو','اودي','هوندا','ام جي'];
        for ($i=0; $i < 3; $i++) {
            FactoryCar::create([
                'name_en' => $cars_en[$i],
                'name_ar' => $cars_ar[$i],
            ]);
        }
    }
}
