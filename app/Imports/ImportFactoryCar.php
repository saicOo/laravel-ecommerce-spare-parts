<?php

namespace App\Imports;

use App\Models\FactoryCar;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportFactoryCar implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new FactoryCar([
            'name_ar' => $row[0],
            'name_en' => $row[1],
        ]);
    }
}
