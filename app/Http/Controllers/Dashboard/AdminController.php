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
        $this->authorize('check-permissions', 'read_admins');
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
        $this->authorize('check-permissions', 'create_admins');
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
        $this->authorize('check-permissions', 'create_admins');
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
        $this->authorize('check-permissions', 'update_admins');
        return view('dashboard.admins.edit',compact('admin'));
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
        $this->authorize('check-permissions', 'update_admins');
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            "phone"=>"required|digits:11",
            'role' => ['string', 'in:suber_admin,accountant,customer_service,data_entry'],
        ];
        if(isset($request->password)){
            $rules += [
                'password' => ['string','min:8','max:20', 'confirmed'],
            ];
        }
        $request->validate($rules);

        $request_data = $request->all();
        if($request->password){
            $request_data = $request->except(['password','password_confirmation','current_password']);
            if(password_verify($request->current_password, $admin->password)){
               //success
               $request_data['password'] = bcrypt($request->password);
            }else{
                return redirect()->back()->withErrors("The current password does not match")->withInput();
            }
        }
        $admin->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.admins.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $this->authorize('check-permissions', 'delete_admins');
    }
    public function editPermissions(Admin $admin)
    {
        $this->authorize('check-permissions', 'update_admin');

        $permissions = Permission::all();

        return view('dashboard.admins.permissions.index', compact('permissions','admin'));
    }
    public function updatePermissions(Request $request,Admin $admin)
    {
        $this->authorize('check-permissions', 'update_admins');
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
