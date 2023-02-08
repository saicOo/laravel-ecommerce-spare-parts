<?php

namespace Database\Seeders;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = $this->permissions();
        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                // 'display_name_en' => $permission['display_name_en'],
                // 'display_name_ar' => $permission['display_name_ar'],
            ]);
        }
    }

    private function permissions()
    {
        $permissions = [];
        $maps = ['create','read','update','delete'];
        $models = ['admins','users','orders','categories','products','brands','cars'];
        foreach($models as $model){
            foreach($maps as $map){
                $permissions[] = $map . '_' . $model;
            }
        }
        return $permissions;
    }
}
