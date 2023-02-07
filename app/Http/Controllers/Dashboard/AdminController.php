<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Permission;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $admins = Admin::when($request->search,function ($query) use ($request){
            return $query->where('name','Like','%'.$request->search.'%');
        })->latest()->paginate(10);
        return view('dashboard.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.admins.create');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            "phone"=>"required|digits:11",
            'role' => ['required', 'string', 'in:suber_admin,accountant,customer_service,data_entry'],
            'password' => ['required', 'string', 'min:8','max:20', 'confirmed'],
        ]);
        $request_data = $request->except(['password','password_confirmation']);
        $request_data['password'] = bcrypt($request->password);
        $admin = Admin::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.admins.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
    public function editPermissions(Admin $admin)
    {
    //    dd($admin);
    $permissions = Permission::all();
    // dd($admin->permissions->find(33) ? 'true':'false');
    return view('dashboard.admins.permissions.index', compact('permissions','admin'));
    }
    public function updatePermissions(Request $request,Admin $admin)
    {
        $request->validate([
            'permissions' => 'required|array',
        ]);
        foreach($admin->permissions as $permission){
            if(!in_array($permission->id,$request->permissions)){
                $admin->permissions()->detach($permission->id);
            }
        }
        foreach($request->permissions as $permission_id){
        $admin->permissions()->syncWithoutDetaching($permission_id);
        }
    session()->flash('success', __('site.added_successfully'));
    return redirect()->back();
    }
}
