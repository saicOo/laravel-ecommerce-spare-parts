<?php

namespace App\Exports;

use App\Models\FactoryCar;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportFactoryCar implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return FactoryCar::all();
    }
}
