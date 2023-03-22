<?php

namespace App\Exports;

use App\Models\Purchase;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportPurchase implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Purchase::select('invoice_no','total_price','payment_type','amount_paid','payment_status','supplier_id','created_at')->get();
    }

    public function map($purchases) : array {

        return [
            $purchases->invoice_no,
            $purchases->total_price,
            $purchases->payment_type,
            $purchases->amount_paid,
            $purchases->status,
            $purchases->supplier->name,
            $purchases->created_at->format('M d, Y'),
        ] ;


    }

    public function headings(): array
    {
        return ["invoice no","total price","invoice type","amount paid","payment status","supplier name","created at"];
    }
}
