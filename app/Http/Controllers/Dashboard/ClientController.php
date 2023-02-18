<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function index(Request $request)
    {
        $clients = User::with('orders')->when($request->search,function ($query) use ($request){
            return $query->where('name','Like','%'.$request->search.'%');
        })->latest()->paginate(10);
        return view('dashboard.clients.index', compact('clients'));
    }

    public function show(User $client)
    {
        return view('dashboard.clients.show', compact('client'));
    }

}
