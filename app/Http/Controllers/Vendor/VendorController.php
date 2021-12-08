<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Country;
use App\Models\Generalsetting;
use App\Models\Product;
use App\Models\ProductClick;
use App\Models\ShopClick;
use App\Models\Subcategory;
use App\Models\Subscription;
use App\Models\UserNotification;
use App\Models\UserSubscription;
use App\Models\VendorOrder;
use App\Models\VendorSchedule;
use App\Models\Verification;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Session;
use Validator;


class VendorController extends Controller
{

    public $lang;
    public function __construct()
    {

        $this->middleware('auth');

            if (Session::has('language')) 
            {
                $data = DB::table('languages')->find(Session::get('language'));
                $data_results = file_get_contents(public_path().'/assets/languages/'.$data->file);
                $this->lang = json_decode($data_results);
            }
            else
            {
                $data = DB::table('languages')->where('is_default','=',1)->first();
                $data_results = file_get_contents(public_path().'/assets/languages/'.$data->file);
                $this->lang = json_decode($data_results);
                
            } 
    }

    //*** GET Request
    // public function index()
    // {
    //     $user = Auth::user();  
    //     $pending = VendorOrder::where('user_id','=',$user->id)->where('status','=','pending')->get(); 
    //     $processing = VendorOrder::where('user_id','=',$user->id)->where('status','=','processing')->get(); 
    //     $completed = VendorOrder::where('user_id','=',$user->id)->where('status','=','completed')->get(); 
    //     return view('vendor.index',compact('user','pending','processing','completed'));
    // }
    //*** GET Request
    public function index(Request $request)
    {
        $user = Auth::user(); 
        $j=1000;
        $i=1000;

        if(!is_null($request->sortby) ){
          if($request->sortby=="234-7"){
            $j=7;
          }
            elseif($request->sortby=="234-30"){
               $j=30;
            }
            else{
              $j=1000;
            }
        } 
        if(!is_null($request->sort) ){
          if($request->sort=="334-7"){
            $i=7;
          }
            elseif($request->sort=="334-30"){
               $i=30;
            }
            else{
              $i=1000;
            }
        } 


        // dd($user); 
        $pending = VendorOrder::where('user_id','=',$user->id)->where('status','=','pending')->get(); 

        $processing = VendorOrder::where('user_id','=',$user->id)->where('status','=','processing')->get(); 
        $completed = VendorOrder::where('user_id','=',$user->id)->where('status','=','completed')->get(); 

        $expDate = Carbon::now()->subDays($j);
        $clicks=ShopClick::where('store_id',$user->id)->whereDate('created_at', '>',$expDate)->count();

        $ttsales =VendorOrder::where('user_id',$user->id)->where('status','=','completed')->whereDate('created_at', '>',$expDate)->get();
        $not = UserNotification::where('user_id','=',$user->id)->where('is_read','=',0)->get()->count();
        $expDate1 = Carbon::now()->subDays($i);
        $notifications = UserNotification::where('user_id','=',$user->id)->whereDate('created_at', '>',$expDate1)->take(10)->get();
        

        return view('vendor.index',compact('user','pending','processing','completed','j','clicks','ttsales','not','i','notifications'));
    }



    public function profileupdate(Request $request)
    {
        //--- Validation Section
        $rules = [
               'shop_image'  => 'mimes:jpeg,jpg,png,svg',
                ];

        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        $input = $request->all();  
        $data = Auth::user();    

        if ($file = $request->file('shop_image')) 
         {      
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images/vendor/',$name);           
            $input['shop_image'] = $name;
        }

        $data->update($input);
        $msg = 'Successfully updated your profile';
        return response()->json($msg); 
    }

