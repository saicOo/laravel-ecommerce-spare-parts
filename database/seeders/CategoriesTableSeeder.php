<?php

namespace Database\Seeders;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // create primary categories
        $primary_categories = $this->primary_categories();
        foreach ($primary_categories as $category) {
            Category::create([
                'name_en' => $category['name_en'],
                'name_ar' => $category['name_ar'],
                'category_type' => $category['category_type'],
            ]);
        }

        // create sub categories
        $sub_categories = $this->sub_categories();
        foreach ($sub_categories as $category) {
            Category::create([
                'name_en' => $category['name_en'],
                'name_ar' => $category['name_ar'],
                'category_type' => $category['category_type'],
                'category_id' => $category['category_id'],
            ]);
        }
    }

    private function primary_categories()
    {
            $primary_categories = [
                [
                'name_en' => 'Motor parts',
                'name_ar' => 'اجزاء الموتور',
                'category_type' => 'primary_category',
            ],
                [
                'name_en' => 'Luggage parts',
                'name_ar' => 'اجزاء العفشة',
                'category_type' => 'primary_category',
            ]
        ];
        return $primary_categories;
    }

    private function sub_categories()
    {
            $sub_categories = [
                [
                'name_en' => 'Sababat',
                'name_ar' => 'صبابات',
                'category_type' => 'sub_category',
                'category_id' => 1,
            ],
                [
                'name_en' => 'Walks',
                'name_ar' => 'سيور',
                'category_type' => 'sub_category',
                'category_id' => 1,
            ],
                [
                'name_en' => 'Grinding',
                'name_ar' => 'بطاحات',
                'category_type' => 'sub_category',
                'category_id' => 2,
            ]
        ];
        return $sub_categories;
    }
}
