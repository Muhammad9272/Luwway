@extends('front.layouts.app')
@section('pagelevel_css')
<style type="text/css">
  .product-size .title {
    display: inline-block;
    margin-right: 20px;
    font-size: 15px;
  }
  .siz-list{
    margin-left: -16px;
    display: inline-block;
  }
  .siz-list li{
    display: inline-block;
  }
  .product-size .siz-list li .box{
    height: 26px;
    padding: 0px 8px;
    border: 1px solid #b8c1ca;
    display: inline-block;
    text-align: center;
    line-height: 25px;
    font-size: 14px;
    cursor: pointer;
    font-weight: 600;
  }
  .siz-list li.active .box {
    border: 1px solid #0c6353;
  }
  .product-color{
    margin-top: 0px;
    position: relative;
    margin-bottom: 4px;
  }
  .product-color .title {
    display: inline-block;
    position: absolute;
    top: 50%;
    -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    font-size: 15px;}
    .product-color .color-list {
    display: inline-block;
    padding-left: 70px;
    margin-top: 16px;
    }


    .product-color .color-list li {
    display: inline-block;
    margin-right: 2px;}
    .product-color .color-list li .box {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: inline-block;
    position: relative;
    cursor: pointer;
    }
.color-list li.active .box::after {
    opacity: 1;
}
.ps-btn, button.ps-btn {
  padding: 10px 30px !important;
}
    .color-list li .box::after {
    position: absolute;
    content: "\eed8";
    font-family: IcoFont;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    color: #FFF;
    font-size: 17px;
    opacity: 0;}

    .ps-product-rel{
      border:none !important;
      padding:0px !important;
    }
</style>
<script type="text/javascript" src="{{asset('assets/front/js/ntc.js')}}"></script>
@endsection
@section('page_content')
    
<div class="ps-breadcrumb">
  <div class="ps-container">
    <ul class="breadcrumb">
      <li><a href="{{url('/')}}">Home</a></li>
       @if($productt->category)
      <li><a href="{{route('front.category',$productt->category->slug)}}">{{$productt->category->name}}</a></li>
      @endif
      @if($productt->subcategory)
      <li><a href="{{ route('front.subcat',['slug1' => $productt->category->slug, 'slug2' => $productt->subcategory->slug]) }}">{{$productt->subcategory->name}}</a></li>
      @endif
      @if($productt->childcategory)
      <li><a href="{{ route('front.childcat',['slug1' => $productt->category->slug, 'slug2' => $productt->subcategory->slug, 'slug3' => $productt->childcategory->slug]) }}"> {{$productt->childcategory->name}}</a></li>
      @endif
      <li>{{ $productt->name }}
      </li>          
    </ul>
  </div>
</div> 

      

