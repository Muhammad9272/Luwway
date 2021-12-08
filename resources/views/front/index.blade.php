
@extends('front.layouts.app')
@section('pagelevel_css')

<style type="text/css">
/*#homepage-1 .ps-site-features {
    padding-bottom: 50px !important;
    padding-top: 50px !important;
}*/

.ps-best-sale-brands .ps-image-list li {
  border: 1px solid rgba(0, 0, 0, 0.15) !important;
}
.ps-best-sale-brands .ps-image-list {
  border-bottom: none !important;
  border-right: none !important;
  }
  .ps-container{
    padding: 0 50px !important;
  }
  .card1
  {
    height: 100%;
    background-color: #ececec;
  }
  .card2{
    background-color: white;
    -webkit-box-shadow: 0px 3px 9.5px 0.5px rgba(0, 0, 0, 0.3);
  }
  /*.inline-in-mob{
    display: inline-flex;
  }*/
</style>
<link rel="stylesheet" href="{{asset('assets/front/css/furniture.css?version=9')}}">
@endsection
@section('page_content')
<div id="homepage-1"> 
 

  @if($gs->is_video_slider==1)
  <div class="container">  
    <div class="row">
      <div class="col-sm-12" > 
          <div class="swiper-slide" data-vide-bg="{{asset('assets/images/sliders/'.$video_slider->video)}}" data-vide-options="position: 0% 50%" style="height:auto;position:relative;">
          </div>
      </div>
    </div>
  </div>
  @else
    @if($ps->slider == 1)
      <div class="container">
        <div class="ps-carousel--nav-inside owl-slider " data-owl-auto="true" data-owl-loop="{{$sliders->count()>1?'true':'false'}}" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="{{$sliders->count()>1?'true':'false'}}" data-owl-dots="true" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on" data-owl-animate-in="fadeIn" data-owl-animate-out="fadeOut">

          @foreach($sliders as $data)
          
          <div class="ps-banner--furniture ps-banner--furniture-mob" >

            <a href="{{$data->link}}"><img style="height: 403px" src="{{asset('assets/images/sliders/'.$data->photo)}}" alt=""></a>
            @if(!$data->title_text && !$data->details_text && !$data->subtitle_anime)
            @else
              <div class="ps-banner__content {{$data->position}}">
                  @if($data->title_text)
                  <h3 style="font-size: {{$data->title_size}}px; color: {{$data->title_color}}" class="title title{{$data->id}}" data-animation="animated {{$data->title_anime}}">{{$data->title_text}}</h3><br/> 
                  @endif
                  @if($data->details_text)
                  <p style="font-size: {{$data->details_size}}px; color: {{$data->details_color}}"  class="text text{{$data->id}}" data-animation="animated {{$data->details_anime}}">{{$data->details_text}}</p>
                  @endif
                  @if($data->link && $data->subtitle_anime) 
                    <a class="ps-btn" style="background: {{$data->subtitle_color}}" href="{{$data->link}}"><span>
                     @if($data->subtitle_anime)
                    {{$data->subtitle_anime}}
                    @else
                    {{ $langg->lang25 }} 
                    @endif
                    <i class="fas fa-chevron-right"></i></span></a>
                  @endif
              </div>
              @endif
          </div>
         
          @endforeach
        </div>
      </div>
    @endif 
  @endif
   


      
    <div class="ps-section__content ps-section__content12" id="pointed-area11s">
      <div class="container">
        <div class="">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 dg-cards" >
            <div class="row">
              
              @foreach ($homeCards as $homeCard)
                <div class="col-4 col-md-4 col-lg-4 col-xl-4 dg-cards-content ">
                    <div class="dg-cards-content1">
                      <p>{{$homeCard->title}}</p>
                      <div class="card-img-bot">
                        <div class="card-bot-img">
                        <img  style="" src="{{asset('assets/images/reviews/'.$homeCard->photo)}}"></div>
                        <p>{{$homeCard->subtitle}}</p>
                      </div>
                      <div class="view-more">
                        <a href="{{$homeCard->details}}">View more</a>
                      </div>
                    </div>                     
                </div>

              @endforeach

            </div>

          </div>
        </div>
      </div>
    </div>
    <div class="ps-section__content ps-section__content12" id="pointed-area-mob" style="display: none">
        @foreach ($homeCards as $homeCard)
          <div class="col-12">
            <div class="dg-cards-content ">
                <div class="dg-cards-content1 dg-cards-content1-mob">
                  <p style="font-size: 17px">{{$homeCard->title}}</p>
                  <div class="card-img-bot ">
                    <div class="card-bot-img">
                    <img  style="" src="{{asset('assets/images/reviews/'.$homeCard->photo)}}"></div>
                    <p style="min-height: 27px">{{$homeCard->subtitle}}</p>
                  </div>
                  <div class="view-more">
                    <a href="{{$homeCard->details}}">View more</a>
                  </div>
                </div>                     
            </div>
          </div>    
        @endforeach                               
    </div>

      
     
       
    @if(isset($recent_viewed) && count($recent_viewed)>0)
      <!-- Recent view  -->
      <div class="ps-section--furniture ps-home-shop-by-room most-pop-pc mt-40" >
        <div class="container">  
          <div class="ps-section__header text-left" >
            <h3 class="homeheading">Recently Viewed</h3>
                <span  class="mob-float float-right">
                  
                </span>
          </div>
          <div class="ps-section__content">
            <div class="ps-carousel--nav owl-slider" data-owl-auto="false" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="5" data-owl-nav="true" data-owl-dots="true" data-owl-item="5" data-owl-item-xs="2" data-owl-item-sm="3" data-owl-item-md="3" data-owl-item-lg="4" data-owl-duration="1000" data-owl-mousedrag="on">
              @foreach($recent_viewed as $feature_product)                 
              <div class="product_pc_padding" >              
               @include('includes.product.product')
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
      <!-- Recent view -->

      <!-- Recent view on moblie view -->
      <div class="ps-section--furniture ps-home-shop-by-room most-pop-mob mt-40" >
        <div class="container"> 
          <div class="ps-section__header">
            <div class="ps-block--countdown-deal">
              <div class="ps-block__left">
                <p class="homeheading_mob">Recently Viewed</p>
              </div>                            
            </div>
          </div>

          <div class="ps-section__content">
            <div class="row">
              @foreach($recent_viewed->take(4) as $key=>$feature_product)                 
                  @include('includes.product.product')
              @endforeach
            </div>
          </div>
        </div>
      </div>
      <!-- Recent view on moblie view ends -->
    @endif
     
      
    @if( count($new_arrivals)>0)

      <!-- new_arrivals on the top self -->
      <div class="ps-section--furniture ps-home-shop-by-room most-pop-pc mt-40" >
        <div class="container">  
          <div class="ps-section__header text-left" >
            <h3 class="homeheading">New Arrival</h3>
                <span  class="mob-float float-right">
                  <p class="viewmore"><a href="{{route('front.category')}}">View more</a></p>
                </span>
           </div>
          <div class="ps-section__content row">
            <div class="ps-carousel--nav owl-slider" data-owl-auto="false" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="5" data-owl-nav="true" data-owl-dots="true" data-owl-item="5" data-owl-item-xs="2" data-owl-item-sm="3" data-owl-item-md="3" data-owl-item-lg="4" data-owl-duration="1000" data-owl-mousedrag="on" lazyload="true"> 
              @foreach($new_arrivals as $feature_product) 
                <div class="product_pc_padding" >              
                 @include('includes.product.product')
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
      <!-- end new_arrivals self -->

      <!-- new arrival on moblie view -->
      <div class="ps-section--furniture ps-home-shop-by-room most-pop-mob mt-40" >
        <div class="container">  
          <div class="ps-section__header">
            <div class="ps-block--countdown-deal">
              <div class="ps-block__left">
                <p class="homeheading_mob">New arrival</p>
              </div>
              <div class="ps-block__right ml-53p" >
                <a style="color: #2784d6" href="{{route('front.category')}}">view more</a>
              </div>               
            </div>
          </div>

          <div class="ps-section__content">
            <div class="row">
              @foreach($new_arrivals->take(4) as $key=>$feature_product)              
                <div class="col-6" style="{{$key%2==0?"padding-right: 4px":"padding-left: 4px"}}" >
                    @include('includes.product.product')
                </div>
              @endforeach
            </div>
          </div>

        </div>
      </div>
       <!-- new arrival on moblie view ends -->
    @endif   


      
      <div class="ps-promotions" style="padding:40px 0 ">
          @foreach($top_banners as $banner)
            <div class="container mt-10"><a class="ps-collection" href="{{$banner->link}}"><img src="{{asset('assets/images/banners/'.$banner->photo)}}" alt=""></a></div>
          @endforeach
      </div>

      @if($ps->featured == 1 && count($most_populars)>0)
        <!--Most Popular Products -->
        <div class="ps-section--furniture ps-home-shop-by-room most-pop-pc mt-40" >
          <div class="container">  
            <div class="ps-section__header text-left" >
              <h3 class="homeheading">Most Popular</h3>
                  <span  class="mob-float float-right">
                    <p class="viewmore"><a href="{{route('front.category')}}">View more</a></p>
                  </span>
             </div>
            <div class="ps-section__content">
              <div class="ps-carousel--nav owl-slider" data-owl-auto="false" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="5" data-owl-nav="true" data-owl-dots="true" data-owl-item="5" data-owl-item-xs="2" data-owl-item-sm="3" data-owl-item-md="3" data-owl-item-lg="4" data-owl-duration="1000" data-owl-mousedrag="on">
                @foreach($most_populars as $feature_product)
                   <div class="product_pc_padding" >              
                     @include('includes.product.product')
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
        <!-- Most Popular Products ends -->


        <!--Most Popular Products on mobile view -->
        <div class="ps-section--furniture ps-home-shop-by-room most-pop-mob mt-40" >
          <div class="container">  
            <div class="ps-section__header">
              <div class="ps-block--countdown-deal">
                <div class="ps-block__left">
                  <p class="homeheading_mob">Most Popular</p>
                </div>
                <div class="ps-block__right ml-53p" >
                  <a style="color: #2784d6" href="{{route('front.category')}}">view more</a>
                </div>               
              </div>
            </div>

            <div class="ps-section__content">
              <div class="row">
                @foreach($most_populars->take(4) as $key=>$feature_product)              
                  <div class="col-6" style="{{$key%2==0?"padding-right: 4px":"padding-left: 4px"}}" >
                      @include('includes.product.product')
                  </div>
                @endforeach
              </div>
            </div>

          </div>
        </div>
         <!--Most Popular Products on mobile view ends -->
      @endif


      
      <div class="ps-section--furniture ps-home-shop-by-room ">
        <div class="container">  
          <div class="ps-section__header">
            <h3 class="serif">Top Categories</h3>
           </div>
          <div class="ps-section__content">
            <div class="row">
              @foreach($categories as $category)
               @if($category->is_featured )
                <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-4 ">
                  <div class="">
                    <div class="" ><a href="{{ route('front.category',$category->slug) }}"><img  style="border-radius: 50%" src="{{asset('assets/images/categories/'.$category->image)}}"  alt=""></a></div>
                    <div style="padding: 6px 0px 10px 0px;" class="ps-block__contenwt"><a href="{{ route('front.category',$category->slug) }}">{{$category->name}}</a></div>
                  </div>
                </div>
                @endif
              @endforeach

              @foreach($subcategories as $subcat)
                <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-4 ">
                  <div class="">
                    <div class=""><a href="{{ route('front.subcat',['slug1' => $subcat->category->slug, 'slug2' => $subcat->slug]) }}"><img  style="border-radius: 50%"src="{{asset('assets/images/categories/'.$subcat->image)}}"  alt=""></a></div>
                    <div style="padding: 6px 0px 10px 0px;" class="ps-block__contenwt"><a href="{{ route('front.subcat',['slug1' => $subcat->category->slug, 'slug2' => $subcat->slug]) }}">{{$subcat->name}}</a></div>
                  </div>
                </div>
              @endforeach

            </div>
          </div>
        </div>
      </div>

      <div class="ps-promotions" style="padding:60px 0 ">
          @foreach($mid_banners as $banner)
            <div class="container mt-10"><a class="ps-collection" href="{{$banner->link}}"><img src="{{asset('assets/images/banners/'.$banner->photo)}}" alt=""></a></div>
          @endforeach
      </div>

      @if($ps->best == 1 && count($best_sellers)>0)

        <!--Best Seller Products -->
        <div class="ps-section--furniture ps-home-shop-by-room most-pop-pc mt-40" >
          <div class="container">  
            <div class="ps-section__header text-left" >
              <h3 class="homeheading">Best Sellers</h3>
                  <span  class="mob-float float-right">
                    <p class="viewmore"><a href="{{route('front.category')}}">View more</a></p>
                  </span>
             </div>
            <div class="ps-section__content">
              <div class="ps-carousel--nav owl-slider" data-owl-auto="false" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="5" data-owl-nav="true" data-owl-dots="true" data-owl-item="5" data-owl-item-xs="2" data-owl-item-sm="3" data-owl-item-md="3" data-owl-item-lg="4" data-owl-duration="1000" data-owl-mousedrag="on">
                @foreach($best_sellers as $feature_product)
                   <div class="product_pc_padding" >              
                     @include('includes.product.product')
                   </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
        <!-- Best Seller Products ends -->


        <!--Best Seller Products on mobile view -->
        <div class="ps-section--furniture ps-home-shop-by-room most-pop-mob mt-40" >
          <div class="container">  
            <div class="ps-section__header">
              <div class="ps-block--countdown-deal">
                <div class="ps-block__left">
                  <p class="homeheading_mob">Best Sellers</p>
                </div>
                <div class="ps-block__right ml-53p" >
                  <a style="color: #2784d6" href="{{route('front.category')}}">view more</a>
                </div>               
              </div>
            </div>

            <div class="ps-section__content">
              <div class="row">
                @foreach($best_sellers->take(4) as $key=>$feature_product)              
                  <div class="col-6" style="{{$key%2==0?"padding-right: 4px":"padding-left: 4px"}}" >
                      @include('includes.product.product')
                  </div>
                @endforeach
              </div>
            </div>

          </div>
        </div>
         <!--Best Seller Products on mobile view ends -->

      @endif
      
      
      @if($bottom_banners->count()>0)
      <div class="ps-promotions mt-100" > 
        <div class="container">
          <div class="row">
             @foreach($bottom_banners as $banner)
                        <div class="col-12 " style="padding-bottom: 25px"><a class="ps-collection ps-collection-food" href="{{$banner->link}}">
                          <img  src="{{asset('assets/images/banners/'.$banner->photo)}}" alt=""></a>
                        </div>
                         @endforeach

          </div>
        </div>
      </div>
      @endif

      @if(isset($instafeeds['data']))
        <div class="ps-section--furniture ps-home-shop-by-room mt-40 mb-50">
          <div class="container">  
            <div class="ps-section__header" >
              <div>
               <a style="font-size: 25px;" href="{{ App\Models\Socialsetting::find(1)->instagram }}" class="instagram" target="_blank">
                  <i class="fab fa-instagram"></i>
                </a>
              </div>
              <h3 style="display: inline;font-family: serif;text-transform: capitalize;">Luwaay Instagram</h3>
              <hr class="bg-dark">
            </div>

            <div class="ps-section__content">
              <div class="ps-carousel--nav owl-slider" data-owl-auto="false" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="5" data-owl-nav="true" data-owl-dots="true" data-owl-item="5" data-owl-item-xs="2" data-owl-item-sm="3" data-owl-item-md="3" data-owl-item-lg="4" data-owl-duration="1000" data-owl-mousedrag="on">

                @foreach($instafeeds['data'] as $key=>$data)
                  <div class="instafeed box-shadow">
                    <a href="{{$data['permalink']}}" target="_blank">
                      <div class="hovereffect box-shadow mb-10">
                          <img class="img-responsive" src="{{isset($data['thumbnail_url'])?$data['thumbnail_url']:$data['media_url']}}" alt="">
                              <div class="overlay">
                                  <h2><i class="fab fa-instagram"></i></h2>
                          <p>
                            <a href="{{$data['permalink']}}" target="_blank">View Post</a>
                          </p>
                              </div>
                      </div>

                    </a>
                  </div>           
                @endforeach
              </div>
            </div>
              

          </div>
          
        </div>
      @endif


</div>


    <div id="back2top"><i class="pe-7s-angle-up"></i></div>
    <div class="ps-site-overlay"></div>
    <div id="loader-wrapper">
      <img src="{{asset('assets/front/images/loader/loader2.gif')}}">
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
    </div>





@endsection
@section('pagelevel_scripts')

  <script type="text/javascript" src="{{asset('assets/front/video-slider/jquery.vide.js')}}"></script>
<script>
    $(document).ready(function() {
      @if($message = Session::get('ordersuccess'))
        toastr.success({!! json_encode($message) !!});
      @endif
       
    });


</script>


@endsection