<?php

namespace App\Imports;

use App\Models\Car;
use App\Models\FactoryCar;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportCar implements ToModel, WithValidation,WithHeadingRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Car([
            'name_ar' => $row['name_ar'],
            'name_en' => $row['name_en'],
            'start_year' => $row['start_year'],
            'end_year' => $row['end_year'],
            'factory_car_id' => FactoryCar::where('name_en','Like','%'.$row['factory_car'].'%')->orWhere('name_ar','Like','%'.$row['factory_car'].'%')->orWhere('id',$row['factory_car'])->pluck('id')->first(),
        ]);
    }

    public function rules(): array
    {
        return [
            'name_ar' => 'required|string|max:50',
            'name_en' => 'required|string|max:50',
            'start_year' => 'required|digits:4|integer',
            'end_year' => 'required|digits:4|integer',
            'factory_car' => 'required',
        ];
    }
}
