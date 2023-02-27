<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Supplier::create([
            'name' => 'مورد 1',
            'phone' => '01854689752',
        ]);
        \App\Models\Supplier::create([
            'name' => 'مورد 2',
            'phone' => '01954689752',
        ]);
    }
}
