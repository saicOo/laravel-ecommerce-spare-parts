<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $orders = auth()->user()->orders()->latest()->get();
        return view('front.user.index',compact('user','orders'));
    }

    public function update(Request $request, User $user)
    {
        if($request->exists('updateProfile')){
            if($request->exists('check_password')){
                $this->validatorPassword($request->all())->validate();
                $errorPassword = $this->updatePassword($request->all());
                if(!$errorPassword){
                    redirect()->back()->withErrors(["current_password" => __('site.password_match')])->withInput();
                }
            }
            $this->validatorProfile($request->all())->validate();
            $this->updateProfile($request->all());
        }
        if($request->exists('updateAddress')){
            $this->validatorAddress($request->all())->validate();
            $this->updateAddress($request->all());
        }

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('users.index');
    }


    private function validatorProfile($request)
    {
        return Validator::make($request, [
            'first_name' => ['required', 'string', 'max:255','regex:/^\S*$/u'],
            'last_name' => ['required', 'string', 'max:255','regex:/^\S*$/u'],
            "phone"=>   ['required','digits:11','unique:users'],
        ]);
    }

    private function validatorAddress($request)
    {
        return Validator::make($request, [
            'governorate' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'street' => ['required', 'string', 'max:255'],
            'building' => ['required', 'integer', 'max:1000'],
            'apartment' => ['required', 'integer', 'max:100'],
            'floor' => ['required', 'integer', 'max:50'],
        ]);
    }

    private function validatorPassword($request)
    {
        return Validator::make($request, [
            'password' => ['required', 'string','min:8','max:20', 'confirmed'],
        ]);
    }

    private function updateProfile(array $data)
    {
        auth()->user()->update([
            'first_name'=> $data['first_name'],
            'last_name'=> $data['last_name'],
            'phone'=> $data['phone'],
        ]);
    }

    private function updateAddress(array $data)
    {
        auth()->user()->update( [
            'governorate' => $data['governorate'],
            'city' => $data['city'],
            'street' => $data['street'],
            'building' => $data['building'],
            'apartment' => $data['apartment'],
            'floor' => $data['floor'],
        ]);
    }
    private function updatePassword(array $data)
    {
        if(password_verify($data['current_password'], auth()->user()->password)){
                dd(auth()->user()->password);
                auth()->user()->update( [
                    'password' => Hash::make($data['password']),
                ]);
                return true;
            }else{
                return false;
            }


    }
}