    // Spcial Settings All post requests will be done in this method
    public function socialupdate(Request $request)
    {
        //--- Logic Section
        $input = $request->all(); 
        $data = Auth::user();   
        if ($request->f_check == ""){
            $input['f_check'] = 0;
        }
        if ($request->t_check == ""){
            $input['t_check'] = 0;
        }

        if ($request->g_check == ""){
            $input['g_check'] = 0;
        }

        if ($request->l_check == ""){
            $input['l_check'] = 0;
        }
        $data->update($input);
        //--- Logic Section Ends
        //--- Redirect Section        
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);      
        //--- Redirect Section Ends                

    }

    //*** GET Request
    public function profile()
    {
        $data = Auth::user(); 
        $countries=Country::all();
        $country=Country::where('id',$data->country_id)->first();
        if(!$country){
          $country=Country::firstOrFail();
          $states=$country->states()->get(); 
        }else{
           $states=$country->states()->get(); 
        }
        
        return view('vendor.profile',compact('data','countries','states'));
    }

    //*** GET Request
    public function ship()
    {
        $gs = Generalsetting::find(1);
        if($gs->vendor_ship_info == 0) {
            return redirect()->back();
        }
        $data = Auth::user();  
        return view('vendor.ship',compact('data'));
    }

    //*** GET Request
    public function banner()
    {
        $data = Auth::user();  
        return view('vendor.banner',compact('data'));
    }

    //*** GET Request
    public function social()
    {
        $data = Auth::user();  
        return view('vendor.social',compact('data'));
    }

    //*** GET Request
    public function subcatload($id)
    {
        $cat = Category::findOrFail($id);
        return view('load.subcategory',compact('cat'));
    }

    //*** GET Request
    public function childcatload($id)
    {
        $subcat = Subcategory::findOrFail($id);
        return view('load.childcategory',compact('subcat'));
    }

    //*** GET Request
    public function verify()
    {
        $data = Auth::user();  
        if($data->checkStatus())
        {
            return redirect()->back();
        }
        return view('vendor.verify',compact('data'));
    }

    //*** GET Request
    public function warningVerify($id)
    {
        $verify = Verification::findOrFail($id);
        $data = Auth::user();  
        return view('vendor.verify',compact('data','verify'));
    }

    //*** POST Request
    public function verifysubmit(Request $request)
    {
        //--- Validation Section
        $rules = [
          'attachments.*'  => 'mimes:jpeg,jpg,png,svg|max:10000'
           ];
        $customs = [
            'attachments.*.mimes' => 'Only jpeg, jpg, png and svg images are allowed',
            'attachments.*.max' => 'Sorry! Maximum allowed size for an image is 10MB',
                   ];

        $validator = Validator::make($request->all(), $rules,$customs);
        
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        $data = new Verification();
        $input = $request->all();

        $input['attachments'] = '';
        $i = 0;
                if ($files = $request->file('attachments')){
                    foreach ($files as  $key => $file){
                        $name = time().$file->getClientOriginalName();
                        if($i == count($files) - 1){
                            $input['attachments'] .= $name;
                        }
                        else {
                            $input['attachments'] .= $name.',';
                        }
                        $file->move('assets/images/attachments',$name);

                    $i++;
                    }
                }
        $input['status'] = 'Pending';        
        $input['user_id'] = Auth::user()->id;
        if($request->verify_id != '0')
        {
            $verify = Verification::findOrFail($request->verify_id);
            $input['admin_warning'] = 0;
            $verify->update($input);
        }
        else{

            $data->fill($input)->save();
        }

        //--- Redirect Section        
        $msg = '<div class="text-center"><i class="fas fa-check-circle fa-4x"></i><br><h3>'.$this->lang->lang804.'</h3></div>';
        return response()->json($msg);      
        //--- Redirect Section Ends     
    }

    public function Schedule()
    { 
      $id= Auth::id(); 
      $schedule=VendorSchedule::where('vendor_id','=',$id)->first();
      if($schedule){
        return redirect()->route('vendor-Schedule-edit');
      }
      return view('vendor.schedule.add-schedule');
    }
    public function EditSchedule()
    {
      $id= Auth::id(); 
      $schedule=VendorSchedule::where('vendor_id','=',$id)->firstOrFail();
      return view('vendor.schedule.edit-schedule',compact('schedule'));
    }
     public function ScheduleSave(Request $request)
    {
      $data=new VendorSchedule();
      $input=$request->all();
      $data->vendor_id=Auth::id();
      $data->fill($input)->save();
      //--- Redirect Section
        $msg = 'Data Added Successfully.';
        return response()->json($msg);

    }
     public function UpdateSchedule(Request $request)
    {
        $id= Auth::id(); 
        $data=VendorSchedule::where('vendor_id','=',$id)->firstOrFail();
        $input=$request->all();
       
        if(!$request->has('closed1') ){      
        $input['closed1']=0; }

        if(!$request->has('closed2') ){      
        $input['closed2']=0; }

        if(!$request->has('closed3') ){      
        $input['closed3']=0; }

        if(!$request->has('closed4') ){      
        $input['closed4']=0; }

        if(!$request->has('closed5') ){      
        $input['closed5']=0; }

        if(!$request->has('closed6') ){      
        $input['closed6']=0; }

        if(!$request->has('closed7') ){      
        $input['closed7']=0; }

        $data->update($input);
        //--- Redirect Section
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);

    }

    public function package()
    {
        $user = Auth::user();
        $subs = Subscription::all();
        $package = $user->subscribes()->where('status',1)->orderBy('id','desc')->first();
        return view('vendor.subscription.index',compact('user','subs','package'));
    }


    public function vendorrequest($id)
    {
        $subs = Subscription::findOrFail($id);
        $gs = Generalsetting::findOrfail(1);
        $user = Auth::user();
        $package = $user->subscribes()->where('status',1)->orderBy('id','desc')->first();
        if($gs->reg_vendor != 1)
        {
            return redirect()->back();
        }
        return view('vendor.subscription.details',compact('user','subs','package'));
    }

    public function vendorrequestsub(Request $request)
    {
     
        $user = Auth::user();
        $package = $user->subscribes()->where('status',1)->orderBy('id','desc')->first();
        $subs = Subscription::findOrFail($request->subs_id);
        $settings = Generalsetting::findOrFail(1);
                    $today = Carbon::now()->format('Y-m-d');
                    $input = $request->all();  
                    $user->is_vendor = 2;
                    $user->date = date('Y-m-d', strtotime($today.' + '.$subs->days.' days'));    
                    $user->update($input);
                    
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
                    $sub->method = 'Free';
                    $sub->status = 1;
                    $sub->save();
                    // if($settings->is_smtp == 1)
                    // {
                    // $data = [
                    //     'to' => $user->email,
                    //     'type' => "vendor_accept",
                    //     'cname' => $user->name,
                    //     'oamount' => "",
                    //     'aname' => "",
                    //     'aemail' => "",
                    //     'onumber' => "",
                    // ];    
                    // $mailer = new GeniusMailer();
                    // $mailer->sendAutoMail($data);        
                    // }
                    // else
                    // {
                    // $headers = "From: ".$settings->from_name."<".$settings->from_email.">";
                    // mail($user->email,'Your Vendor Account Activated','Your Vendor Account Activated Successfully. Please Login to your account and build your own shop.',$headers);
                    // }

                    return redirect()->route('vendor-dashboard')->with('success','Vendor Account Activated Successfully');

    }


     public function report(Request $request)
    { 
      $j=30;
      $i=1000;
      if(!is_null($request->sortby) ){
        if($request->sortby=="234-7"){
          $j=7;
        }
          else{
             $j=30;
          }
      }
      if(!is_null($request->sort) ){
          if($request->sort=="334-7"){
            $i=7;
          }
            elseif($request->sort=="334-30"){
               $i=30;
            }
            else{
              $i=1000;
            }
        }  

      $id=Auth::user()->id; 

        $days = "";
        $sales = "";

       for($k = 0; $k < $j; $k++) {
            $days .= "'".date("d M", strtotime('-'. $k .' days'))."',";

            $sales .=  "'".VendorOrder::where('user_id',$id)->where('status','=','completed')->whereDate('created_at', '=', date("Y-m-d", strtotime('-'. $k .' days')))->count()."',";
        }
        $tsales =VendorOrder::where('user_id',$id)->where('status','=','completed')->whereDate('created_at', '>', Carbon::now()->subDays($j))->get();
        $expDate = Carbon::now()->subDays($j);
        $clicks=ProductClick::where('user_id',$id)->whereDate('date', '>',$expDate)->count();

        $ttsales =VendorOrder::where('user_id',$id)->where('status','=','completed')->get();
        $poproducts = Product::where('user_id',$id)->orderBy('views','desc')->take(5)->get();


        $ysales=VendorOrder::where('user_id',$id)->where('status','=','completed')
        ->select(DB::raw('sum(price) as sums'),DB::raw('count(id) as msales'),DB::raw("MONTHNAME(created_at) as monthname"))
        ->whereYear('created_at', date('Y'))
        ->groupBy('monthname')
        // ->orderBy('created_at', 'ASC')
        ->get();
        // foreach($orders as $item=>$order){
        //     $price[]=$order['sums'];
        //     $month[]=$order['monthname'];
        // }

        // dd($venprod);
        // $clicks =$venprod->clicks11->whereDate('date', '>',$expDate)->count('product_id');
        // dd($clicks);
        
        $not = UserNotification::where('user_id','=',$id)->where('is_read','=',0)->get()->count();
        $expDate1 = Carbon::now()->subDays($i);
        $notifications = UserNotification::where('user_id','=',$id)->whereDate('created_at', '>',$expDate1)->take(10)->get();
      
      return view('vendor.report',compact('days','sales','j','tsales','clicks','poproducts','ttsales','ysales','not','notifications','i'));
    }
    public function Policy()
    {   
        $data = Auth::user();
        return view('vendor.policy',compact('data'));
    }

    public function PolicyUpdate(Request $request)
    {
        $user = Auth::user();
        $user->return_policy=$request->policy;
        $user->update();
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);
    }





}
