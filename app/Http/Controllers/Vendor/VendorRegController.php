<?php

namespace App\Http\Controllers\Vendor;

use App\Classes\GeniusMailer;
use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Generalsetting;
use App\Models\Subscription;
use App\Models\User;
use App\Models\UserSubscription;
use Auth;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use Session;

class VendorRegController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

   public function showVendorLoginForm()
   {
   	 return view('vendor.login');
   }	
   public function showRegisterForm()
   { $gs=Generalsetting::firstOrFail();   
     if($gs->reg_vendor!=1){
       return redirect()->back();
     }
        $countries =Country::all();
        $plan=Subscription::where('price','<=',0)->orderBy('id','desc')->first();
        return view('front.vendor-reg',compact('countries','plan'));
   }
   public function register(Request $request)
   {   
       //dd(7678);
       $this->validate($request,[

                'email'   => 'required|email|unique:users',
                'shop_address' => 'required',
                'shop_name' => 'required|unique:users',

       ]);
       

        $gs = Generalsetting::findOrFail(1);
        $user = new User();
        $input = $request->all();


        if ($file = $request->file('photo')) 
        {              
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images/users/',$name);          
            $input['photo'] = $name;
        } 
        if ($file = $request->file('shop_image')) 
        {              
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images/vendors/',$name);          
            $input['shop_image'] = $name;
        } 

        $input['password']=bcrypt($request->password);
        $input['reg_number']=str_random(6).rand(1128,9850);        
        $input['shop_number']=$request->phone;
        $input['is_vendor']=1;
        
        $token = md5(time().$request->name.$request->email);
        $input['verification_link'] = $token;
        $input['affilate_code'] = md5($request->name.$request->email);


        $user->fill($input)->save();
        //--- Logic Section Ends

         //Add subscription
            $subs=Subscription::where('price','<=',0)->orderBy('id','desc')->first();
            $today = Carbon::now()->format('Y-m-d');
            $date = date('Y-m-d', strtotime($today.' + '.$subs->days.' days')); 
            $user->is_vendor = 2;
            $user->date = date('Y-m-d', strtotime($today.' + '.$subs->days.' days'));    
            $user->update();

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
            $sub->method = "Free";
            $sub->status = 1;
            $sub->save();
         //End subscription

            if($gs->is_verification_email == 1)
            {
                $to=$user->email;
                //Sending Email To Member
                if($gs->is_smtp == 1)
                {
                    $emaildata = [
                    'to' => $user->email,
                    'type' => "vendor_verify_email",
                    'cname' => $user->name,
                    'oamount' => "",
                    'aname' => "",
                    'aemail' => "",
                    'onumber' => "",
                    'token' => $token,
                    ];    
                    $mailer = new GeniusMailer();
                    $mailer->sendAutoMail($emaildata);
                }           
                else
                {
                $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
                mail($to,"7897","78",$headers);
                }
                
                Session::flash('success', "We need to verify your email address. We have sent an email to "
                    .$to." to verify your email address. Please click link in that email to continue.");
                return redirect()->route('user.login');
               
            }

            else {

            $user->email_verified = 'Yes';
            $user->update();
            $notification = new Notification;
            $notification->user_id = $user->id;
            $notification->save();
            Auth::guard('web')->login($user); 
             return redirect()->route('vendor-dashboard');
            }

   }

}
