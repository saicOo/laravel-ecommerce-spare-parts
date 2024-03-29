<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\Supplier;
use App\Traits\ReportTrait;
use App\Traits\InvoiceTrait;
// Exel Purchase
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportPurchase;
use App\Exports\ExportPurchaseInvoice;
// ./
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    use InvoiceTrait,ReportTrait;

    public function index(Request $request)
    {
        $this->authorize('check-permissions', 'read_users');
        if($request->exists('daterange')){
            // $request->validate([
            //     'daterange' => 'date_format:m/d/Y - m/d/Y',
            // ]);
        $request->daterange = explode(" - ",$request->daterange);
           $request->daterange[0] = date('Y-m-d',strtotime($request->daterange[0]));
           $request->daterange[1] = date('Y-m-d',strtotime($request->daterange[1]));
        }
        $purchases = Purchase::when($request->search,function ($query) use ($request){
            return $query->where('name','Like','%'.$request->search.'%');
        })->when($request->status,function ($query) use ($request){
            return $query->where('payment_status',$request->status);
        })->when($request->payment_type,function ($query) use ($request){
            return $query->where('payment_type',$request->payment_type);
        })->when($request->daterange,function ($query) use ($request){
            return $query->whereBetween('created_at',[$request->daterange[0],$request->daterange[1]]);
        })->when($request->date,function ($query) use ($request){
            return $query->whereDate('created_at',$request->date);
        })->latest()->paginate(10);

        return view('dashboard.purchases.index', compact('purchases'));
    }

    public function create()
    {
        $this->authorize('check-permissions', 'create_users');
        $suppliers = Supplier::all();
        return view('dashboard.purchases.create',compact('suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier' => 'required',
            'products.*.quantity' => 'required|integer',
            'products.*.price' => 'required|numeric',
            'products' => 'required|array',
            'products.*' => 'required',
            'payment_type' => 'required',
            'payment_status' => 'required',
        ]);
        $nextInvoiceNumber = $this->PurchaseInvoiceIncrement();
        $purchase = Purchase::create([
            'supplier_id' => $request->supplier,
            'invoice_no' => $nextInvoiceNumber,
        ]);
        $purchase->products()->attach($request->products);
        $total_price = 0;
        // start foreach
        foreach ($request->products as $purchase_product) {
            $total_price +=  $purchase_product['price'] * $purchase_product['quantity'];
        }//end foreach
        // || $request->payment_type == 2
        $amount_paid = 0;
        if($request->payment_status == 1){ // if purchase payment status cash
            $amount_paid = $total_price;
        }

        // start update purchases data table
        $purchase->update([
            'total_price' => $total_price,
            'amount_paid' => $amount_paid,
            'payment_type' => $request->payment_type,
        ]);// start update purchases data table


        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.purchases.show',$purchase->id);
    }

    public function show(Purchase $purchase)
    {
        return view('dashboard.purchases.show', compact('purchase'));
    }

    public function active(Purchase $purchase)
    {
        // start stock area
        foreach ($purchase->products as $index => $product) {
            $products_qyt = $product->pivot->quantity;
            $products_price = $product->pivot->price * $products_qyt;
            if($purchase->payment_type == 1){ // if purchase payment type new
                // update daily report
                $this->ReportPurchaseIncrement($products_price,$products_qyt);
                // pricing policy
                $balance_value = $product->stock * $product->purchase_price;
                $new_balance_value = $product->pivot->quantity * $product->pivot->price;
                $total_balance_value = $balance_value + $new_balance_value;
                $total_quantity = $product->pivot->quantity + $product->stock;
                // pricing policy end
                $product->update([
                        'stock' => $product->stock + $product->pivot->quantity,
                        'purchase_price' => $total_balance_value / $total_quantity,
                                ]);
            }else{ // if purchase payment type return
                // update daily report
                $this->ReportPurchaseIncrement(-$products_price,-$products_qyt);
                 $product->update([
                    'stock' => $product->stock - $product->pivot->quantity,
                        ]);
            }
        }// end stock area
        // start supplier area
        $current_account = $purchase->supplier->current_account;
        $append_account = $purchase->total_price - $purchase->amount_paid;
        if($purchase->payment_type == 1){ // if purchase payment type new
            $current_account = $current_account -= $append_account; //هنقص من حساب المورد

        }else{  // if purchase payment type return
            $current_account = $current_account += $append_account; //هزود من حساب المورد
        }
        $account_status = ($current_account == 0 ? 3 : ($current_account > 0 ? 2 : 1));
        $purchase->supplier()->update([
            'start_account' => $purchase->supplier->current_account,
            'current_account' => $current_account,
            'account_status' => $account_status,
        ]);
        // end supplier area
        // purchase area
        $purchase->update([
            'active'=> 1,
            'payment_status'=> $purchase->total_price == $purchase->amount_paid ? 3 : 1,
        ]);
        // end purchase area
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.purchases.show',$purchase->id);
    }

    public function edit(Purchase $purchase)
    {
        return view('dashboard.purchases.edit', compact('purchase'));
    }

    public function update(Request $request, Purchase $purchase)
    {
        $request->validate([
            'amount_paid' => 'required|numeric|min:1|max:'.($purchase->total_price - $purchase->amount_paid),
        ]);

        $amount_paid = $request->amount_paid;
        $total_amount = $purchase->amount_paid + $amount_paid;
        $total_price = $purchase->total_price;
        // Payment Status
        $payment_status = ($total_amount == $total_price ? 3
        : ($total_amount > 0 && $total_amount < $total_price ? 2 : 1));
        // End Payment Status

        $purchase->update([
            'amount_paid' => $total_amount,
            'payment_status' => $payment_status,
        ]);// start update purchases data table

        $current_account = $purchase->supplier->current_account;
        if($purchase->payment_type == 1){ // if purchase payment type new
        $current_account = $current_account += $amount_paid; //هنقص من حساب المورد
        }else{  // if purchase payment type return
            $current_account = $current_account -= $amount_paid; //هزود من حساب المورد
        }
        $account_status = ($current_account == 0 ? 3 : ($current_account > 0 ? 2 : 1));
        $purchase->supplier()->update([
            'start_account' => $purchase->supplier->current_account,
            'current_account' => $current_account,
            'account_status' => $account_status,
        ]);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.purchases.show',$purchase->id);
    }

    public function destroy($test,Request $request)
    {
        $purchases_arr = explode(",",$request->mass_delete);
        $purchase = Purchase::whereIn('id', $purchases_arr);
        $purchase->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.purchases.index');
    }

    public function exportPurchases(Request $request){
        $this->authorize('check-permissions', 'create_admins');
        return Excel::download(new ExportPurchase, 'purchases.xlsx');
    }

    public function exportInvoicePurchase($id)
    {
        return Excel::download(new ExportPurchaseInvoice($id), 'invoices.xlsx');
    }
}
