<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportCategory implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $categories = Category::all();
        return $categories->makeHidden(['id']);
    }

    public function map($categories) : array {
        return [
            $categories->name_ar,
            $categories->name_en,
        ] ;
    }

    public function headings(): array
    {
        return ["name_ar", "name_en"];
    }
}
