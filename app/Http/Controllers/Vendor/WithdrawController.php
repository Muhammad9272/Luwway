<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Generalsetting;
use App\Models\User;
use App\Models\Withdraw;
use Auth;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

  	public function index()
    {
        $withdraws = Withdraw::where('user_id','=',Auth::guard('web')->user()->id)->where('type','=','vendor')->orderBy('id','desc')->get();
        $sign = Currency::where('is_default','=',1)->first();        
        return view('vendor.withdraw.index',compact('withdraws','sign'));
    }


    public function create()
    {

        $data = Auth::user(); 
        $countries=Country::all();
        
        $sign = Currency::where('is_default','=',1)->first();
        return view('vendor.withdraw.create' ,compact('sign','data','countries'));
    }


    public function store(Request $request)
    {

        $from = User::findOrFail(Auth::guard('web')->user()->id);

        $withdrawcharge = Generalsetting::findOrFail(1);
        $charge = $withdrawcharge->withdraw_fixedprice;
        $total =$withdrawcharge->withdraw_fee+ $withdrawcharge->withdraw_charge;

        if($request->amount > 0){

            $amount = $request->amount;

            if ($from->current_balance >= $amount){
                $fee = (($total / 100) * $amount) + $charge;
                $finalamount = $amount - $fee;
                $finalamount = number_format((float)$finalamount,2,'.','');

                $from->current_balance = $from->current_balance - $amount;
                $from->update();

                $newwithdraw = new Withdraw();
                $newwithdraw['user_id'] = Auth::user()->id;
                $newwithdraw['method'] = $request->methods;
                $newwithdraw['acc_email'] = $request->acc_email;
                $newwithdraw['iban'] = $request->iban;
                $newwithdraw['country'] = $request->acc_country;
                $newwithdraw['acc_name'] = $request->acc_name;
                $newwithdraw['address'] = $request->address;
                $newwithdraw['swift'] = $request->swift;
                $newwithdraw['reference'] = $request->reference;
                $newwithdraw['amount'] = $finalamount;
                $newwithdraw['fee'] = $fee;

                if($request->methods=="MoneyGram" || $request->methods=="Western_union"){
                    $newwithdraw['fname'] = $request->fname;
                    $newwithdraw['mname'] = $request->mname;
                    $newwithdraw['lname'] = $request->lname;
                    $newwithdraw['phone_no'] = $request->phone_no;
                    $newwithdraw['aaddress'] = $request->aaddress;
                    $newwithdraw['country_id'] = $request->country_id;
                    $newwithdraw['state_id'] = $request->state_id;
                    $newwithdraw['city'] = $request->city;
                    $newwithdraw['aemail'] = $request->aemail;
                    $newwithdraw['zip_code'] = $request->zip_code;
                }
                $newwithdraw['type'] = 'vendor';

                $newwithdraw->save();
                

                 //return response()->json(array('errors' => [ 0 => 'Insufficient Balance.' ])); 
                return response()->json('Withdraw Request Sent Successfully.'); 

            }else{
                 return response()->json(array('errors' => [ 0 => 'Insufficient Balance.' ])); 
            }
        }
            return response()->json(array('errors' => [ 0 => 'Please enter a valid amount.' ])); 

    }
}
