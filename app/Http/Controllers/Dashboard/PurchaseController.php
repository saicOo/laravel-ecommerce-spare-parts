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
// ./
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    use InvoiceTrait,ReportTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        })->when($request->type,function ($query) use ($request){
            return $query->where('type',$request->type);
        })->when($request->daterange,function ($query) use ($request){
            return $query->whereBetween('created_at',[$request->daterange[0],$request->daterange[1]]);
        })->latest()->paginate(10);
        return view('dashboard.purchases.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('check-permissions', 'create_users');
        $suppliers = Supplier::all();
        return view('dashboard.purchases.create',compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'supplier' => 'required',
            'products.*.quantity' => 'required|integer',
            'products.*.price' => 'required|numeric',
            'products' => 'required|array',
            'products.*' => 'required',
            'type' => 'required',
        ]);
        $nextInvoiceNumber = $this->PurchaseInvoiceIncrement();
        $purchase = Purchase::create([
            'supplier_id' => $request->supplier,
            'invoice_no' => $nextInvoiceNumber,
        ]);
        $purchase->products()->attach($request->products);
        $total_price = 0;
        // start foreach
        foreach ($request->products as $id => $purchase_product) {

            $product = Product::FindOrFail($id);
            if($request->type == 1){
                $this->ReportPurchaseIncrement($purchase_product['price'] * $purchase_product['quantity'],$purchase_product['quantity']);
                // pricing policy
                $balance_value = $product->stock * $product->purchase_price;
                $new_balance_value = $purchase_product['quantity'] * $purchase_product['price'];
                $total_balance_value = $balance_value + $new_balance_value;
                $total_quantity = $purchase_product['quantity'] + $product->stock;
                // end
                $product->update([
                        'stock' => $product->stock + $purchase_product['quantity'],
                        'purchase_price' => $total_balance_value / $total_quantity,
                                ]);
            }else{
                $product->update([
                    'stock' => $product->stock - $purchase_product['quantity'],
                            ]);
            }

            $total_price +=  $purchase_product['price'] * $purchase_product['quantity'];
        }//end foreach
        // start update purchases data table
        $status = ($request->type == 2 ? 3 : ($total_price > $request->amount_paid ? 2 : 1));
        $purchase->update([
            'total_price' => $total_price,
            'amount_paid' => $request->type == 2 ? 0 : $request->amount_paid,
            'payment_status' => $status,
            'type' => $request->type,
        ]);// start update purchases data table

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.purchases.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        return view('dashboard.purchases.show', compact('purchase'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
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
}
