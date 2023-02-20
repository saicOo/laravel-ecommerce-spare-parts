<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportProduct implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'name_ar' => $row[0],
            'name_en' => $row[1],
            'description_en' => $row[2],
            'description_ar' => $row[3],
            'country' => $row[4],
            'price' => $row[5],
            'stock' => $row[6],
            'category_id' => $row[7],
            'brand_id' => $row[8],
            'car_id' => $row[9],
            'start_year' => $row[10],
            'end_year' => $row[11],
        ]);
    }
}