<div class="ps-page--product">
    <div class="ps-container">
        <div class="ps-page__container">
            <div class="ps-page__left">
                <div class="ps-product--detail ps-product--fullwidth">
                    <div class="ps-product__header">
                        <div class="ps-product__thumbnail" data-vertical="true">
                            <figure>
                                <div class="ps-wrapper">
                                    <div class="ps-product__gallery" data-arrow="true">
                                        <div class="item"><a href="{{asset('assets/images/products/'.$productt->photo)}}"><img src="{{asset('assets/images/products/'.$productt->photo)}}" alt=""></a></div>
                                        @foreach($productt->galleries as $gal)
                                        <div class="item"><a href="{{asset('assets/images/galleries/'.$gal->photo)}}"><img src="{{asset('assets/images/galleries/'.$gal->photo)}}" alt=""></a></div>
                                        @endforeach

                                    </div>
                                </div>
                            </figure>
                            <div class="ps-product__variants" data-item="4" data-md="4" data-sm="4" data-arrow="false">
                                <div class="item"><img src="{{asset('assets/images/products/'.$productt->photo)}}" alt=""></div>
                                @foreach($productt->galleries as $gal)
                                <div class="item"><img src="{{asset('assets/images/galleries/'.$gal->photo)}}" alt=""></div>
                                @endforeach
                            </div>
                        </div>
                        <div class="ps-product__info">
                            <h1>{{$productt->name}}</h1>
                            <div class="ps-product__meta">
                                <div class="ps-product__rating">
                                    <div class="ratings">
                                        <div class="empty-stars"></div>

                                        <div class="full-stars" style="width:{{App\Models\Rating::ratings($productt->id)}}%"></div>

                                    </div>
                                </div>
                                @if($productt->type == 'Physical')
                                    @if($productt->emptyStock())
                                    <p>
                                        <i class="icofont-close-circled"></i>
                                        {{ $langg->lang78 }}
                                    </p>
                                    @else
                                    <p>
                                        <i class="icofont-check-circled"></i>
                                        {{ $gs->show_stock == 0 ? '' : $productt->stock }} {{ $langg->lang79 }}
                                    </p>
                                    @endif
                                @endif
                                <p>{{count($productt->ratings)}} {{ $langg->lang80 }}</p>
                                @if($productt->product_condition != 0)
                                <div class="{{ $productt->product_condition == 2 ? 'mybadge' : 'mybadge1' }}" style="padding:0 10px">
                                    {{ $productt->product_condition == 2 ? 'New' : 'Used' }}
                                </div>
                                @endif
                            </div>
                            <h4 class="ps-product__price">Price &nbsp;: &nbsp;<span id="sizeprice">{{ $productt->showPrice() }}</span>@if($productt->previous_price) 
                                – <del>{{ $productt->showPreviousPrice() }}</del>
                            @endif</h4>
                            @if($productt->youtube != null)
                            View Video:<a href="{{ $productt->youtube }}" class="video-play-btn mfp-iframe">
                                <i class="fas fa-play"></i>
                            </a>
                            @endif
                            <div class="ps-product__desc">

                                <ul class="ps-list--dot">
                                    @if($productt->type == 'License')

                                    @if($productt->platform != null)
                                    <li>
                                        <p>{{ $langg->lang82 }}: <b>{{ $productt->platform }}</b></p>
                                    </li>
                                    @endif

                                    @if($productt->region != null)
                                    <li>
                                        <p>{{ $langg->lang83 }}: <b>{{ $productt->region }}</b></p>
                                    </li>
                                    @endif

                                    @if($productt->licence_type != null)
                                    <li>
                                        <p>{{ $langg->lang84 }}: <b>{{ $productt->licence_type }}</b></p>
                                    </li>
                                    @endif

                                    @endif
                                </ul>
                            </div>
                            <div class="product-size">
                                @if(!empty($productt->size))
                                <p class="title">{{ $langg->lang88 }} :</p>
                                <ul class="siz-list">
                                    @php
                                    $is_first = true;
                                    @endphp
                                    @foreach($productt->size as $key => $data1)
                                    <li class="{{ $is_first ? 'active' : '' }}">
                                        <span class="box">
                                            {{ $data1 }}
                                            <input type="hidden" class="size" value="{{ $data1 }}">
                                            <input type="hidden" class="size_qty" value="{{ $productt->size_qty[$key] }}">
                                            <input type="hidden" class="size_key" value="{{$key}}">
                                            <input type="hidden" class="size_price"
                                                   value="{{ round($productt->size_price[$key] * $curr->value,2) }}">
                                        </span>
                                    </li>
                                    @php
                                    $is_first = false;
                                    @endphp
                                    @endforeach
                                    <li>
                                </ul>
                                @endif
                            </div>
                            <div class="product-color">
                                @if(!empty($productt->color))
                                <p class="title">Color :</p>
                                <ul class="color-list">
                                    @php
                                    $is_first = true;
                                    @endphp


                                    @foreach($productt->color as $key => $data1)
                                     {{-- @dd( $productt->color[$key]) --}}
                                      
                                    <li class="{{ $is_first ? 'active' : '' }}">
                                        <span class="box ps-variant ps-variant--color" data-color="{{ $productt->color[$key] }}" style="background-color: {{ $productt->color[$key] }}">
                                            <span class="ps-variant__tooltip" id="aaa{{$key}}"></span>
                                        </span>{{-- <p id="aaa{{$key}}"></p> --}}

                                        <script type="text/javascript">
                                            // 1. You need a hex code of the color
                                            var ColorCode = "{{ $productt->color[$key] }}";

                                            // 2. Rate the color using NTC
                                            var ntcMatch = ntc.name(ColorCode);

                                            // 3. Handle the result. The library returns an array with the identified color.

                                            // 3.A RGB value of closest match e.g #01826B
                                            // $('.a').html(ntcMatch[1]);
                                            // console.log(ntcMatch[0]);
                                            // Text string: Color name e.g "Deep Sea"
                                            document.getElementById("aaa{{$key}}").innerHTML = ntcMatch[1];
                                            // $('').html(ntcMatch[1]);
                                            // console.log(color.html);
                                            // True if exact color match, a Boolean
                                            // console.log(ntcMatch[2]);
                                        </script>

                                    </li>
                                    @php
                                    $is_first = false;
                                    @endphp
                                    @endforeach
                                </ul>
                                @endif
                                @if(!empty($productt->size))

                                <input type="hidden" id="stock" value="{{ $productt->size_qty[0] }}">
                                @else
                                @php
                                $stck = (string)$productt->stock;
                                @endphp
                                @if($stck != null)
                                <input type="hidden" id="stock" value="{{ $stck }}">
                                @elseif($productt->type != 'Physical')
                                <input type="hidden" id="stock" value="0">
                                @else
                                <input type="hidden" id="stock" value="">
                                @endif

                                @endif
                                <input type="hidden" id="product_price" value="{{ round($productt->vendorPrice() * $curr->value,2) }}">

                                <input type="hidden" id="product_id" value="{{ $productt->id }}">
                                <input type="hidden" id="curr_pos" value="{{ $gs->currency_format }}">
                                <input type="hidden" id="curr_sign" value="{{ $curr->sign }}">
                            </div>

                            <div class="col-12 col-sm-12 col-md-12 info-meta-3">
                                <ul class="meta-list" style="list-style: none;padding: 0;">
                                    @if($productt->product_type != "affiliate")
                                        <li class="d-block count {{ $productt->type == 'Physical' ? '' : 'd-none' }}" style="float: left;padding: 5px">
                                            <div class="qty" style="display: inline-block;">
                                                <figure>
                                                    <figcaption>Quantity:</figcaption>
                                                    <div class="form-group--number">
                                                        <button class="up qtplus"><i class="fa fa-plus"></i></button>
                                                        <button class="down qtminus"><i class="fa fa-minus"></i></button>
                                                        <input class="form-control qttotal" name="qty" id="qty" type="text" value="1">
                                                    </div>
                                                </figure>
                                            </div>
                                            @if($productt->product_type == "affiliate")
                                        <li class="addtocart">
                                            <a class="ps-btn" href="{{ route('affiliate.product', $productt->slug) }}" target="_blank">
                                                <i class="icofont-cart"></i> {{ $langg->lang251 }}
                                            </a>
                                        </li>
                                    @else
                                        @if($productt->emptyStock())
                                            <li class="addtocart">
                                                <a href="javascript:;" style="margin-top: 24px;" class="ps-btn cart-out-of-stock">
                                                    <i class="icofont-close-circled"></i>
                                                    {{ $langg->lang78 }}
                                                </a>
                                            </li>
                                        @elseif($productt->user_id!=0 && $productt->user->VendorSchedule && !$productt->user->IsStoreOpen())
                                            <li class="addtocart">
                                                <a href="javascript:;" style="margin-top: 24px;" class="ps-btn cart-out-of-stock">
                                                    <i class="icofont-close-circled"></i>
                                                    Store Closed
                                                </a>
                                            </li>
                                        @else
                                            <li class="addtocart" style="float: left;padding: 5px">
                                                <a class="ps-btn" style="margin-top: 20px;" href="javascript:;" id="addcrt11"><i class="icofont-cart"></i>{{ $langg->lang90 }}</a>
                                            </li>
                                            <li class="addtocart">
                                                {{-- <a class="ps-btn mt-25"  href="{{ route('product.cart.quickadd',$productt->id) }}"><i class="icofont-cart"></i>{{ $langg->lang251 }}</a> --}}
                                                 <a class="ps-btn mt-25"  id="addtocrt" href="javascript:;"><i class="icofont-cart"></i>{{ $langg->lang251 }}</a>
                                                @if(Auth::guard('web')->check())
                                                <a href="javascript:;" class="add-to-wish" style="font-size: x-large;" data-href="{{ route('user-wishlist-add',$productt->id) }}"><i class="icofont-heart-alt"></i></a>
                                                {{-- <a href="javascript:;" style="font-size: large;" id="fav" data-href="{{route('user-favorites-product',$productt->id)}}"><i class="far fa-bookmark"></i></a> --}}
                                                @else
                                                <a href="#myModal" data-toggle="modal"><i class="icofont-heart-alt"></i></a>

                                                @endif
                                            </li>

                                        @endif
                                    @endif

                                    </li>
                                    @endif
                                    @if (!empty($productt->attributes))
                                    @php
                                    $attrArr = json_decode($productt->attributes, true);
                                    @endphp
                                    @endif
                                    @if (!empty($attrArr))
                                    <div class="product-attributes my-4">
                                        <div class="row">
                                            @foreach ($attrArr as $attrKey => $attrVal)
                                            @if (array_key_exists("details_status",$attrVal) && $attrVal['details_status'] == 1)

                                            <div class="col-lg-6">
                                                <div class="form-group mb-2">
                                                    <strong for="" class="text-capitalize">{{ str_replace("_", " ", $attrKey) }} :</strong>
                                                    <div class="">
                                                        @foreach ($attrVal['values'] as $optionKey => $optionVal)
                                                        <div class="custom-control custom-radio">
                                                            <input type="hidden" class="keys" value="">
                                                            <input type="hidden" class="values" value="">
                                                            <input type="radio" id="{{$attrKey}}{{ $optionKey }}" name="{{ $attrKey }}" class="custom-control-input product-attr" data-key="{{ $attrKey }}" data-price="{{ $attrVal['prices'][$optionKey] * $curr->value }}" value="{{ $optionVal }}" {{ $loop->first ? 'checked' : '' }}>
                                                            <label class="custom-control-label" for="{{$attrKey}}{{ $optionKey }}">
                                                                {{ $optionVal }}

                                                                @if (!empty($attrVal['prices'][$optionKey]))
                                                                +
                                                                {{$curr->sign}} {{$attrVal['prices'][$optionKey] * $curr->value}}
                                                                @endif
                                                            </label>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif




                                </ul>
                            </div>
                            <script async src="https://static.addtoany.com/menu/page.js"></script>
                            <br>
                            <div class="ps-product__specification">

                                @if($productt->ship != null)

                                    <p class="estimate-time">{{ $langg->lang86 }}: <b> {{ $productt->ship }}</b></p>                                   
                                @endif

                                <p class="categories">
                                    <strong> Categories:</strong>
                                    <a href="">{{$productt->category->name}}</a>
                                </p>
                                @if(!empty($productt->tags))
                                <p class="categories">
                                    <strong> Tags:</strong>
                                    <a href="">
                                        @foreach($productt->tags as $tag)
                                        {{$tag}}
                                        @endforeach
                                    </a>
                                </p>
                                @endif
                            </div>
                            <!-- AddToAny BEGIN -->
                            <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                <a class="a2a_button_facebook"></a>
                                <a class="a2a_button_twitter"></a>
                                <a class="a2a_button_email"></a>
                                <a class="a2a_button_sms"></a>
                            </div>
                            <script>
                                var a2a_config = a2a_config || {};
                                a2a_config.num_services = 4;
                            </script>
                            <script async src="https://static.addtoany.com/menu/page.js"></script>
                            <!-- AddToAny END -->
                             <div>
                                 <p class="security-btn">
                                    <img  src="{{asset('assets/front/images/icon/secure.png')}}"> &nbsp;Secured Transaction</p>
                                 <p class="security-btn" >
                                     <img  src="{{asset('assets/front/images/icon/moneyback.png')}}">
                                 Money Back guarantee</p>
                             </div>


                        </div>
                    </div>
                    <div class="ps-product__content ps-tab-root">
                        <ul class="ps-tab-list">
                            <li class="active"><a href="#tab-1">Description</a></li>
                            <li><a href="#tab-2">Buy & Return Policy</a></li>
                            <li><a href="#tab-4">Reviews ({{count($productt->ratings)}})</a></li>
                        </ul>
                        <div class="ps-tabs">
                            <div class="ps-tab active" id="tab-1">
                                <div class="ps-document">
                                    {!! $productt->details !!}
                                </div>
                            </div>
                            <div class="ps-tab" id="tab-2">
                                <div class="ps-document">
                                    @if($productt->policy)
                                    {!! $productt->policy !!}
                                    @elseif($productt->user_id!=0)
                                        
                                        {!! $productt->user->return_policy !!}
                                       

                                    @endif
                                </div>
                            </div>
                            <div class="ps-tab" id="tab-4">
                                <div class="row">
                                    <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12 ">

                                        <!--Section: Reviews-->
                                        <section class="dark-grey-text mb-5">
                                            <!-- Section heading -->
                                            <h3 class="font-weight-bold text-center mb-5">Product Reviews</h3>
                                            @if(count($productt->ratings) > 0)
                                                @foreach($productt->ratings as $review)
                                                    <div class="media mb-3">
                                                        <img class=" reviewimg card-img-100 rounded-circle z-depth-1-half d-flex mr-3" src="{{ $review->user->photo ?Storage::disk('public')->url($review->user->photo) :asset('assets/images/noimage.png') }}" alt="">
                                                        <div class="media-body">
                                                            <a>
                                                                <h5 class="user-name font-weight-bold">{{ $review->user->name }}</h5>
                                                            </a>
                                                            <!-- Rating -->
                                                            <ul class="rating mb-2">
                                                                <div class="ratings ratingdiv">
                                                                    <div class="empty-stars"></div>
                                                                    <div class="full-stars" style="width:{{$review->rating*20}}%"></div>
                                                                </div>
                                                            </ul>
                                                            <div class="card-data">
                                                                <ul class="list-unstyled mb-1">
                                                                    <li class="comment-date font-small grey-text">
                                                                        <i class="fa fa-clock-o"></i> {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$review->review_date)->diffForHumans() }}
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <p class="dark-grey-text article">{{$review->review}}</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                              <p>{{ $langg->lang97 }}</p>
                                            @endif
                                        </section>
                                        <!--Section: Reviews-->
                                    </div>
                                    <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 ">
                                        @if(Auth::guard('web')->check())
                                        <div class="review-area">
                                            <h4 class="title">{{ $langg->lang98 }}</h4>
                                            <div class="star-area">
                                                <ul class="star-list">
                                                    <li class="stars" data-val="1">
                                                        <i class="fas fa-star"></i>
                                                    </li>
                                                    <li class="stars" data-val="2">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </li>
                                                    <li class="stars" data-val="3">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </li>
                                                    <li class="stars" data-val="4">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </li>
                                                    <li class="stars active" data-val="5">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="write-comment-area">
                                            <div class="gocover"
                                                 style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
                                            </div>
                                            <form id="reviewform" action="{{route('front.review.submit')}}"
                                                  data-href="{{ route('front.reviews',$productt->id) }}" method="POST">
                                                @include('includes.admin.form-both')
                                                {{ csrf_field() }}
                                                <input type="hidden" id="rating" name="rating" value="5">
                                                <input type="hidden" name="user_id" value="{{Auth::guard('web')->user()->id}}">
                                                <input type="hidden" name="product_id" value="{{$productt->id}}">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <textarea name="review" class="form-control" placeholder="{{ $langg->lang99 }}" cols="40" rows="5" required=""></textarea>
                                                    </div>
                                                </div>
                                                <div class="row mt-10" >
                                                    <div class="col-lg-12">
                                                        <button  class="submit-btn btn btn-primary fcb800" type="submit">
                                                            {{ $langg->lang100 }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        @else
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <br>
                                                <h5 class="text-center">
                                                    <a href="#myModal" class="btn login-btn mr-1" id="colorbtn" data-toggle="modal">Login</a>

                                                    {{ $langg->lang102 }}
                                                </h5>
                                                <br>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
            <!-------------------------- Right section-------------------------->
            <div class="ps-page__right">
                <div class="seller-info mt-3">
                    <div class="content">
                        <h4 class="title">
                            Sold & Ship By
                        </h4>                        
                        <p class="stor-name">
                            @if( $productt->user_id  != 0)
                                @if(isset($productt->user))
                                    <div class="vendor-store-name">
                                        <img  src="{{asset('/assets/images/users/'.$productt->user->photo)}}" alt="">
                                    </div>
                                    <div class="d-inline-flex">
                                      <a href="{{ route('front.vendor',str_replace(' ', '-',$productt->user->shop_name)) }}"> 
                                        {{strlen($productt->user->shop_name) > 15 ? substr($productt->user->shop_name,0,13).'..' :$productt->user->shop_name }}</a>&nbsp;|&nbsp;
                                        <div class="ps-product__rating">
                                            <div class="ratings">
                                                <div class="empty-stars"></div>

                                                <div class="full-stars" style="width:{{App\Models\Rating::ratings($productt->id)}}%"></div>

                                            </div>
                                        </div>
                                        <p>&nbsp;{{count($productt->ratings)}} {{ $langg->lang80 }}</p>
                                    </div>
                                @else                                  
                                    {{ $langg->lang247 }}
                                @endif
                            @else 
                              <div class="d-inline-flex pt-20" >
                                <div class="vendor-store-name">
                                    <img  src="{{asset('assets/images/'.$gs->favicon)}}" alt="">
                                </div>
                                <p class="ad-spname">{{ App\Models\Admin::find(1)->shop_name }}</p>
                              </div>
                            @endif
                        </p>

                        <div class="total-product text-left">
                          <span>{{ $langg->lang248 }}:

                            @if( $productt->user_id  != 0)
                            <span>{{ App\Models\Product::where('user_id','=',$productt->user_id)->get()->count() }}</span>
                            @else
                            <span>{{ App\Models\Product::where('user_id','=',0)->get()->count() }}</span>
                            @endif
                          </span>                            
                        </div>

                        <!------------------ CONTACT SELLER ------------------>
                          @include('includes.contactseller')
                        <!------------------ CONTACT SELLER ENDS ------------------>

                    </div>
                </div>
      
                
                <!------------------ Seller Products ------------------>
                @if($vendor_prods->count()>0)
                    <aside class="widget widget_same-brand slp-aside" >
                        <div class="d-inline-flex slp-pad" >
                            <p><b>Seller Products</b> </p>
                            @if($productt->user_id != 0)
                               <p class="ml-80"><a href="{{ route('front.vendor',str_replace(' ', '-',$productt->user->shop_name)) }}">See More</a></p>
                            @else
                               <p class="ml-80"><a href="{{route('front.category')}}">See More</a></p>
                            @endif
                        </div>
                      
                        <div class="widget__content">
                          <div class="owl-slider" data-owl-auto="true" data-owl-loop="false" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="false" data-owl-dots="false" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on">

                            <div class="ps-product-group">
                                @foreach($vendor_prods as $key=>$prod)
                                  
                                    <div class="ps-product--horizontal">
                                         <div class="ps-product__thumbnail"><a href="{{ route('front.product', $prod->slug) }}"><img src="{{ $prod->photo ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" alt=""/></a></div>
                                        <div class="ps-product__content"><a style="color: black" class="ps-product__title" href="{{ route('front.product', $prod->slug) }}">{{$prod->name}}</a>
                                         @if($prod->showPreviousPrice())
                                          <p class="ps-product__price sale">{{$prod->showPrice()}}  <del>{{$prod->showPreviousPrice()}} </del></p>
                                          @else
                                          <p class="ps-product__price">{{$prod->showPrice()}}  </p>
                                          @endif
                                        </div>
                                    </div> 
                                    @if ( ( ($loop->iteration % 4) == 0 ) && (!$loop->last) )
                                         </div><div class="ps-product-group">
                                    @endif
                                @endforeach                     
                            </div>
                          </div>
                        </div>

                    </aside>
                @endif
                <!------------------ Seller Products ------------------>

            </div>
            <!--------------------------  Right section ends -------------------------->


        </div>
    </div>
    <!-------------------------- Related Products -------------------------->
    <div class="ps-section--default container">

        @if($related_products->count()>0)
        <div class="ps-section__header">
            <h3 class="rel-prod-p" >Related products</h3>
        </div>
        <div class="ps-section__content " >

        <div class="ps-carousel--nav owl-slider" data-owl-auto="true" data-owl-loop="false" data-owl-speed="5000" data-owl-gap="5" data-owl-nav="true" data-owl-dots="true" data-owl-item="5" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">

                @foreach($related_products as $key=>$feature_product)                       
                  <div class="product_pc_padding" >              
                     @include('includes.product.product')
                   </div>
                @endforeach
            </div>
        </div>
        @else
        <div class="ps-section__header"></div>
        @endif
    </div>
    <!-------------------------- Related Product ends -------------------------->
</div>


<!---- MESSAGE MODAL -->
<div class="message-modal">
    <div class="modal" id="vendorform" tabindex="-1" role="dialog" aria-labelledby="vendorformLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="vendorformLabel">{{ $langg->lang118 }}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="container-fluid p-0">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="contact-form">
                          <form id="emailreply1">
                            {{csrf_field()}}
                            <ul>
                              <li>
                                <input type="text" class="input-field" id="subj1" name="subject"
                                  placeholder="{{ $langg->lang119}}" required="">
                              </li>
                              <li>
                                <textarea class="input-field textarea" name="message" id="msg1"
                                  placeholder="{{ $langg->lang120 }}" required=""></textarea>
                              </li>
                              <input type="hidden"  name="type" value="Ticket">
                            </ul>
                            <button class="submit-btn" id="emlsub" type="submit">{{ $langg->lang118 }}</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>

    @if(Auth::guard('web')->check())
    @if($productt->user_id != 0)
        <div class="modal" id="vendorform1" tabindex="-1" role="dialog" aria-labelledby="vendorformLabel1" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="vendorformLabel1">{{ $langg->lang118 }}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="container-fluid p-0">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="contact-form">
                          <form id="emailreply">
                            {{csrf_field()}}
                            <ul>

                              <li>
                                <input type="text" class="input-field" readonly=""
                                  placeholder="Send To {{ $productt->user? $productt->user->shop_name: $productt->user->shop_name }}" readonly="">
                              </li>

                              <li>
                                <input type="text" class="input-field" id="subj" name="subject"
                                  placeholder="{{ $langg->lang119}}" required="">
                              </li>

                              <li>
                                <textarea class="input-field textarea" name="message" id="msg"
                                  placeholder="{{ $langg->lang120 }}" required=""></textarea>
                              </li>

                              <input type="hidden" name="email" value="{{ Auth::guard('web')->user()->email }}">
                              <input type="hidden" name="name" value="{{ Auth::guard('web')->user()->name }}">
                              <input type="hidden" name="user_id" value="{{ Auth::guard('web')->user()->id }}">
                             
                              <input type="hidden" name="vendortype" value="botique">
                              <input type="hidden" name="vendor_id" value="{{ $productt->user->id }}">
                             
                              

                            </ul>
                            <button class="submit-btn" id="emlsub1" type="submit">
                              <i class="fa fa-refresh fa-spin" style="display: none"></i>
                              {{ $langg->lang118 }}</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    @endif
    @endif
</div>
<!---- MESSAGE MODAL ENDS -->


@endsection    
    <!-- custom scripts-->
@section('pagelevel_scripts')

<script src="{{asset('assets/front/plugins/owl-carousel/owl.carousel.min.js')}}"></script>    
<script src="{{ asset('js/share.js') }}"></script>
<!-- Include name that color library -->

 <script>
   $(document).ready(function(){
      $('.up').click(function(){
      var value= $('#qty').val();
      value= ++value;
      $('#qty').val(value);
    })
      $('.down').click(function(){
      var value= $('#qty').val();
      if(value>1){
        value= --value;
      $('#qty').val(value);
      }
    })
      
   })
    
 </script>
 <script type="text/javascript">

  $(document).on("submit", "#emailreply1", function () {
    var token = $(this).find('input[name=_token]').val();
    var subject = $(this).find('input[name=subject]').val();
    var message = $(this).find('textarea[name=message]').val();
    var $type  = $(this).find('input[name=type]').val();
    $('#subj1').prop('disabled', true);
    $('#msg1').prop('disabled', true);
    $('#emlsub').prop('disabled', true);
    $.ajax({
      type: 'post',
      url: "{{URL::to('/user/admin/user/send/message')}}",
      data: {
        '_token': token,
        'subject': subject,
        'message': message,
        'type'   : $type
      },
      success: function (data) {
        $('#subj1').prop('disabled', false);
        $('#msg1').prop('disabled', false);
        $('#subj1').val('');
        $('#msg1').val('');
        $('#emlsub').prop('disabled', false);
        if(data == 0)
          toastr.error("Oops Something Goes Wrong !!");
        else
          toastr.success("Message Sent !!");
        $('.close').click();
      }

    });
    return false;
  });

</script>


<script type="text/javascript">

  $(document).on("submit", "#emailreply", function () {

    var token = $(this).find('input[name=_token]').val();
    var subject = $(this).find('input[name=subject]').val();
    var message = $(this).find('textarea[name=message]').val();
    var email = $(this).find('input[name=email]').val();
    var name = $(this).find('input[name=name]').val();
    var user_id = $(this).find('input[name=user_id]').val();
    var vendor_id = $(this).find('input[name=vendor_id]').val();
    var vendor_type = $(this).find('input[name=vendortype]').val();

   
    $('#subj').prop('disabled', true);
    $('#msg').prop('disabled', true);
    $('#emlsub1').prop('disabled', true);
     $('.fa-spin').show();
    $.ajax({
      type: 'post',
      url: "{{URL::to('/vendor/contact')}}",
      data: {
        '_token': token,
        'subject': subject,
        'message': message,
        'email': email,
        'name': name,
        'user_id': user_id,
        'vendor_id': vendor_id,
        'vendor_type': vendor_type
      },
      success: function () {
        $('#subj').prop('disabled', false);
        $('#msg').prop('disabled', false);
        $('#subj').val('');
        $('#msg').val('');
        $('#emlsub1').prop('disabled', false);
         $('.fa-spin').hide();
        toastr.success("{{ $langg->message_sent }}");
        $('.close').click();
      }
    });
   
    return false;
  });

</script>
@endsection    
