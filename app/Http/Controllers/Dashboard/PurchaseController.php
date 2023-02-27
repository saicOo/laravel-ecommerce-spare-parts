<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('check-permissions', 'read_users');
        $purchases = Purchase::when($request->search,function ($query) use ($request){
            return $query->where('name','Like','%'.$request->search.'%');
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
        // dd($request->all());
        $request->validate([
            'supplier' => 'required',
            'qyt' => 'required|array',
            'qyt.*' => 'required|integer',
            'price' => 'required|array',
            'price.*' => 'required|numeric',
            'products' => 'required|array',
            'products.*' => 'required',
        ]);
        $last_order = Purchase::latest()->first();
        $firstInvoiceNumber = date('Y').date('m').str_pad(1,6,0,STR_PAD_LEFT); // 202302000001;
        if(!$last_order){
            $nextInvoiceNumber = $firstInvoiceNumber;
        }else{
            $splitNum = str_split($last_order->invoice_no,6);
            $newInvoiceNo = $splitNum[1]+1;
            //check first day in a month and year
            if (date('Y-m-d',strtotime(date('Y-m-01'))) == date('Y-m-d') ){
                $nextInvoiceNumber = $firstInvoiceNumber;
            } else {
            //increase 1 with last invoice number
            $nextInvoiceNumber = date('Y').date('m').str_pad($newInvoiceNo,6,0,STR_PAD_LEFT);
        }
    }
        $purchase = Purchase::create([
            'supplier_id' => $request->supplier,
            'invoice_no' => $nextInvoiceNumber,
        ]);

        $total_price = 0;
        // start foreach
        foreach ($request->products as $index => $product_id) {

            $purchase->products()->attach($product_id,['quantity' => $request->qyt[$index],
                                                        'price' => $request->price[$index] ]);
            $product = Product::FindOrFail($product_id);
            // pricing policy
            $balance_value = $product->stock * $product->purchase_price;
            $new_balance_value = $request->qyt[$index] * $request->price[$index];
            $total_balance_value = $balance_value + $new_balance_value;
            $total_quantity = $request->qyt[$index] + $product->stock;
            // end
            $product->update([
                    'stock' => $product->stock + $request->qyt[$index],
                    'purchase_price' => $total_balance_value / $total_quantity,
                            ]);

        $total_price +=  $request->price[$index] * $request->qyt[$index];
        }//end foreach
        // start update purchases data table
        $status = $total_price > $request->amount_paid ? 2 : 1;
        $purchase->update([
            'total_price' => $total_price,
            'amount_paid' => $request->amount_paid,
            'payment_status' => $status,
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
    public function destroy(Purchase $purchase)
    {
        //
    }
}
