<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function index(Request $request)
    {
        $this->authorize('check-permissions', 'read_users');
        $clients = User::with('orders')->when($request->search,function ($query) use ($request){
            return $query->where('first_name','Like','%'.$request->search.'%')->orWhere('last_name','Like','%'.$request->search.'%')
            ->orWhere('email','Like','%'.$request->search.'%')->orWhere('phone','Like','%'.$request->search.'%');
        })->latest()->paginate(10);
        return view('dashboard.clients.index', compact('clients'));
    }

    public function show(User $client)
    {
        $this->authorize('check-permissions', 'read_users');
        return view('dashboard.clients.show', compact('client'));
    }

}
