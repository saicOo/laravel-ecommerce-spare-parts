<?php
namespace App\Http\Services;

// use http\Client;
use GuzzleHttp\Client;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
class PaymentServices
{
    private $base_url;
    private $headers;
    private $request_client;
    private $setting;

    public function __construct(Client $request_client)
    {
        $this->setting = Setting::first();
        $this->request_client = $request_client;
        $this->base_url = $this->setting->payment_url;
        $this->headers = [
            'Content-Type' => 'application/json',
            // 'authorization' => 'Bearer ' . env('paymob_token')
        ];
    }


    private function buildRequest($uri, $method, $data = [])
    {

        $request = new Request($method, $this->base_url . $uri, $this->headers);
        if (!$data) {
            return false;
        }

        $response = $this->request_client->send($request, [
            'json' => $data
        ]);
        // if ($response->getStatusCode() != 200) {
        //     return false;
        // }
        $response = json_decode($response->getBody(), true);
        return $response;
    }



    public function getPayment(User $user)
    {
        return $this->firstStep($user);
    }
    private function firstStep(User $user)
    {
        $data = [
            "api_key" => $this->setting->payment_token,
        ];
        $paymentToken = $this->buildRequest('auth/tokens', 'POST', $data);
        return $this->secondStep($user,$paymentToken['token']);
    }

    private function secondStep(User $user,$token)
    {
        $sub_total = $user->products()->sum(\DB::raw('products.price * product_user.quantity'));
        $tax_amount = $sub_total * ($this->setting->tax / 100);
        $total_price = $sub_total + $tax_amount + $this->setting->shipping;
        $data = [
            "auth_token"=>  $token,
            "delivery_needed"=> "false",
            "amount_cents"=> (int)$total_price . "00",
            "currency"=> "EGP",
            "items"=> [],
        ];
        $paymentId = $this->buildRequest('ecommerce/orders', 'POST', $data);
        $user->update([
            'payment_callback' => $paymentId['id'],
        ]);
        return $this->thirdStep($user,$token,$paymentId['id'],$total_price);
    }

    private function thirdStep(User $user,$token,$id,$total_price)
    {

        $data = [
            "auth_token"=> $token,
            "amount_cents"=> (int)$total_price . "00",
            "expiration"=> 3600,
            "order_id"=> $id,
            "billing_data"=> [
                "apartment"=> $user->apartment,
                "email"=> $user->email,
                "floor"=> $user->floor,
                "first_name"=> $user->first_name,
                "street"=> $user->street,
                "building"=> $user->building,
                "phone_number"=> "+02" . $user->phone,
                "shipping_method"=> "PKG",
                "postal_code"=> "01898",
                "city"=> $user->city,
                "country"=> "Egypt",
                "last_name"=> $user->last_name,
                "governorate"=> $user->governorate
            ],
            "currency"=> "EGP",
            "integration_id"=> $this->setting->payment_integration_id
        ];
        return $response = $this->buildRequest('acceptance/payment_keys', 'POST', $data);
    }

}
