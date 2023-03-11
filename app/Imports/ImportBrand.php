<?php

namespace App\Imports;

use App\Models\Brand;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportBrand implements ToModel, WithValidation,WithHeadingRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Brand([
            'name_ar' => $row['name_ar'],
            'name_en' => $row['name_en'],
        ]);
    }

    public function rules(): array
    {
        return [
            'name_ar' => 'required|string|max:50|unique:brands,name_ar',
            'name_en' => 'required|string|max:50|unique:brands,name_en',
        ];
    }
}
