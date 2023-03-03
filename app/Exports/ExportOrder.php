<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportOrder implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Order::select('invoice_no','total_price','user_id','created_at')->get();
    }

    public function map($orders) : array {
        return [
            $orders->invoice_no,
            $orders->total_price,
            $orders->user->email,
            $orders->created_at->format('M d, Y'),
        ] ;


    }

    public function headings(): array
    {
        return ["invoice no","total price","user name","created at"];
    }
}
