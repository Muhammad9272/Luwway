<?php

namespace App\Http\Controllers\Front;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Childcategory;
use App\Models\Conversation;
use App\Models\Country;
use App\Models\Generalsetting;
use App\Models\Message;
use App\Models\Order;
use App\Models\Product;
use App\Models\Rating;
use App\Models\ShopClick;
use App\Models\Subcategory;
use App\Models\Subscription;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class VendorController extends Controller
{



    public function index(Request $request)
    {   
      $datapag = $request->all();
      $sort = $request->sort;
      $country_id= $request->country;

      $search_rest=$request->searchstore;
      $stores = User::when($country_id, function ($query, $country_id) {
                                          if(!is_null($country_id)){
                                           return $query->where('country_id','=',$country_id);
                                            }
                                      })
                                     ->when($search_rest, function ($query, $search_rest) {
                                      return $query->where('shop_name','LIKE',"%{$search_rest}%");
                                     })
                                     ->when($sort, function ($query, $sort) {
                                          if ($sort=='latest') {
                                            return $query->orderBy('id', 'DESC');
                                          }
                                          elseif($sort=='old') {
                                            return $query->orderBy('id', 'ASC');
                                          }
                                      })
                                    ->when(empty($sort), function ($query, $sort) {
                                         $query->orderBy('id', 'DESC')->get();
                                    });

        $stores=$stores->where('is_vendor',2)->has('products')->paginate(30);       
        $countries =Country::all();
        $token=1;
        return view('front.store-list',compact('stores','countries','token','country_id','sort','search_rest','datapag'));
    }



    public function show(Request $request,$store_name ,$slug=null, $slug1=null, $slug2=null)
    {
      $store_name = str_replace('-',' ', $store_name);
      $datapag = $request->all();
      $cat = null;
      $subcat = null;
      $childcat = null;
      $sort = $request->sort;
      $search = $request->search;
      $store=User::where('shop_name','=',$store_name)->with('countryy','state')->firstOrFail();
      $store->views+=1;
      $store->update();

        $shop_click =  new ShopClick;
        $shop_click->store_id=$store->id;
        $shop_click->vendor=2;
        $shop_click->save();

      if (!empty($slug)) {
        $cat = Category::where('slug', $slug)->firstOrFail();
        $data['cat'] = $cat;
      }
      if (!empty($slug1)) {
        $subcat = Subcategory::where('slug', $slug1)->firstOrFail();
        $data['subcat'] = $subcat;
      }
      if (!empty($slug2)) {
        $childcat = Childcategory::where('slug', $slug2)->firstOrFail();
        $data['childcat'] = $childcat;
      }

      $prods = Product::when($cat, function ($query, $cat) {

                                          return $query->where('category_id', $cat->id);
                                      })
                                      ->when($subcat, function ($query, $subcat) {
                                          return $query->where('subcategory_id', $subcat->id);
                                      })
                                      ->when($childcat, function ($query, $childcat) {
                                          return $query->where('childcategory_id', $childcat->id);
                                      })
                                    ->when($search, function ($query, $search) {
                                      return $query->where('name','LIKE',"%{$search}%");
                                     })

                                   ->when($sort, function ($query, $sort) {
                                      if ($sort=='date_desc') {
                                        return $query->orderBy('id', 'DESC');
                                      }
                                      elseif($sort=='date_asc') {
                                        return $query->orderBy('id', 'ASC');
                                      }
                                      elseif($sort=='price_desc') {
                                        return $query->orderBy('price', 'DESC');
                                      }
                                      elseif($sort=='price_asc') {
                                        return $query->orderBy('price', 'ASC');
                                      }
                                   })
                                  ->when(empty($sort), function ($query, $sort) {
                                      return $query->orderBy('id', 'DESC');
                                  })->where('status', 1)->where('user_id', $store->id)->get();
        
        $products = (new Collection(Product::filterProducts($prods)))->paginate(9);

        $ccategories=Category::where('status',1)->get();
        return view('front.store-detail',compact('store','products','sort','search','ccategories','datapag'));

    }

    public function vendortype($value='')
    {
        $packs=Subscription::take(3)->get();
        return view('front.vendor_types',compact('packs'));
    }

    //Send email to user
    public function vendorcontact(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $vendor = User::findOrFail($request->vendor_id);
        $gs = Generalsetting::findOrFail(1);
            $subject = $request->subject;
            $to = $vendor->email;
            $name = $request->name;
            $from = $request->email;
            $msg = "Name: ".$name."\nEmail: ".$from."\nMessage: ".$request->message;
        if($gs->is_smtp)
        {
            $data = [
                'to' => $to,
                'subject' => $subject,
                'body' => $msg,
            ];

            $mailer = new GeniusMailer();
            $mailer->sendCustomMail($data);
        }
        else{
            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
            mail($to,$subject,$msg,$headers);
        }


    $conv = Conversation::where('sent_user','=',$user->id)->where('subject','=',$subject)->first();
        if(isset($conv)){
            $msg = new Message();
            $msg->conversation_id = $conv->id;
            $msg->message = $request->message;
            $msg->sent_user = $user->id;
            $msg->save();
        }
        else{
            $message = new Conversation();
            $message->subject = $subject;
            $message->sent_user= $request->user_id;
            $message->recieved_user = $request->vendor_id;
            $message->message = $request->message;
            $message->save();
            $msg = new Message();
            $msg->conversation_id = $message->id;
            $msg->message = $request->message;
            $msg->sent_user = $request->user_id;;
            $msg->save();

        }
    }

        public function vendorreviewsubmit(Request $request)
        {
            $ck = 0;
            $orders = Order::where('user_id','=',$request->user_id)->where('status','=','completed')->get();


            if(count($orders)>0)
            {
                $user = Auth::guard('web')->user();
                $prev = Rating::where('vendor_id','=',$request->vendor_id)->where('user_id','=',$user->id)->get();
                if(count($prev) > 0)
                {
                return response()->json(array('errors' => [ 0 => 'You Have Reviewed Already.' ]));
                }
                $Rating = new Rating;
                $Rating->fill($request->all());
                $Rating->vendor_id=$request->vendor_id;
                $Rating->product_id=000;
                $Rating['review_date'] = date('Y-m-d H:i:s');
                $Rating->save();
                $data[0] = 'Your Rating Submitted Successfully.';
                $data[1] = Rating::rating($request->vendor_id);
                return response()->json($data);
            }
            else{
                return response()->json(array('errors' => [ 0 => 'Buy Product First' ]));
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
