<?php

namespace App\Imports;

use App\Models\Car;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportProduct implements ToModel, WithValidation,WithHeadingRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'name_ar' => $row['name_ar'],
            'name_en' => $row['name_en'],
            'description_en' => $row['description_en'],
            'description_ar' => $row['description_ar'],
            'country' => $row['country'],
            'purchase_price' => $row['purchase_price'],
            'price' => $row['sale_price'],
            'stock' => $row['stock'],
            'category_id' => Category::where('name_en','Like','%'.$row['category'].'%')->orWhere('name_ar','Like','%'.$row['category'].'%')->orWhere('id',$row['category'])->pluck('id')->first(),
            'brand_id' => Brand::where('name_en','Like','%'.$row['brand'].'%')->orWhere('name_ar','Like','%'.$row['brand'].'%')->orWhere('id',$row['brand'])->pluck('id')->first(),
            'car_id' => Car::where('name_en','Like','%'.$row['car'].'%')->orWhere('name_ar','Like','%'.$row['car'].'%')->orWhere('id',$row['car'])->pluck('id')->first(),
        ]);
        // ["name ar", "name en","purchase price","sale price","stock","country","category","brand","car","description en","description ar"]
    }

    public function rules(): array
    {
        return [
            'name_ar' => 'required|string|max:50',
            'name_en' => 'required|string|max:50',
            'description_en' => 'required|max:20000',
            'description_ar' => 'required|max:20000',
            'country' => 'required',
            'category' => 'required|exists:categories,name_en',
            'brand' => 'required|exists:brands,name_en',
            'car' => 'nullable|exists:cars,name_en',
            'purchase_price' => 'required|numeric|max:100000',
            'sale_price' => 'required|numeric|max:100000',
            'stock' => 'required|integer',
        ];
    }
}
