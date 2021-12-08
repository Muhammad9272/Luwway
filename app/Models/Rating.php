<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['user_id','product_id','review','rating','rate_desc','rate_com','rate_ship','review_date'];
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public static function ratings($productid){
        $stars = Rating::where('product_id',$productid)->avg('rating');
        $ratings = number_format((float)$stars, 1, '.', '')*20;

        if($ratings==10 || $ratings==30 || $ratings==50 || $ratings==70 ||$ratings==90 )
        {
           $ratings+=10;
        }

        return $ratings;
    }

    public static function storeratings($productid){
        $stars = Rating::where('vendor_id',$productid)->avg('rating');
        $ratings = number_format((float)$stars, 1, '.', '')*20;

        if($ratings==10 || $ratings==30 || $ratings==50 || $ratings==70 ||$ratings==90 )
        {
           $ratings+=10;
        }

        return $ratings;
    }

    public static function storeratings13($productid){
        $star1 = Rating::where('vendor_id',$productid)->avg('rate_desc');
        $star2 = Rating::where('vendor_id',$productid)->avg('rate_com');
        $star3 = Rating::where('vendor_id',$productid)->avg('rate_ship');
        $stars=($star1+$star2+$star3)/3; 

        $ratings = number_format((float)$stars, 1, '.', '')*20;


        return $ratings;
    }


    public static function storeratingsfeed($productid){
        $star1 = Rating::where('vendor_id',$productid)->avg('rate_desc');
        $star2 = Rating::where('vendor_id',$productid)->avg('rate_com');
        $star3 = Rating::where('vendor_id',$productid)->avg('rate_ship');
        $stars=($star1+$star2+$star3)/3; 

        $ratings = number_format((float)$stars, 1, '.', '')*20;



        return $ratings;
    }


    public static function rate_desc($productid){
        $stars = Rating::where('vendor_id',$productid)->avg('rate_desc');
        $ratings = number_format((float)$stars, 1, '.', '')*20;
        return $ratings;
    }

    public static function rate_com($productid){
        $stars = Rating::where('vendor_id',$productid)->avg('rate_com');
        $ratings = number_format((float)$stars, 1, '.', '')*20;
        return $ratings;
    }

    public static function rate_ship($productid){
        $stars = Rating::where('vendor_id',$productid)->avg('rate_ship');
        $ratings = number_format((float)$stars, 1, '.', '')*20;
        return $ratings;
    }

////////////////////////////////////
    public static function rate_desc1($productid){
        $stars = Rating::where('vendor_id',$productid)->avg('rate_desc');
        $ratings = number_format((float)$stars, 1, '.', '');
        return $ratings;
    }

    public static function rate_com1($productid){
        $stars = Rating::where('vendor_id',$productid)->avg('rate_com');
        $ratings = number_format((float)$stars, 1, '.', '');
        return $ratings;
    }

    public static function rate_ship1($productid){
        $stars = Rating::where('vendor_id',$productid)->avg('rate_ship');
        $ratings = number_format((float)$stars, 1, '.', '');
        return $ratings;
    }

    public static function rating($productid){
        $stars = Rating::where('product_id',$productid)->avg('rating');
        $stars = number_format((float)$stars, 1, '.', '');
        return $stars;
    }

    public static function storerating($vendor_id){
        $stars = Rating::where('vendor_id',$vendor_id)->avg('rating');
        $stars = number_format((float)$stars, 1, '.', '');
        return $stars;
    }






    public static function ratingss($userid){
        $stars = Rating::where('user_id',$userid)->avg('rating');
        $ratings = number_format((float)$stars, 1, '.', '')*20;
        return $ratings;
    }

        public static function reviewCount($userid){
            
        $count = Rating::where('user_id',$userid)->count();
        
        return $count;
    }

    public static function StoreReviewCount($vendorid){
            
        $count = Rating::where('vendor_id',$vendorid)->count();
        
        return $count;
    }


}
