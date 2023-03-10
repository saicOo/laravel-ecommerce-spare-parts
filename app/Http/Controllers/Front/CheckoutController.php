<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Setting;
use App\Traits\ReportTrait;
use App\Http\Services\PaymentServices;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    use ReportTrait;
    private $paymentServices;
    public function __construct(PaymentServices $paymentServices)
    {
        $this->middleware('auth')->except('callbackApi');
        $this->paymentServices = $paymentServices;
    }

    public function create()
    {
        $user = auth()->user();
        if($user->products()->count() != 0){
            $setting = Setting::first();
            $products = $user->products;
            $sub_total = $user->products()->sum(\DB::raw('products.price * product_user.quantity'));
            $tax_amount = $sub_total * ($setting->tax / 100);
            $total_price = $sub_total + $tax_amount + $setting->shipping;
            return view('front.checkout.index',compact('products','tax_amount','sub_total','total_price'));
        }else{
            return redirect()->back();
        }

    }


    public function store(Request $request)
    {
        $request->validate([
            'selector' => 'required|in:cash,online',
        ]);
        $user = auth()->user();
        if(!$user->phone || !$user->city){
            return redirect()->back()->withErrors(["missing_data" => __('site.missing_data')])->withInput();
        }
        $checkStock = true;
        foreach ($user->products as $product) {
            $checkStock = $product->stock < $product->pivot->quantity;
        }
        if($checkStock){
            return redirect()->back()->withErrors(["missing_data" => __('site.missing_data')])->withInput();
        }

        if($request->selector == "online" ){
            $paymentTokenUrl = $this->paymentServices->getPayment($user);
            return redirect()->intended('https://accept.paymob.com/api/acceptance/iframes/708449?payment_token='.$paymentTokenUrl['token']);
        }else{
            $this->createOrder($user,$request->selector,true);
            session()->flash('order_success', __('site.order_successfully'));
            return redirect()->route('users.index');
        }
    }


    public function createOrder(User $user,$payment_method,$success)
    {

        $last_order = Order::latest()->first();
        $firstInvoiceNumber = date('Y').date('m').str_pad(1,6,0,STR_PAD_LEFT); // 202302000001;
        if(!$last_order){
            $nextInvoiceNumber = $firstInvoiceNumber;
        }else{
            $splitNum = str_split($last_order->invoice_no,6);
            $newInvoiceNo = $splitNum[1]+1;
            //check first day in a month and year
            if (date('Y-m-d',strtotime(date('Y-m-01'))) == date('Y-m-d') && !Order::whereDate('created_at',date('Y-m-01'))->first()){
                $nextInvoiceNumber = $firstInvoiceNumber;
            } else {
            //increase 1 with last invoice number
            $nextInvoiceNumber = date('Y').date('m').str_pad($newInvoiceNo,6,0,STR_PAD_LEFT);
        }
        }

        $order = $user->orders()->create([
            'invoice_no' => $nextInvoiceNumber,
        ]);
        $sub_total = 0;
         // start foreach
         foreach ($user->products as $product) {
            $this->ReportSaleIncrement($product->price * $product->pivot->quantity,$product->pivot->quantity);
            $order->products()->attach($product->id,['quantity' => $product->pivot->quantity,
            'price' => $product->price ]);

            if($success){
                $product->update([
                    'stock' => $product->stock - $product->pivot->quantity,
                            ]);
            }

        $sub_total +=  $product->price * $product->pivot->quantity;
        } // end foeach
        $setting = Setting::first();
        $tax_amount = $sub_total * ($setting->tax / 100);
        $shipping = $setting->shipping;
        $total_price = $sub_total + $tax_amount + $shipping;
        $order->update([
            'tax' => $tax_amount,
            'shipping' => $shipping,
            'sub_total' => $sub_total,
            'total_price' => $total_price,
            'payment_method' => $payment_method == "online" ? 1 : 0,
            'address' => $user->governorate.', '.$user->city.', '.$user->street,
            'building' => $user->building,
            'apartment' => $user->apartment,
            'floor' => $user->floor,
        ]);// end update order data table
        $user->products()->detach();
        return $order;
    }


    public function callback(Request $request)
    {

        $data = $request->all();

        $amount_cents=$data['amount_cents'];
        $created_at=$data['created_at'];
        $currency=$data['currency'];
        $error_occured=$data['error_occured'];
        $has_parent_transaction=$data['has_parent_transaction'];
        $id=$data['id'];
        $integration_id=$data['integration_id'];
        $is_3d_secure=$data['is_3d_secure'];
        $is_auth=$data['is_auth'];
        $is_capture=$data['is_capture'];
        $is_refunded=$data['is_refunded'];
        $is_standalone_payment=$data['is_standalone_payment'];
        $is_voided=$data['is_voided'];
        $order_id= $data['order'];
        $owner=$data['owner'];
        $pending=$data['pending'];
        $source_data_pan=$data['source_data_pan'];
        $source_data_sub_type=$data['source_data_sub_type'];
        $source_data_type= $data['source_data_type'];
        $success=$data['success'];

        $hmac = $data['hmac'];
        $request_string = $amount_cents.$created_at.$currency.$error_occured.$has_parent_transaction.$id.$integration_id.$is_3d_secure.$is_auth.$is_capture.$is_refunded.$is_standalone_payment.$is_voided.$order_id.$owner.$pending.$source_data_pan.$source_data_sub_type.$source_data_type.$success;
      $hased = hash_hmac('SHA512',$request_string,'F4DAB4EA98064BBF28508BE6DFEBCD04');
        if($hased === $hmac){
            if($success == 'true'){
                session()->flash('order_success', __('site.order_successfully'));
            }else{
                session()->flash('order_wrong', __('site.order_wrong'));
            }
                $user = User::where('payment_callback',$order_id)->first();
                $order = $this->createOrder($user,'online',$success);
                $order->update([
                    'payment_status' => $success ? 1 : 3,
                ]);
                $order->transaction()->create([
                    'transaction_no' => $id,
                    'order_transaction_no' => $order_id,
                    'pending' => $pending ? 1 : 0,
                    'success' => $success ? 1 : 0,
                    'source_type' => $source_data_sub_type,
                ]);
            }

            return redirect()->route('users.index');
            // return view('governorate',compact('id','order_id','success','pending','hmac'));
        }
    }

    // public function callbackApi(Request $request)
    // {
    //     if($request['obj']['order']['id']){
    //         $order_id = $request['obj']['order']['id'];
    //         $transaction_no = $request['obj']['id'];
    //             $success = $request['obj']['success'];
    //             $pending = $request['obj']['pending'];
    //             $source_data = $request['obj']['source_data']['sub_type'];
    //             $user = User::where('payment_callback',$order_id)->first();
    //             $order = $this->createOrder($user,'online',$success);
    //             $order->update([
    //                 'payment_status' => $success ? 1 : 3,
    //             ]);
    //             $order->transaction()->create([
    //                 'transaction_no' => $transaction_no,
    //                 'order_transaction_no' => $order_id,
    //                 'pending' => $pending,
    //                 'success' => $success,
    //                 'source_type' => $source_data,
    //             ]);
    //         }
    // }
// }
