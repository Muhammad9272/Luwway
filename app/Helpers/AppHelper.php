<?php
namespace App\Helpers;

use App\Models\Currency;
use App\Models\Generalsetting;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Message;
use Session;
use GuzzleHttp\Psr7;
use Auth;

class AppHelper
{

    public static function getcheckoutPrice($shipping, $packaging)
    {
       if (Session::has('currency')) {
           $curr = Currency::find(Session::get('currency'));
         } else {
            $curr = Currency::where('is_default', '=', 1)->first();
         }
        $total = Session::has('cart') ? Session::get('cart')->totalPrice : '0' ;
        $tax=Session::has('tax_region') ? Session::get('tax_region') : '0' ;
        $coupon = Session::has('coupon') ? Session::get('coupon') : 0;
        if ($tax != 0) {
            $tax = ($total / 100) * $tax;
            $total = $total + $tax;
        }
        $additional_costs=$shipping+$packaging;
        $total=$total+$additional_costs-$coupon;
        $total=$total+round(0 * $curr->value, 2);

        return number_format((float)$total, 2, '.', '');
    }

   public static function sendCurlRequest($url, $data = '', $token = null, $get = false)
   {
       $gs=Generalsetting::findOrFail(1);
       $clientID  = $gs->paypal_client;
       $secretKey = $gs->paypal_secret;
       //dd( $clientID,$secretKey);
       $rootUrl = $gs->paypal_live?"https://api-m.paypal.com/":"https://api-m.sandbox.paypal.com/";

       $version = 'v' . ($token ? '2' : '1') . '/';

       $fullUrl = $rootUrl . $version . $url;
       
       
       $lang    = 'en_US';

       $headers = array(
           'Content-Type'  => 'application/json',
           'Accept-Language' => $lang,
       );

       if ($token) {
           $headers['Authorization'] = 'Bearer ' . $token;
       }

       try {

           $requestData = [
               'headers' => $headers,
               'body' => $data,
               'debug' => false,
           ];
           
           
           if (!$token) {
               $requestData['auth'] = [$clientID, $secretKey, 'basic'];
           }

           $client  = new Client();
           if(!$get) {
               $response = $client->request('POST', $fullUrl, $requestData);
           }
           else{
               $response = $client->request('GET', $fullUrl, $requestData);
           }

           
           $statusCode = $response->getStatusCode();
           $response = json_decode($response->getBody());
           $response->statusCode = $statusCode;
           return $response;


       } catch (ClientException $e) {
           echo Psr7\Message::toString($e->getResponse());
       }
   }
   
   public static function getUserImage($photo=null)
   {   
       $gs = json_decode(config('global.global_gs'));
       return $image=Auth::user()->is_provider == 1 ?(Auth::user()->photo ? Auth::user()->photo:asset('assets/images/'.$gs->user_image)):(Auth::user()->photo ? asset('assets/images/users/'.Auth::user()->photo):asset('assets/images/'.$gs->user_image)) ;

   }
   




}