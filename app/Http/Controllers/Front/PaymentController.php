<?php

namespace App\Http\Controllers\Front;

use App\Classes\GeniusMailer;
use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Currency;
use App\Models\Generalsetting;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderTrack;
use App\Models\Product;
use App\Models\User;
use App\Models\UserNotification;
use App\Models\VendorOrder;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{

   public function store(Request $request)
   {
      if (!Session::has('cart')) {
         return redirect()->route('front.cart')->with('success', "You don't have any product to checkout.");
      }

      //************* Check for price Validation
      $price = AppHelper::getcheckoutPrice($request->shipping_cost, $request->packing_cost);
      if ((int)$price != (int)$request->total) {
         return redirect()->back()->with('unsuccess', "Something went wrong");
      }
      //************* Check for price Validation ends

      // if ($request->pass_check) {
      //    $users = User::where('email', '=', $request->personal_email)->get();
      //    if (count($users) == 0) {
      //       if ($request->personal_pass == $request->personal_confirm) {
      //          $user = new User;
      //          $user->name = $request->personal_name;
      //          $user->email = $request->personal_email;
      //          $user->password = bcrypt($request->personal_pass);
      //          $token = md5(time() . $request->personal_name . $request->personal_email);
      //          $user->verification_link = $token;
      //          $user->affilate_code = md5($request->name . $request->email);
      //          $user->email_verified = 'Yes';
      //          $user->save();
      //          Auth::guard('web')->login($user);
      //       } else {
      //          return redirect()->back()->with('unsuccess', "Confirm Password Doesn't Match.");
      //       }
      //    } else {
      //       return redirect()->back()->with('unsuccess', "This Email Already Exist.");
      //    }
      // }


      $oldCart = Session::get('cart');
      $cart = new Cart($oldCart);
      if (Session::has('currency')) {
         $curr = Currency::find(Session::get('currency'));
      } else {
         $curr = Currency::where('is_default', '=', 1)->first();
      }

      foreach ($cart->items as $key => $prod) {
         if (!empty($prod['item']['license']) && !empty($prod['item']['license_qty'])) {
            foreach ($prod['item']['license_qty'] as $ttl => $dtl) {
               if ($dtl != 0) {
                  $dtl--;
                  $produc = Product::findOrFail($prod['item']['id']);
                  $temp = $produc->license_qty;
                  $temp[$ttl] = $dtl;
                  $final = implode(',', $temp);
                  $produc->license_qty = $final;
                  $produc->update();
                  $temp =  $produc->license;
                  $license = $temp[$ttl];
                  $oldCart = Session::has('cart') ? Session::get('cart') : null;
                  $cart = new Cart($oldCart);
                  $cart->updateLicense($prod['item']['id'], $license);
                  Session::put('cart', $cart);
                  break;
               }
            }
         }
      }
      $settings = Generalsetting::findOrFail(1);
      $order = new Order;


      $item_name = $settings->title . " Order";
      $item_number = str_random(4) . time();
      $item_amount = $request->total;


      // Redirect to paypal IPN

      $order['user_id'] = Auth::user()->id;
      $order['cart'] = utf8_encode(bzcompress(serialize($cart), 9));
      $order['totalQty'] = $request->totalQty;
      $order['pay_amount'] = round($item_amount / $curr->value, 2);
      $order['method'] = $request->method;
      $order['customer_email'] = $request->email;
      $order['customer_name'] = $request->name;
      $order['customer_phone'] = $request->phone;
      $order['order_number'] = $item_number;
      $order['shipping'] = $request->shipping;
      $order['pickup_location'] = $request->pickup_location;
      $order['customer_address'] = $request->address;
      $order['customer_country'] = $request->customer_country;
      $order['customer_city'] = $request->city;
      $order['customer_zip'] = $request->zip;
      $order['shipping_email'] = $request->shipping_email;
      $order['shipping_name'] = $request->shipping_name;
      $order['shipping_phone'] = $request->shipping_phone;
      $order['shipping_address'] = $request->shipping_address;
      $order['shipping_country'] = $request->shipping_country;
      $order['shipping_city'] = $request->shipping_city;
      $order['shipping_zip'] = $request->shipping_zip;
      $order['order_note'] = $request->order_notes;
      $order['coupon_code'] = $request->coupon_code;
      $order['coupon_discount'] = $request->coupon_discount;
      $order['payment_status'] = "Pending";
      $order['currency_sign'] = $curr->sign;
      $order['currency_value'] = $curr->value;
      $order['shipping_cost'] = $request->shipping_cost;
      $order['packing_cost'] = $request->packing_cost;
      $order['tax'] = $request->tax;
      $order['dp'] = $request->dp;

      $order['vendor_shipping_id'] = $request->vendor_shipping_id;
      $order['vendor_packing_id'] = $request->vendor_packing_id;

      if (Session::has('affilate')) {
         $val = $request->total / 100;
         $sub = $val * $settings->affilate_charge;
         $user = User::findOrFail(Session::get('affilate'));
         $user->affilate_income += $sub;
         $user->update();
         $order['affilate_user'] = $user->name;
         $order['affilate_charge'] = $sub;
      }
      $order->save();
      
      $track = new OrderTrack;
      $track->title = 'Pending';
      $track->text = 'You have successfully placed your order.';
      $track->order_id = $order->id;
      $track->save();

      if ($request->coupon_id != "") {
         $coupon = Coupon::findOrFail($request->coupon_id);
         $coupon->used++;
         if ($coupon->times != null) {
            $i = (int)$coupon->times;
            $i--;
            $coupon->times = (string)$i;
         }
         $coupon->update();
      }
      foreach ($cart->items as $prod) {
         $x = (string)$prod['stock'];
         if ($x != null) {
            $product = Product::findOrFail($prod['item']['id']);
            $product->stock =  $prod['stock'];
            $product->update();
         }
      }
      foreach ($cart->items as $prod) {
         $x = (string)$prod['size_qty'];
         if (!empty($x)) {
            $product = Product::findOrFail($prod['item']['id']);
            $x = (int)$x;
            $x = $x - $prod['qty'];
            $temp = $product->size_qty;
            $temp[$prod['size_key']] = $x;
            $temp1 = implode(',', $temp);
            $product->size_qty =  $temp1;
            $product->update();
         }
      }





      foreach ($cart->items as $prod) {
         $x = (string)$prod['stock'];
         if ($x != null) {

            $product = Product::findOrFail($prod['item']['id']);
            $product->stock =  $prod['stock'];
            $product->update();
            if ($product->stock <= 5) {
               $notification = new Notification;
               $notification->product_id = $product->id;
               $notification->save();
            }
         }
      }


      $notf = null;

      foreach ($cart->items as $prod) {
         if ($prod['item']['user_id'] != 0) {
            $vorder =  new VendorOrder;
            $vorder->order_id = $order->id;
            $vorder->user_id = $prod['item']['user_id'];
            $notf[] = $prod['item']['user_id'];
            $vorder->qty = $prod['qty'];
            $vorder->price = $prod['price'];
            $vorder->order_number = $order->order_number;
            $vorder->save();
         }
      }

    
      Session::put('temporder', $order);
      Session::put('tempcart', $cart);
      Session::forget('cart');

      //Get Access Token
      $tokenRequest = AppHelper::sendCurlRequest('oauth2/token', 'grant_type=client_credentials');   
      //Get Access Token ends      
      if(isset($tokenRequest->access_token)) {
          $token = $tokenRequest->access_token;
          $arr = ['intent' => 'CAPTURE', 'purchase_units' => [
              ['amount' => ['currency_code' => $curr->name, 'value' => $item_amount]]
          ], 'application_context' =>
              [
                  'return_url' => route('payment.return',['custom'=>Auth::user()->id,'item_number'=>$item_number,'token'=>$token]),
                  'cancel_url' => route('payment.cancle'),
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
      $this->code_image();
      return redirect()->back()->with('unsuccess', 'Payment Cancelled.');
   }

   // public function payreturn()
   // {
   //    $this->code_image();
   //    if (Session::has('tempcart')) {
   //       $oldCart = Session::get('tempcart');
   //       $tempcart = new Cart($oldCart);
   //       $order = Session::get('temporder');
   //    } else {
   //       $tempcart = '';
   //       return redirect()->back();
   //    }

   //    return view('front1.success', compact('tempcart', 'order'));
   // }



   public function payreturn($custom,$item_number,$access_token)
   {
       $gs = Generalsetting::findOrFail(1);
       $captureOrder = AppHelper::sendCurlRequest('checkout/orders/' .$_GET['token'].'/capture', '',$access_token);
      $buyer=User::where('id',$custom)->first();
      if($captureOrder->status=="COMPLETED"){

         $order = Order::where('user_id', $custom)
            ->where('order_number', $item_number)->first();
         //$data['txnid'] = $_POST['txn_id'];
         //$data['payment_status'] = $_POST['payment_status'];
         $data['payment_status'] = "completed";
         if ($order->dp == 1) {
            $data['status'] = 'completed';
         }
         $order->update($data);
         $notification = new Notification;
         $notification->order_id = $order->id;
         $notification->save();
         Session::forget('cart');

         //Sending Email To Buyer
         if ($gs->is_smtp == 1) {
            $data = [
               'to' => $buyer->email,
               'type' => "new_order",
               'cname' => $buyer->name,
               'oamount' => "",
               'aname' => "",
               'aemail' => "",
               'wtitle' => "",
               'onumber' => $order->order_number,
            ];

            $mailer = new GeniusMailer();
            $mailer->sendAutoOrderMail($data, $order->id);
         }

         $notf = null;
         if (Session::has('tempcart')) {
            $oldCart = Session::get('tempcart');
            $tempcart = new Cart($oldCart);
            $order = Session::get('temporder');
            foreach ($tempcart->items as $prod) {
               if ($prod['item']['user_id'] != 0) {                    
                  $notf[] = $prod['item']['user_id'];
               }
            }

         }

         if (!empty($notf)) {
            $users = array_unique($notf);
            foreach ($users as $user) {
               $notification = new UserNotification;
               $notification->user_id = $user;
               $notification->order_number = $order->order_number;
               $notification->save();

               $partner=User::where('id',$user)->first();
               if($gs->is_smtp == 1)
               {
                   $emaildata = [
                           'to' => $partner->email,
                           'type' => "vendor_new_order",
                           'cname' =>$partner->name ,
                           'oamount' => "",
                           'aname' => "",
                           'aemail' => "",
                           'onumber' => $order->order_number,
                           'token' => "",
                           
                       ];    
                       $mailer = new GeniusMailer();
                       $mailer->sendAutoMail($emaildata);              
               }
            }
         }
       
         Session::flash('ordersuccess','Order Completed sucessfully. Tracking ID:'.$order->order_number);
         return redirect()->route('front.trackOrder');

         

      } else {
         $payment = Order::where('user_id', $custom)
            ->where('order_number', $item_number)->first();
         VendorOrder::where('order', '=', $payment->id)->delete();
         $payment->delete();

         Session::forget('cart');
         return redirect()->back()->with('unsuccess', 'Payment Cancelled.');
      }
   }


   // Capcha Code Image
   private function  code_image()
   {
      // $actual_path = str_replace('project','',base_path());
      // $image = imagecreatetruecolor(200, 50);
      // $background_color = imagecolorallocate($image, 255, 255, 255);
      // imagefilledrectangle($image,0,0,200,50,$background_color);

      // $pixel = imagecolorallocate($image, 0,0,255);
      // for($i=0;$i<500;$i++)
      // {
      //     imagesetpixel($image,rand()%200,rand()%50,$pixel);
      // }

      // $font = $actual_path.'assets/front/fonts/NotoSans-Bold.ttf';
      // $allowed_letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
      // $length = strlen($allowed_letters);
      // $letter = $allowed_letters[rand(0, $length-1)];
      // $word='';
      // //$text_color = imagecolorallocate($image, 8, 186, 239);
      // $text_color = imagecolorallocate($image, 0, 0, 0);
      // $cap_length=6;// No. of character in image
      // for ($i = 0; $i< $cap_length;$i++)
      // {
      //     $letter = $allowed_letters[rand(0, $length-1)];
      //     imagettftext($image, 25, 1, 35+($i*25), 35, $text_color, $font, $letter);
      //     $word.=$letter;
      // }
      // $pixels = imagecolorallocate($image, 8, 186, 239);
      // for($i=0;$i<500;$i++)
      // {
      //     imagesetpixel($image,rand()%200,rand()%50,$pixels);
      // }
      // session(['captcha_string' => $word]);
      // imagepng($image, $actual_path."assets/images/capcha_code.png");
   }
}
