<?php

namespace App\Traits;

use App\Models\Report;


Trait ReportTrait
{
    function ReportPurchaseIncrement($purchases_amount,$purchases_count){
        $report = Report::whereDate('created_at',date('Y-m-d'))->first();
        $report->update([
            'purchases_amount'=> $report->purchases_amount += $purchases_amount,
            'purchases_count'=> $report->purchases_count += $purchases_count,
        ]);
    }
    function ReportSaleIncrement($orders_amount,$orders_count){
        $report = Report::whereDate('created_at',date('Y-m-d'))->first();
        $report->update([
            'orders_amount'=> $report->orders_amount += $orders_amount,
            'orders_count'=> $report->orders_count += $orders_count,
        ]);
    }
}
