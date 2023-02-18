<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::first();
        return view('dashboard.settings.index', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        $rules= [
            'name' => 'required|max:50',
            'phone' => 'required|max:20000',
            'address' => 'required',
            'tax' => 'numeric|min:0|max:100',
            'shipping' => 'numeric|min:0|max:1000',

        ];
        if(isset($request->image)){
            $rules += [
                'image' => 'image|mimes:jpg,png,jpeg,gif,svg',
            ];
        }
        $request->validate($rules);
        $request_data = $request->all();

        if ($request->image) {
            if($setting->image != "default.png"){
                File::delete(public_path('uploads/company/'.$setting->image));
            }
            $imageName = Str::random(10) . uniqid()  . '.webp';
                Image::make($request->image)->encode('webp', 65)->resize(600, null, function ($constraint) {
                    $constraint->aspectRatio();
                    })->save(public_path('uploads/company/'.$imageName));
        $request_data['image']  = $imageName;
        }
        $setting->update($request_data);
                session()->flash('success', __('site.updated_successfully'));
                return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
