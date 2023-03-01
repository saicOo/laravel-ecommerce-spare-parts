<?php

namespace App\Traits;

use App\Models\Purchase;


Trait InvoiceTrait
{
    function PurchaseInvoiceIncrement(){
        $last_order = Purchase::latest()->first();
        $firstInvoiceNumber = date('Y').date('m').str_pad(1,6,0,STR_PAD_LEFT); // 202302000001;
        if(!$last_order){
            return $nextInvoiceNumber = $firstInvoiceNumber;
        }else{
            $splitNum = str_split($last_order->invoice_no,6);
            $newInvoiceNo = $splitNum[1]+1;
            //check first day in a month and year
            if (date('Y-m-d',strtotime(date('Y-m-01'))) == date('Y-m-d') && Purchase::whereDate('created_at',date('Y-m-01'))->doesntExist()){
                return $nextInvoiceNumber = $firstInvoiceNumber;
            } else {
            //increase 1 with last invoice number
            return $nextInvoiceNumber = date('Y').date('m').str_pad($newInvoiceNo,6,0,STR_PAD_LEFT);
        }
    }
    }
}
