<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');

    }

    public function index(Request $request)
    {
        $this->authorize('check-permissions', 'read_users');
        $suppliers = Supplier::when($request->search,function ($query) use ($request){
            return $query->where('name','Like','%'.$request->search.'%');
        })->latest()->paginate(10);
        return view('dashboard.suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        $this->authorize('check-permissions', 'create_users');
        return view('dashboard.suppliers.create');
    }


    public function store(Request $request)
    {
        $this->authorize('check-permissions', 'create_users');
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            "phone"=>"required|digits:11",
            "account_status"=>"required|in:1,2,3",
            "current_account"=>"numeric|max:1000000",
        ]);
        $request_data = $request->all();
        if($request->exists('current_account') && $request->account_status == 1){
            $request_data['current_account'] = 0 - $request->current_account;
        }
        // dd($request_data['current_account']);
        $supplier = Supplier::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.suppliers.index');
    }


    public function edit(Supplier $supplier)
    {
        $this->authorize('check-permissions', 'update_users');
        return view('dashboard.suppliers.edit',compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $this->authorize('check-permissions', 'update_users');
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            "phone"=>"required|digits:11",
        ]);

        $supplier->update($request->all());
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.suppliers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($test,Request $request)
    {
        $suppliers_arr = explode(",",$request->mass_delete);
        $supplier = Supplier::whereIn('id', $suppliers_arr);
        $supplier->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.suppliers.index');
    }
}
