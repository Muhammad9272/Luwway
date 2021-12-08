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

class PhpPaypalController extends Controller
{

   public function store(Request $request)
   {    
         $gs=Generalsetting::findOrFail(1);
         //Get Access Token
         $tokenRequest = AppHelper::sendCurlRequest('oauth2/token', 'grant_type=client_credentials');   
         //Get Access Token ends      
         if(isset($tokenRequest->access_token)) {
             $token = $tokenRequest->access_token;
             $arr = ['intent' => 'CAPTURE', 'purchase_units' => [
                 ['amount' => ['currency_code' => 'USD', 'value' => '2000.00']]
             ], 'application_context' =>
                 [
                     'return_url' => route('vendor.payment.return',$token),
                     'cancel_url' => route('vendor.payment.cancle'),
                     'brand_name' => $gs->title,
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

   public function payreturn($access_token=null)
   { 

      $captureOrder = AppHelper::sendCurlRequest('checkout/orders/' .$_GET['token'].'/capture', '',$access_token);
      if($captureOrder->status=="COMPLETED"){
          dd($captureOrder);
      }
      //return redirect()->route('user-dashboard')->with('success', 'Vendor Account Activated Successfully');
   }


}
