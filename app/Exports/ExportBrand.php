<?php

namespace App\Exports;

use App\Models\Brand;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportBrand implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $brands = Brand::all();
        return $brands->makeHidden(['id']);
    }

    public function map($brands) : array {
        return [
            $brands->name_ar,
            $brands->name_en,
        ] ;
    }

    public function headings(): array
    {
        return ["name_ar", "name_en"];
    }
}
