<?php

namespace App\Http\Controllers\Vendor;


use App\Classes\GeniusMailer;
use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Models\Subscription;
use App\Models\User;
use App\Models\UserSubscription;
use Auth;
use Carbon\Carbon;
use Config;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PaypalController extends Controller
{

   public function store(Request $request)
   {    
        $gs=Generalsetting::findOrFail(1);
        $user = Auth::user();
        $subs = Subscription::findOrFail($request->subs_id);
        $item_amount = $subs->price;
        $item_name =  $gs->title .' '.$subs->title." Plan";

        $sub = new UserSubscription;
        $sub->user_id = $user->id;
        $sub->subscription_id = $subs->id;
        $sub->title = $subs->title;
        $sub->currency = $subs->currency;
        $sub->currency_code = $subs->currency_code;
        $sub->price = $subs->price;
        $sub->days = $subs->days;
        $sub->allowed_products = $subs->allowed_products;
        $sub->details = $subs->details;
        $sub->method = 'Paypal';
        $sub->save();

        //Get Access Token
        $tokenRequest = AppHelper::sendCurlRequest('oauth2/token', 'grant_type=client_credentials');   
        //Get Access Token ends      
         if(isset($tokenRequest->access_token)) {
             $token = $tokenRequest->access_token;
             $arr = ['intent' => 'CAPTURE', 'purchase_units' => [
                 ['amount' => ['currency_code' => $subs->currency_code, 'value' => $item_amount]]
             ], 'application_context' =>
                 [
                     'return_url' => route('vendor.payment.return',['token'=>$token,'subs_id'=>$subs->id]),
                     'cancel_url' => route('vendor.payment.cancle'),
                     'brand_name' => $item_name,
                     // 'locale'     => 'ar-SA',
                     // 'country_code' => 'SA',
                 ],
             ];

             $redirect = AppHelper::sendCurlRequest('checkout/orders', json_encode($arr), $token);

             if ($redirect->statusCode == 201) {
                 return redirect()->to($redirect->links[1]->href); ;
             }
             
         }


   }





   public function paycancle()
   {
      return redirect()->back()->with('unsuccess', 'Payment Cancelled.');
   }

   public function payreturn($access_token,$subs_id)
   { 
      

        $captureOrder = AppHelper::sendCurlRequest('checkout/orders/' .$_GET['token'].'/capture', '',$access_token);
        $user=Auth::user();
        if($captureOrder->status=="COMPLETED"){
           
            $settings = Generalsetting::findOrFail(1);
            $order = UserSubscription::where('user_id','=',$user->id)
                ->orderBy('created_at','desc')->first();

            $package = $user->subscribes()->where('status',1)->orderBy('id','desc')->first();
            $subs = Subscription::findOrFail($order->subscription_id);
            

            $today = Carbon::now()->format('Y-m-d');
            $date = date('Y-m-d', strtotime($today.' + '.$subs->days.' days'));
            $user->is_vendor = 2;
            if(!empty($package))
            {
                if($package->subscription_id == $subs_id)
                {
                    $newday = strtotime($today);
                    $lastday = strtotime($user->date);
                    $secs = $lastday-$newday;
                    $days = $secs / 86400;
                    $total = $days+$subs->days;
                    $user->date = date('Y-m-d', strtotime($today.' + '.$total.' days'));
                }
                else
                {
                    $user->date = date('Y-m-d', strtotime($today.' + '.$subs->days.' days'));
                }
            }
            else
            {
                $user->date = date('Y-m-d', strtotime($today.' + '.$subs->days.' days'));
            }
            $user->mail_sent = 1;
            $user->update();


            $data['txnid'] = $_GET['PayerID'];
            $data['status'] = 1;
            $order->update($data);
            return redirect()->route('vendor-dashboard')->with('success', 'Vendor Account Activated Successfully');

        }else{
            $payment = UserSubscription::where('user_id','=',$user->id)
            ->orderBy('created_at','desc')->first();
            $payment->delete();
            return redirect()->route('vendor-dashboard')->with('success', 'Something went wrong !');
        }
     
   }


}
