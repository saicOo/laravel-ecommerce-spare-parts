<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \App\Models\Admin::create([
            'name' => 'admin',
            'email' => 'admin@app.com',
            'role' => 'suber_admin',
            'phone' => '01157012640',
            'password' => bcrypt('123456789'),
        ]);
    }
}
