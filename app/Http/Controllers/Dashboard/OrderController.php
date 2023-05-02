<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;
// Exel Order
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportOrder;
use App\Exports\ExportOrderInvoice;
// ./
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $this->authorize('check-permissions', 'read_orders');
        if($request->exists('daterange')){
            // $request->validate([
            //     'daterange' => 'date_format:m/d/Y - m/d/Y',
            // ]);
        $request->daterange = explode(" - ",$request->daterange);
           $request->daterange[0] = date('Y-m-d',strtotime($request->daterange[0]));
           $request->daterange[1] = date('Y-m-d',strtotime($request->daterange[1]));
        }
        $orders = Order::with('user')->when($request->search,function ($query) use ($request){
            return $query->where('invoice_no','Like','%'.$request->search.'%')
            ->orWhereHas('user', function ($q) use ($request) {
                $q->where('first_name', 'like', '%'.$request->search.'%')->orWhere('last_name','like','%'.$request->search.'%');
            });
        })->when($request->status,function ($query) use ($request){
            return $query->where('payment_status',$request->status);
        })->when($request->payment,function ($query) use ($request){
            return $query->where('payment_method',$request->payment);
        })->when($request->daterange,function ($query) use ($request){
            return $query->whereBetween('created_at',[$request->daterange[0],$request->daterange[1]]);
        })->when($request->date,function ($query) use ($request){
            return $query->whereDate('created_at',$request->date);
        })->latest()->paginate(10);
        return view('dashboard.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $this->authorize('check-permissions', 'read_orders');

        return view('dashboard.orders.show',compact('order'));
    }


    public function edit(Order $order)
    {
        $this->authorize('check-permissions', 'update_orders');

        return view('dashboard.orders.edit',compact('order'));
    }


    public function update(Request $request, Order $order)
    {
        $this->authorize('check-permissions', 'update_orders');

        $request->validate([
            'payment_status' => 'required|in:1,2,3',
            'tracking' => 'required|in:1,2,3,4,5',
            'address' => 'required|string|max:50',
            'building' => 'required|integer|max:1000',
            'apartment' => 'required|integer|max:100',
            'floor' => 'required|integer|max:50',
        ]);
        $order->update([
            'payment_status'=> $request->payment_status,
            'tracking'=> $request->tracking,
            'address'=> $request->address,
            'building'=> $request->building,
            'apartment'=> $request->apartment,
            'floor'=> $request->floor,
        ]);
        if($request->products){
            foreach ($order->products as $product) {
                if(in_array($product->id,$request->products)){
                    $order->products()->updateExistingPivot($product->id,[
                        'return_status' => true,
                    ]);
                    $product->update([
                        'stock' => $product->stock +  $product->pivot->quantity,
                    ]);
                }
            }
        }
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.orders.index');
    }

    public function destroy($test,Request $request)
    {
        $orders_arr = explode(",",$request->mass_delete);
        $order = Order::whereIn('id', $orders_arr);
        $order->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.orders.index');
    }

    public function exportOrders(Request $request){
        $this->authorize('check-permissions', 'create_admins');
        return Excel::download(new ExportOrder, 'orders.xlsx');
    }

    public function exportInvoiceOrder($id)
    {
        return Excel::download(new ExportOrderInvoice($id), 'invoices.xlsx');
    }
}
