<?php

namespace App\Models;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    protected $fillable = ['fname','lname','name','photo','zip','city','country','country_id','state_id', 'address', 'phone', 'fax', 'email','password','gender','affilate_code','verification_link','shop_name','owner_name','shop_number','shop_address','reg_number','shop_message','is_vendor','shop_details','shop_image','f_url','g_url','t_url','l_url','y_url','p_url','i_url','f_check','g_check','t_check','l_check','y_check','p_check','i_check','shipping_cost','date','mail_sent'];


    protected $hidden = [
        'password', 'remember_token'
    ];

    public function IsVendor(){
        if ($this->is_vendor == 2) {
           return true;
        }
        return false;
    }

    public function VendorSchedule()
    {

          return $this->hasOne('App\Models\VendorSchedule','vendor_id');
    }    

    public function IsStoreOpen(){
    
            $store_id=$this->id;
            $user=User::where('id',$store_id)->first();
            $data=$user->VendorSchedule;
            $day=Carbon::now()->format('l');

            if($day=="Monday"){
              if($data->closed1==1){ return false;}               
              else{
                 return Carbon::now()->between(
                        Carbon::parse($data->opening1), 
                        Carbon::parse($data->closing1)
                    );
              }
            }
            elseif($day=="Tuesday"){
              if($data->closed2==1){ return false;}               
              else{
                 return Carbon::now()->between(
                        Carbon::parse($data->opening2), 
                        Carbon::parse($data->closing2)
                    );
              }
            }
            elseif($day=="Wednesday"){
              if($data->closed3==1){ return false;}               
              else{
                 return Carbon::now()->between(
                        Carbon::parse($data->opening3), 
                        Carbon::parse($data->closing3)
                    );
              }
            }
            elseif ($day=="Thursday") {
              if($data->closed4==1){ return false;}               
              else{
                 return Carbon::now()->between(
                        Carbon::parse($data->opening4), 
                        Carbon::parse($data->closing4)
                    );
              }
            } 
            elseif ($day=="Friday") {
              if($data->closed5==1){ return false;}               
              else{
                 return Carbon::now()->between(
                        Carbon::parse($data->opening5), 
                        Carbon::parse($data->closing5)
                    );
              }
            }   
            elseif ($day=="Saturday") {
              if($data->closed6==1){ return false;}               
              else{
                 return Carbon::now()->between(
                        Carbon::parse($data->opening6), 
                        Carbon::parse($data->closing6)
                    );
              }
            } 
            elseif ($day=="Sunday"){
              if($data->closed7==1){ return false;}               
              else{
                
                 return Carbon::now()->between(
                        Carbon::parse($data->opening7), 
                        Carbon::parse($data->closing7)
                    );
              }
            }  
        
    }

    public function state()
    {
        return $this->belongsTo('App\Models\State','state_id');
    }
 

    public function countryy()
    {
        return $this->belongsTo('App\Models\Country','country_id');
    } 

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function replies()
    {
        return $this->hasMany('App\Models\Reply');
    }

    public function ratings()
    {
        return $this->hasMany('App\Models\Rating');
    }
    
    public function Vendorratings()
    {
        return $this->hasMany('App\Models\Rating','vendor_id');
    }

    public function wishlists()
    {
        return $this->hasMany('App\Models\Wishlist');
    }

    public function socialProviders()
    {
        return $this->hasMany('App\Models\SocialProvider');
    }

    public function withdraws()
    {
        return $this->hasMany('App\Models\Withdraw');
    }

    public function conversations()
    {
        return $this->hasMany('App\Models\AdminUserConversation');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }

    // Multi Vendor

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function services()
    {
        return $this->hasMany('App\Models\Service');
    }

    public function senders()
    {
        return $this->hasMany('App\Models\Conversation','sent_user');
    }

    public function recievers()
    {
        return $this->hasMany('App\Models\Conversation','recieved_user');
    }

    public function notivications()
    {
        return $this->hasMany('App\Models\UserNotification','user_id');
    }

    public function subscribes()
    {
        return $this->hasMany('App\Models\UserSubscription');
    }

    public function favorites()
    {
        return $this->hasMany('App\Models\FavoriteSeller');
    }

    public function vendororders()
    {
        return $this->hasMany('App\Models\VendorOrder','user_id');
    }

    public function shippings()
    {
        return $this->hasMany('App\Models\Shipping','user_id');
    }

    public function packages()
    {
        return $this->hasMany('App\Models\Package','user_id');
    }

    public function reports()
    {
        return $this->hasMany('App\Models\Report','user_id');
    }

    public function verifies()
    {
        return $this->hasMany('App\Models\Verification','user_id');
    }

    public function checkVerification()
    {
        return count($this->verifies) > 0 ? 
        (empty($this->verifies()->where('admin_warning','=','0')->orderBy('id','desc')->first()->status) ? false : ($this->verifies()->orderBy('id','desc')->first()->status == 'Pending' ? true : false)) : false;
    }

    public function checkStatus()
    {
        return count($this->verifies) > 0 ? ($this->verifies()->orderBy('id','desc')->first()->status == 'Verified' ? true : false) :false;
    }

    public function checkWarning()
    {
        return count($this->verifies) > 0 ? ( empty( $this->verifies()->where('admin_warning','=','1')->orderBy('id','desc')->first() ) ? false : (empty($this->verifies()->where('admin_warning','=','1')->orderBy('id','desc')->first()->status) ? true : false) ) : false;
    }

    public function displayWarning()
    {
        return $this->verifies()->where('admin_warning','=','1')->orderBy('id','desc')->first()->warning_reason;
    }

}
