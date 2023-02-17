<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(SettingTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(BrandTableSeeder::class);
        $this->call(FactoryCarTableSeeder::class);
        $this->call(CarTableSeeder::class);
        $this->call(ProductTableSeeder::class);
    }
}
