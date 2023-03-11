<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportOrderInvoice implements FromView
{
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        return view('dashboard.prints_invoices.invoice_order', [
            'order' => Order::find($this->id),
        ]);
    }
}
