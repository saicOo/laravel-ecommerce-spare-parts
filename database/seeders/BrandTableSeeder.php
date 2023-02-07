<?php

namespace Database\Seeders;
use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands_en = ['Continental AG','Denso','Goodyear','3M'];
        $brands_ar = ['كونتيننتال إيه جي','دينسو','جوديير','ثري إم'];
        for ($i=0; $i < 3; $i++) {
            Brand::create([
                'name_en' => $brands_en[$i],
                'name_ar' => $brands_ar[$i],
            ]);
        }
    }
}
