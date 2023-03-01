<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportProduct implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::select('name_ar','name_en','description_en','description_ar','country','purchase_price','price','stock','category_id','brand_id')->get();
    }

    public function map($products) : array {
        return [
            $products->name_ar,
            $products->name_en,
            $products->description_en,
            $products->description_ar,
            $products->country,
            $products->purchase_price,
            $products->price,
            $products->stock,
            $products->category->name_en,
            $products->brand->name_en,
        ] ;


    }

    public function headings(): array
    {
        return ["name_ar", "name_en","description_en","description_ar","country","purchase_price","price","stock","category_id","brand_id"];
    }

}
