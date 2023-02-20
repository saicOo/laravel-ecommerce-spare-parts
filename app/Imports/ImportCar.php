<?php

namespace App\Imports;

use App\Models\Car;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportCar implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Car([
            'name_ar' => $row[0],
            'name_en' => $row[1],
            'start_year' => $row[2],
            'end_year' => $row[3],
            'factory_car_id' => $row[4],
        ]);
    }
}
