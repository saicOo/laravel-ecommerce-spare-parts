<?php

namespace App\Exports;

use App\Models\Car;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportCar implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $cars = Car::all();
        return $cars->makeHidden(['id']);
    }

    public function map($cars) : array {
        return [
            $cars->name_ar,
            $cars->name_en,
            $cars->start_year,
            $cars->end_year,
            $cars->factoryCar->name_en,
        ] ;
    }

    public function headings(): array
    {
        return ["name_ar", "name_en","start_year","end_year","factory_car"];
    }
}
