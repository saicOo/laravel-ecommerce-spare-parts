<?php

namespace App\Exports;

use App\Models\Purchase;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportPurchaseInvoice implements FromView
{
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        return view('dashboard.prints_invoices.invoice_purchase', [
            'purchase' => Purchase::find($this->id),
        ]);
    }
}
