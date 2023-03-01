<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
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
            'price' => $row['price'],
            'stock' => $row['stock'],
            'category_id' => Category::where('name_en','Like','%'.$row['category_id'].'%')->orWhere('name_ar','Like','%'.$row['category_id'].'%')->orWhere('id',$row['category_id'])->pluck('id')->first(),
            'brand_id' => Brand::where('name_en','Like','%'.$row['brand_id'].'%')->orWhere('name_ar','Like','%'.$row['brand_id'].'%')->orWhere('id',$row['brand_id'])->pluck('id')->first(),
        ]);
    }

    public function rules(): array
    {
        return [
            'name_ar' => 'required|string|max:50',
            'name_en' => 'required|string|max:50',
            'description_en' => 'required|max:20000',
            'description_ar' => 'required|max:20000',
            'country' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'purchase_price' => 'required|numeric|max:100000',
            'price' => 'required|numeric|max:100000',
            'stock' => 'required|integer',
        ];
    }
}
