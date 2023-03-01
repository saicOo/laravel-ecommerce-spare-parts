<?php

namespace App\Exports;

use App\Models\FactoryCar;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportFactoryCar implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $factoryCars = FactoryCar::all();
        return $factoryCars->makeHidden(['id']);
    }

    public function map($factoryCars) : array {
        return [
            $factoryCars->name_ar,
            $factoryCars->name_en,
        ] ;
    }

    public function headings(): array
    {
        return ["name_ar", "name_en"];
    }
}
