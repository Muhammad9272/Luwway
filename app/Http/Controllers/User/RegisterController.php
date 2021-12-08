<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Models\User;
use App\Classes\GeniusMailer;
use App\Models\Notification;
use Auth;
use Illuminate\Support\Facades\Input;
use Validator;

class RegisterController extends Controller
{

     public function showRegisterForm()
    {
    	$user = Auth::user();  
        return view('user.user-reg',compact('user'));
    }

    public function register(Request $request)
    {

    	$gs = Generalsetting::findOrFail(1);

    	if($gs->is_capcha == 1)
    	{
	        $value = session('captcha_string');
	        if ($request->codes != $value){
	            return response()->json(array('errors' => [ 0 => 'Please enter Correct Capcha Code.' ]));    
	        }    		
    	}


        //--- Validation Section

        $rules = [
		        'email'   => 'required|email|unique:users',
		        'password' => 'required|confirmed'
                ];
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

	        $user = new User;
	        $input = $request->all();        
	        $input['password'] = bcrypt($request['password']);
	        $token = md5(time().$request->name.$request->email);
	        $input['verification_link'] = $token;
	        $input['affilate_code'] = md5($request->name.$request->email);

	          if(!empty($request->vendor))
	          {
					//--- Validation Section
					$rules = [
						'shop_name' => 'unique:users',
						'shop_number'  => 'max:10'
							];
					$customs = [
						'shop_name.unique' => 'This Shop Name has already been taken.',
						'shop_number.max'  => 'Shop Number Must Be Less Then 10 Digit.'
					];

					$validator = Validator::make($request->all(), $rules, $customs);
					if ($validator->fails()) {
					return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
					}
					$input['is_vendor'] = 1;

			  }
			  
			$user->fill($input)->save();
	        if($gs->is_verification_email == 1)
	        {   if($gs->is_smtp == 1)
                {
		            $emaildata = [
	                'to' => $user->email,
	                'type' => "verify_email",
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
          	return response()->json('We need to verify your email address. We have sent an email to '.$to.' to verify your email address. Please click link in that email to continue.');
	        }
	        else {

            $user->email_verified = 'Yes';
            $user->update();
	        $notification = new Notification;
	        $notification->user_id = $user->id;
	        $notification->save();
            Auth::guard('web')->login($user); 
          	return response()->json(1);
	        }

    }

    public function token($token)
    {
        $gs = Generalsetting::findOrFail(1);

        if($gs->is_verification_email == 1)
	        {    	
        $user = User::where('verification_link','=',$token)->first();
        if(isset($user))
        {
            $user->email_verified = 'Yes';
            $user->update();
	        $notification = new Notification;
	        $notification->user_id = $user->id;
	        $notification->save();

            //Sending Email To Partner
            if($gs->is_smtp == 1)
            {
                $emaildata = [
                'to' => $user->email,
                'type' => $user->is_vendor==2?"new_vendor_registration":"new_registration",
                'cname' => $user->name,
                'oamount' => "",
                'aname' => "",
                'aemail' => "",
                'onumber' => "",
                'token' => "",
                ];    
                $mailer = new GeniusMailer();
                $mailer->sendAutoMail($emaildata);
            }



            Auth::guard('web')->login($user); 
            if($user->is_vendor==2){
              return redirect()->route('vendor-dashboard')->with('success','Email Verified Successfully');
            }else{
            	return redirect()->route('user-dashboard')->with('success','Email Verified Successfully');
            }
            
            
        }
    		}
    		else {
    		return redirect()->back();	
    		}
    }
}