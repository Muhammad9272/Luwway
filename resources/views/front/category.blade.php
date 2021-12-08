@extends('front.layouts.app')
<style type="text/css">
  .page-item.active .page-link {
    width: 33px !important;
    height: 32px !important;

    z-index: 1 !important;
    color: #fff !important;
    background-color: #fcb800 !important;
    border-color: #fcb800 !important;
   }
  .pagination{
           font-weight: 400;
  }       font-size: medium !important;
  
  .ps-list--categories li a {
   }

</style>

<script type="text/javascript" src="{{asset('assets/front/js/ntc.js')}}"></script>
@section('page_content')
     <!--Moblie header -->
                <header class="header header--mobile header--mobile-categories">
                  <div class="header__filter">
                    <button class="ps-shop__filter-mb" id="filter-sidebar"><i class="icon-equalizer"></i><span>Filter</span></button>
                            <div class="header__sort">
                            <div class="item-filter">
                                <ul class="filter-list">
                                  <li class="item-short-area">
                                  
                              <select id="sortby1" name="sort" class="short-item">
                                        <option  value="date_desc" {{($sort=='date_desc')?'selected':''}}>{{$langg->lang65}}</option>
                                        <option   value="date_asc" {{($sort=='date_asc')?'selected':''}}>{{$langg->lang66}}</option>
                                        <option  value="price_asc" {{($sort=='price_asc')?'selected':''}}>{{$langg->lang67}}</option>
                                        <option value="price_desc" {{($sort=='price_desc')?'selected':''}}>{{$langg->lang68}}</option>
                                      </select>
                                  </li>
                                </ul>
                              </div>
                            </div>

                  </div>
                </header>
    <!--Moblie header End -->

    <div class="ps-page--shop" id="shop-sidebar">
      <div class="container">
        <div class="ps-layout--shop">
          <div class="ps-layout__left">
            <aside class="widget widget_shop">
              <h4 class="widget-title">Categories</h4>
                <ul class="ps-list--categories">
                  <li><a href="{{route('front.category')}}">All</a></li>
                  @php
                $i=1;
                @endphp
                @foreach($categories as $category)
                @if($category->is_food != 1)

                <li class="current-menu-item   {{count($category->subs) > 0 ? 'menu-item-has-children':''}} {{ $i >= 15 ? 'rx-child' : '' }}">
                  @if(count($category->subs) > 0)
                  <span class="sub-toggle"><i class="fa fa-angle-down"></i></span>
                  @endif
                @if(count($category->subs) > 0)
                    
                  <div class="link-area">
                    <span><a href="{{ route('front.category',$category->slug) }}">{{-- <img src="{{ asset('assets/images/categories/'.$category->photo) }} " height="20px"  alt=""> --}}{{ $category->name }}</a></span>
                    
                  </div>

                @else
                  <a href="{{ route('front.category',$category->slug) }}">{{-- <img src="{{ asset('assets/images/categories/'.$category->photo) }}" height="20px"> --}} {{ $category->name }}</a>

                @endif
                  @if(count($category->subs) > 0)

                  @php
                  $ck = 0;
                  foreach($category->subs as $subcat) {
                    if(count($subcat->childs) > 0) {
                      $ck = 1;
                      break;
                    }
                  }
                  @endphp
                  <ul class="sub-menu {{ $ck == 1 ? 'categories_mega_menu' : 'categories_mega_menu column_1' }}">
                    @foreach($category->subs as $subcat)
                      <li class="current-menu-item">
                        <a href="{{ route('front.subcat',['slug1' => $subcat->category->slug, 'slug2' => $subcat->slug]) }}">{{$subcat->name}}</a>
                        @if(count($subcat->childs) > 0)
                                <span class="sub-toggle"><i class="fa fa-angle-down child"></i></span>
                              @endif
                        @if(count($subcat->childs) > 0)
                          <div class="categorie_sub_menu">
                            <ul class="child-menu" style="display: none">
                              @foreach($subcat->childs as $childcat)
                              <li class="current-menu-item {{count($subcat->childs) > 0 ? 'menu-item-has-children':''}} {{ $i >= 15 ? 'rx-child' : '' }}"><a href="{{ route('front.childcat',['slug1' => $childcat->subcategory->category->slug, 'slug2' => $childcat->subcategory->slug, 'slug3' => $childcat->slug]) }}">{{$childcat->name}}</a></li>
                              
                              @endforeach
                            </ul>
                          </div>
                        @endif
                      </li>
                    @endforeach
                  </ul>

                  @endif

                  </li>

                  @php
                  $i++;
                  @endphp

                  @if($i == 15)
                            <li>
                            <a href="{{ route('front.categories') }}"><i class="fas fa-plus"></i> {{ $langg->lang15 }} </a>
                            </li>
                            @break
                  @endif

                  @endif
                  @endforeach
                          </ul>
            </aside>
            <aside class="widget widget_shop">

              <figure>
                <form action="{{route('front.category', [Request::route('category'),Request::route('subcategory'),Request::route('childcategory')])}}" method="get" id="formm">
                    <!-- Section: Price-->
                    <section filter="condition" class="mb-4">
                      <h4 class="widget-title" style="margin: 20px 0px 10px 0px;font-size: 16px;font-weight: 500">Price({{ Session::has('currency') ?   DB::table('currencies')->where('id','=',Session::get('currency'))->first()->sign  : DB::table('currencies')->where('is_default','=',1)->first()->sign }})
                      </h4>
                      <div class="ps-radio ps-radio-pr">
                        <input class="form-control" onclick="formsubmit()" type="radio" id="review-12pr" name="price" value="Any" checked="">
                        <label for="review-12pr"><span>Any Price</span></label>
                      </div>
                      <div class="ps-radio ps-radio-pr">
                        <input class="form-control" onclick="formsubmit()" type="radio" id="review-13pr" name="price" value="25" {{($price=="25")?'checked':''}}>

                        <label for="review-13pr"><span>Under {{ Session::has('currency') ?   DB::table('currencies')->where('id','=',Session::get('currency'))->first()->sign  : DB::table('currencies')->where('is_default','=',1)->first()->sign }}25</span></label>
                      </div>
                      <div class="ps-radio ps-radio-pr">
                        <input class="form-control" onclick="formsubmit()" type="radio" id="review-14pr" name="price" value="25_50" {{($price=="25_50")?'checked':''}} >

                        <label for="review-14pr"><span>{{ Session::has('currency') ?   DB::table('currencies')->where('id','=',Session::get('currency'))->first()->sign  : DB::table('currencies')->where('is_default','=',1)->first()->sign }}25 to {{ Session::has('currency') ?   DB::table('currencies')->where('id','=',Session::get('currency'))->first()->sign  : DB::table('currencies')->where('is_default','=',1)->first()->sign }}50</span></label>
                      </div>
                      <div class="ps-radio ps-radio-pr">
                        <input class="form-control" onclick="formsubmit()" type="radio" id="review-15pr" name="price" value="50_100" {{($price=="50_100")?'checked':''}}>
                        <label for="review-15pr"><span>{{ Session::has('currency') ?   DB::table('currencies')->where('id','=',Session::get('currency'))->first()->sign  : DB::table('currencies')->where('is_default','=',1)->first()->sign }}50 to {{ Session::has('currency') ?   DB::table('currencies')->where('id','=',Session::get('currency'))->first()->sign  : DB::table('currencies')->where('is_default','=',1)->first()->sign }}100</span></label>
                      </div>
                      <div class="ps-radio ps-radio-pr">
                        <input class="form-control" onclick="formsubmit()" type="radio" id="review-16pr" name="price" value="100" {{($price=="100")?'checked':''}}>
                        <label for="review-16pr"><span>Over {{ Session::has('currency') ?   DB::table('currencies')->where('id','=',Session::get('currency'))->first()->sign  : DB::table('currencies')->where('is_default','=',1)->first()->sign }}100</span></label>
                      </div>
                      <div class="ps-radio ps-radio-pr">
                        <input class="form-control" type="radio" id="review-17pr" name="price" value="custom-price" {{($price=="custom-price")?'checked':''}}>
                        <label for="review-17pr"><span>Custom</span></label>
                      </div>                     
                      <div class="price-range-blocks">                    
                        <div class="livecount">
                          <input type="number" min=0  name="min"  id="min_price" class="form-control price-range-field1" placeholder="Low" value="{{($price=="custom-price")?"$retmin":''}}" />
                          {{-- @dd($retmin) --}}
                          <span>{{$langg->lang62}}</span>
                          <input type="number" min=0  name="max" id="max_price" class="form-control price-range-field1" placeholder="High" value="{{($price=="custom-price")?"$retmax":''}}" />
                          <button class="fbtn" style="border: aliceblue;   padding: 12px;    border-radius: 50%;"><i class="fas fa-angle-right"></i></button>
                        </div>
                      </div>
                    </section>

                    <!-- Section: Offers-->
                    <section filter="offers" class="mb-4">
                      <h4 class="widget-title" style="margin: 20px 0px 10px 0px;font-size: 16px;font-weight: 500">Special Offers</h4>
                      <div class="ps-checkbox">
                        <input class="form-control" onclick="formsubmit()" type="checkbox" id="review-0001" name="soffer[]" value="fship"  @if(is_array($soffer) && in_array('fship',$soffer)) checked @endif >
                        <label for="review-0001"><span>Free Shipping</span></label>
                      </div>
                      <div class="ps-checkbox">
                        <input class="form-control" onclick="formsubmit()" type="checkbox" id="review-0002" name="soffer[]" value="onsale" @if(is_array($soffer) && in_array('onsale',$soffer)) checked @endif >
                        <label for="review-0002"><span>On Sale</span></label>
                      </div>
                     </section>


                    <!-- Section: Location-->

                    <section filter="location" class="mb-4">
                      <h4 class="widget-title" style="margin: 20px 0px 10px 0px;font-size: 16px;font-weight: 500">Location
                      </h4>
                      <div class="ps-radio ps-radio-pr">
                        <input class="form-control" onclick="formsubmit()" type="radio" id="review-12loc" name="location" value="Any" checked="">
                        <label for="review-12loc"><span>Any Location</span></label>
                      </div>
                      <div class="ps-radio ps-radio-pr">
                        <input class="form-control" onclick="formsubmit()" type="radio" id="review-13loc" name="location" value="USA" {{($location=="USA")?'checked':''}}>

                        <label for="review-13loc"><span>United States</span></label>
                      </div>
                      <div class="ps-radio ps-radio-pr">
                        <input class="form-control" onclick="formsubmit()" type="radio" id="review-14loc" name="location" value="CA" {{($location=="CA")?'checked':''}} >

                        <label for="review-14loc"><span>Canada</span></label>
                      </div>
                      <div class="ps-radio ps-radio-pr">
                        <input class="form-control" type="radio" id="review-17loc" name="location" value="custom-loc" {{($location=="custom-loc")?'checked':''}}>
                        <label for="review-17loc"><span>Custom</span></label>
                      </div>                     
                      <div class="price-range-blocks">                    
                        <div class="livecount">
                          <input type="text"   id="location" class="form-control location-field1" name="custom_location" placeholder="Enter location" value=" {{($location=="custom-loc")?"$address":''}}" />
                         
                          <button class="fbtn" style="border: aliceblue;   padding: 12px;    border-radius: 50%;"><i class="fas fa-angle-right"></i></button>
                        </div>
                      </div>
                    </section>




                    <!-- Section: Condition Starts -->
                    <section filter="condition" class="mb-4">
                      <h4 class="widget-title" style="margin: 20px 0px 10px 0px;font-size: 16px;font-weight: 500">Condition</h4>
                      <div class="ps-checkbox">
                        <input class="form-control" onclick="formsubmit()" type="checkbox" id="review-01" name="condition[]" value="2"  @if(is_array($condition) && in_array(2,$condition)) checked @endif >
                        <label for="review-01"><span>New</span></label>
                      </div>
                      <div class="ps-checkbox">
                        <input class="form-control" onclick="formsubmit()" type="checkbox" id="review-02" name="condition[]" value="1" @if(is_array($condition) && in_array(1,$condition)) checked @endif >
                        <label for="review-02"><span>Used</span></label>
                      </div>
                     </section>

                     <!-- Section: Condition Ends -->

                    {{-- <input type="hidden" name="cat" value="{{$cat=\Request::segment(2)}}"> --}}
                    {{-- <input type="hidden" name="min" id="min">
                    <input type="hidden" name="max" id="max"> --}}
                    <input type="hidden" name="sort" id="sort">

                    <!-- Section:  Color Starts -->
                    <h4 class="widget-title" style="margin: 20px 0px 10px 0px;font-size: 16px;font-weight: 500">Color</h4>
                    <section class="ps-custom-scrollbar mb-4" data-height="150" >
                        @foreach($array as $key=>$color)
                          <div class="ps-checkbox">
                            <input class="form-control" onclick="formsubmit()" type="checkbox" id="review-{{++$key}}" name="color[]" value="{{$color}}"  @if(is_array($col) && in_array($color,$col)) checked @endif >
                            <label for="review-{{$key}}"><span id="a{{$key}}"></span></label>
                          </div>
                          <script type="text/javascript">
                            // 1. You need a hex code of the color
                            var ColorCode = "{{$color }}";

                            // 2. Rate the color using NTC
                            var ntcMatch = ntc.name(ColorCode);

                            // 3. Handle the result. The library returns an array with the identified color.

                            // 3.A RGB value of closest match e.g #01826B
                            // $('.a').html(ntcMatch[1]);
                            // console.log(ntcMatch[0]);
                            // Text string: Color name e.g "Deep Sea"
                            document.getElementById("a{{$key}}").innerHTML = ntcMatch[1];
                            // $('').html(ntcMatch[1]);
                            // console.log(color.html);
                            // True if exact color match, a Boolean
                            // console.log(ntcMatch[2]);
                          </script >      
                        @endforeach
                    </section> 
                     <!-- Section:  Color Ends -->
          


                      <!-- Section: Size Start-->
                    <section filter="condition" class="mb-4">
                      <h4 class="widget-title" style="margin: 20px 0px 10px 0px;font-size: 16px;font-weight: 500">Size</h4>
                      <div class="ps-checkbox">
                        <input class="form-control" onclick="formsubmit()" type="checkbox" id="review-001" name="size[]" value="S" @if(is_array($size) && in_array('S',$size)) checked @endif  >
                        <label for="review-001"><span>S</span></label>
                      </div>
                      <div class="ps-checkbox">
                        <input class="form-control" onclick="formsubmit()" type="checkbox" id="review-002" name="size[]" value="M"  @if(is_array($size) && in_array('M',$size)) checked @endif  >
                        <label for="review-002"><span>M</span></label>
                      </div>
                      <div class="ps-checkbox">
                        <input class="form-control" onclick="formsubmit()" type="checkbox" id="review-003" name="size[]" value="L" @if(is_array($size) && in_array('L',$size)) checked @endif >
                        <label for="review-003"><span>L</span></label>
                      </div>
                      <div class="ps-checkbox">
                        <input class="form-control" onclick="formsubmit()" type="checkbox" id="review-004" name="size[]" value="XL" @if(is_array($size) && in_array('XL',$size)) checked @endif  >
                        <label for="review-004"><span>XL</span></label>
                      </div>
                      <div class="ps-checkbox">
                        <input class="form-control" onclick="formsubmit()" type="checkbox" id="review-005" name="size[]" value="XXL" @if(is_array($size) && in_array('XXL',$size)) checked @endif >
                        <label for="review-005"><span>XXL</span></label>
                      </div>
                      <div class="ps-checkbox">
                        <input class="form-control" onclick="formsubmit()" type="checkbox" id="review-006" name="size[]" value="3XL" @if(is_array($size) && in_array('3XL',$size)) checked @endif >
                        <label for="review-006"><span>3XL</span></label>
                      </div>
                      <div class="ps-checkbox">
                        <input class="form-control" onclick="formsubmit()" type="checkbox" id="review-007" name="size[]" value="4XL" @if(is_array($size) && in_array('4XL',$size)) checked @endif >
                        <label for="review-007"><span>4XL</span></label>
                      </div>                
                     </section>
                     <!-- Section:  Size End -->

                  {{-- <button type="button" class="btn btn-default fbtn" style="background-color: black;color: white;margin-top: 10px;">Submit</button> --}}
                </form>
              </figure>
            </aside>
          </div>
          <div class="ps-layout__right">
            <div class="ps-shopping ps-tab-root">
              <div class="ps-shopping__header tt-tab1">
                <p>{{$prods->total()}} results Found</p>

                <div class="ps-shopping__actions">
                  @include('includes.filterprod')
                </div>
              </div>
              <div class="ps-tabs">
                <div class="ps-tab active" id="tab-1">
                  <div class="ps-shopping-product">
                    @if(count($prods)>0)
                    <div class="row">
                        @foreach ($prods as $key => $feature_product)
                        <div class="prod-padd col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 " style="padding-right: 7px;padding-left: 7px">
                            @include('includes.product.product')
                        </div>
                        @endforeach
                      <div class="col-lg-12">
                        <div class="ps-pagination">

                          {{ $prods->Oneachside(2)->appends($datapag)->links('vendor.pagination.default') }}
                          
                        </div> 
                      </div>
                    @else
                      <div class="col-lg-12">
                        <div class="page-center">
                           <h4 class="text-center">{{ $langg->lang60 }}</h4>
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
      </div>
    </div>

    <!---Mobile Filters-->
    <div class="ps-filter--sidebar">
      <div class="ps-filter__header">
        <h3>Filter Products</h3><a class="ps-btn--close ps-btn--no-boder" href="#"></a>
      </div>
      <div class="ps-filter__content">
            <aside class="widget widget_shop">
              <h4 class="widget-title">Categories</h4>
                <ul class="ps-list--categories">
                  <li><a href="{{route('front.category')}}">All</a></li>
                  @php
                $i=1;
                @endphp
                @foreach($categories as $category)
                @if($category->is_food != 1)

                <li class="current-menu-item   {{count($category->subs) > 0 ? 'menu-item-has-children':''}} {{ $i >= 15 ? 'rx-child' : '' }}">
                  @if(count($category->subs) > 0)
                  <span class="sub-toggle"><i class="fa fa-angle-down"></i></span>
                  @endif
                @if(count($category->subs) > 0)
                    
                  <div class="link-area">
                    <span><a href="{{ route('front.category',$category->slug) }}">{{-- <img src="{{ asset('assets/images/categories/'.$category->photo) }} " height="20px"  alt=""> --}}{{ $category->name }}</a></span>
                    
                  </div>

                @else
                  <a href="{{ route('front.category',$category->slug) }}">{{-- <img src="{{ asset('assets/images/categories/'.$category->photo) }}" height="20px"> --}} {{ $category->name }}</a>

                @endif
                  @if(count($category->subs) > 0)

                  @php
                  $ck = 0;
                  foreach($category->subs as $subcat) {
                    if(count($subcat->childs) > 0) {
                      $ck = 1;
                      break;
                    }
                  }
                  @endphp
                  <ul class="sub-menu {{ $ck == 1 ? 'categories_mega_menu' : 'categories_mega_menu column_1' }}">
                    @foreach($category->subs as $subcat)
                      <li class="current-menu-item">
                        <a href="{{ route('front.subcat',['slug1' => $subcat->category->slug, 'slug2' => $subcat->slug]) }}">{{$subcat->name}}</a>
                        @if(count($subcat->childs) > 0)
                                <span class="sub-toggle"><i class="fa fa-angle-down child"></i></span>
                              @endif
                        @if(count($subcat->childs) > 0)
                          <div class="categorie_sub_menu">
                            <ul class="child-menu" style="display: none">
                              @foreach($subcat->childs as $childcat)
                              <li class="current-menu-item {{count($subcat->childs) > 0 ? 'menu-item-has-children':''}} {{ $i >= 15 ? 'rx-child' : '' }}"><a href="{{ route('front.childcat',['slug1' => $childcat->subcategory->category->slug, 'slug2' => $childcat->subcategory->slug, 'slug3' => $childcat->slug]) }}">{{$childcat->name}}</a></li>
                              
                              @endforeach
                            </ul>
                          </div>
                        @endif
                      </li>
                    @endforeach
                  </ul>

                  @endif

                  </li>

                  @php
                  $i++;
                  @endphp

                  @if($i == 15)
                            <li>
                            <a href="{{ route('front.categories') }}"><i class="fas fa-plus"></i> {{ $langg->lang15 }} </a>
                            </li>
                            @break
                  @endif

                  @endif
                  @endforeach
                          </ul>
            </aside>
            <aside class="widget widget_shop">

              <figure>
                <form action="{{route('front.category', [Request::route('category'),Request::route('subcategory'),Request::route('childcategory')])}}" method="get" id="formm-mob">
                    <!-- Section: Price-->
                    <section filter="condition" class="mb-4">
                      <h4 class="widget-title" style="margin: 20px 0px 10px 0px;font-size: 16px;font-weight: 500">Price({{ Session::has('currency') ?   DB::table('currencies')->where('id','=',Session::get('currency'))->first()->sign  : DB::table('currencies')->where('is_default','=',1)->first()->sign }})
                      </h4>
                      <div class="ps-radio ps-radio-pr">
                        <input class="form-control" onclick="formsubmitmin()" type="radio" id="review-12prmob" name="price" value="Any" checked="">
                        <label for="review-12prmob"><span>Any Price</span></label>
                      </div>
                      <div class="ps-radio ps-radio-pr">
                        <input class="form-control" onclick="formsubmitmin()" type="radio" id="review-13prmob" name="price" value="25" {{($price=="25")?'checked':''}}>

                        <label for="review-13prmob"><span>Under {{ Session::has('currency') ?   DB::table('currencies')->where('id','=',Session::get('currency'))->first()->sign  : DB::table('currencies')->where('is_default','=',1)->first()->sign }}25</span></label>
                      </div>
                      <div class="ps-radio ps-radio-pr">
                        <input class="form-control" onclick="formsubmitmin()" type="radio" id="review-14prmob" name="price" value="25_50" {{($price=="25_50")?'checked':''}} >

                        <label for="review-14prmob"><span>{{ Session::has('currency') ?   DB::table('currencies')->where('id','=',Session::get('currency'))->first()->sign  : DB::table('currencies')->where('is_default','=',1)->first()->sign }}25 to {{ Session::has('currency') ?   DB::table('currencies')->where('id','=',Session::get('currency'))->first()->sign  : DB::table('currencies')->where('is_default','=',1)->first()->sign }}50</span></label>
                      </div>
                      <div class="ps-radio ps-radio-pr">
                        <input class="form-control" onclick="formsubmitmin()" type="radio" id="review-15prmob" name="price" value="50_100" {{($price=="50_100")?'checked':''}}>
                        <label for="review-15prmob"><span>{{ Session::has('currency') ?   DB::table('currencies')->where('id','=',Session::get('currency'))->first()->sign  : DB::table('currencies')->where('is_default','=',1)->first()->sign }}50 to {{ Session::has('currency') ?   DB::table('currencies')->where('id','=',Session::get('currency'))->first()->sign  : DB::table('currencies')->where('is_default','=',1)->first()->sign }}100</span></label>
                      </div>
                      <div class="ps-radio ps-radio-pr">
                        <input class="form-control" onclick="formsubmitmin()" type="radio" id="review-16prmob" name="price" value="100" {{($price=="100")?'checked':''}}>
                        <label for="review-16prmob"><span>Over {{ Session::has('currency') ?   DB::table('currencies')->where('id','=',Session::get('currency'))->first()->sign  : DB::table('currencies')->where('is_default','=',1)->first()->sign }}100</span></label>
                      </div>
                      <div class="ps-radio ps-radio-pr">
                        <input class="form-control" type="radio" id="review-17prmob" name="price" value="custom-price" {{($price=="custom-price")?'checked':''}}>
                        <label for="review-17prmob"><span>Custom</span></label>
                      </div>                     
                      <div class="price-range-blocks">                    
                        <div class="livecount">
                          <input type="number" min=0  name="min"  id="min_price" class="form-control price-range-field1" placeholder="Low" value="{{($price=="custom-price")?"$retmin":''}}" />
                          <span>{{$langg->lang62}}</span>
                          <input type="number" min=0  name="max" id="max_price" class="form-control price-range-field1" placeholder="High" value="{{($price=="custom-price")?"$retmax":''}}" />
                          <button class="fbtn-mob" style="border: aliceblue;   padding: 12px;    border-radius: 50%;"><i class="fas fa-angle-right"></i></button>
                        </div>
                      </div>
                    </section>

                    <!-- Section: Offers-->
                    <section filter="condition" class="mb-4">
                      <h4 class="widget-title" style="margin: 20px 0px 10px 0px;font-size: 16px;font-weight: 500">Special Offers</h4>
                      <div class="ps-checkbox">
                        <input class="form-control" onclick="formsubmitmin()" type="checkbox" id="review-0001mob" name="soffer[]" value="fship"  @if(is_array($soffer) && in_array('fship',$soffer)) checked @endif >
                        <label for="review-0001mob"><span>Free Shipping</span></label>
                      </div>
                      <div class="ps-checkbox">
                        <input class="form-control" onclick="formsubmitmin()" type="checkbox" id="review-0002mob" name="soffer[]" value="onsale" @if(is_array($soffer) && in_array('onsale',$soffer)) checked @endif >
                        <label for="review-0002mob"><span>On Sale</span></label>
                      </div>
                     </section>


                    <!-- Section: Location-->

                    <section filter="location" class="mb-4">
                      <h4 class="widget-title" style="margin: 20px 0px 10px 0px;font-size: 16px;font-weight: 500">Location
                      </h4>
                      <div class="ps-radio ps-radio-pr">
                        <input class="form-control" onclick="formsubmitmin()" type="radio" id="review-12locmob" name="location" value="Any" checked="">
                        <label for="review-12locmob"><span>Any Location</span></label>
                      </div>
                      <div class="ps-radio ps-radio-pr">
                        <input class="form-control" onclick="formsubmitmin()" type="radio" id="review-13locmob" name="location" value="USA" {{($location=="USA")?'checked':''}}>

                        <label for="review-13locmob"><span>United States</span></label>
                      </div>
                      <div class="ps-radio ps-radio-pr">
                        <input class="form-control" onclick="formsubmitmin()" type="radio" id="review-14locmob" name="location" value="CA" {{($location=="CA")?'checked':''}} >

                        <label for="review-14locmob"><span>Canada</span></label>
                      </div>
                      <div class="ps-radio ps-radio-pr">
                        <input class="form-control"  type="radio" id="review-17locmob" name="location" value="custom-loc" {{($location=="custom-loc")?'checked':''}}>
                        <label for="review-17locmob"><span>Custom</span></label>
                      </div>                     
                      <div class="price-range-blocks">                    
                        <div class="livecount">
                          <input type="text"   id="location" class="form-control location-field1" name="custom_location" placeholder="Enter location" value=" {{($location=="custom-loc")?"$address":''}}" />
                         
                          <button class="fbtn" style="border: aliceblue;   padding: 12px;    border-radius: 50%;"><i class="fas fa-angle-right"></i></button>
                        </div>
                      </div>
                    </section>


                    <!-- Section: Condition Starts -->
                    <section filter="condition" class="mb-4">
                      <h4 class="widget-title" style="margin: 20px 0px 10px 0px;font-size: 16px;font-weight: 500">Condition</h4>
                      <div class="ps-checkbox">
                        <input class="form-control" onclick="formsubmitmin()" type="checkbox" id="review-01mob" name="condition[]" value="2"  @if(is_array($condition) && in_array(2,$condition)) checked @endif >
                        <label for="review-01mob"><span>New</span></label>
                      </div>
                      <div class="ps-checkbox">
                        <input class="form-control" onclick="formsubmitmin()" type="checkbox" id="review-02mob" name="condition[]" value="1" @if(is_array($condition) && in_array(1,$condition)) checked @endif >
                        <label for="review-02mob"><span>Used</span></label>
                      </div>
                     </section>

                     <!-- Section: Condition Ends -->

                    {{-- <input type="hidden" name="cat" value="{{$cat=\Request::segment(2)}}"> --}}
                    {{-- <input type="hidden" name="min" id="min">
                    <input type="hidden" name="max" id="max"> --}}
                    <input type="hidden" name="sort" id="sort-mob">

                    <!-- Section:  Color Starts -->
                         <h4 class="widget-title" style="margin: 20px 0px 10px 0px;font-size: 16px;font-weight: 500">Color</h4>
                    <section class="ps-custom-scrollbar mb-4" data-height="150" >
                        @foreach($array as $key=>$color)
                          <div class="ps-checkbox">
                            <input class="form-control" onclick="formsubmitmin()" type="checkbox" id="review-{{++$key}}mob" name="color[]" value="{{$color}}"  @if(is_array($col) && in_array($color,$col)) checked @endif >
                            <label for="review-{{$key}}mob"><span id="aa{{$key}}"></span></label>
                          </div>
                          <script type="text/javascript">
                            // 1. You need a hex code of the color
                            var ColorCode = "{{$color }}";

                            // 2. Rate the color using NTC
                            var ntcMatch = ntc.name(ColorCode);

                            // 3. Handle the result. The library returns an array with the identified color.

                            // 3.A RGB value of closest match e.g #01826B
                            // $('.a').html(ntcMatch[1]);
                            // console.log(ntcMatch[0]);
                            // Text string: Color name e.g "Deep Sea"
                            document.getElementById("aa{{$key}}").innerHTML = ntcMatch[1];
                            // $('').html(ntcMatch[1]);
                            // console.log(color.html);
                            // True if exact color match, a Boolean
                            // console.log(ntcMatch[2]);
                          </script >      
                        @endforeach
                    </section> 
                     <!-- Section:  Color Ends -->

                      <!-- Section: Size Start-->
                    <section filter="condition" class="mb-4">
                      <h4 class="widget-title" style="margin: 20px 0px 10px 0px;font-size: 16px;font-weight: 500">Size</h4>
                      <div class="ps-checkbox">
                        <input class="form-control" onclick="formsubmitmin()" type="checkbox" id="review-001mob" name="size[]" value="S" @if(is_array($size) && in_array('S',$size)) checked @endif  >
                        <label for="review-001mob"><span>S</span></label>
                      </div>
                      <div class="ps-checkbox">
                        <input class="form-control" onclick="formsubmitmin()" type="checkbox" id="review-002mob" name="size[]" value="M"  @if(is_array($size) && in_array('M',$size)) checked @endif  >
                        <label for="review-002mob"><span>M</span></label>
                      </div>
                      <div class="ps-checkbox">
                        <input class="form-control" onclick="formsubmitmin()" type="checkbox" id="review-003mob" name="size[]" value="L" @if(is_array($size) && in_array('L',$size)) checked @endif >
                        <label for="review-003mob"><span>L</span></label>
                      </div>
                      <div class="ps-checkbox">
                        <input class="form-control" onclick="formsubmitmin()" type="checkbox" id="review-004mob" name="size[]" value="XL" @if(is_array($size) && in_array('XL',$size)) checked @endif  >
                        <label for="review-004mob"><span>XL</span></label>
                      </div>
                      <div class="ps-checkbox">
                        <input class="form-control" onclick="formsubmitmin()" type="checkbox" id="review-005mob" name="size[]" value="XXL" @if(is_array($size) && in_array('XXL',$size)) checked @endif >
                        <label for="review-005mob"><span>XXL</span></label>
                      </div>
                      <div class="ps-checkbox">
                        <input class="form-control" onclick="formsubmitmin()" type="checkbox" id="review-006mob" name="size[]" value="3XL" @if(is_array($size) && in_array('3XL',$size)) checked @endif >
                        <label for="review-006mob"><span>3XL</span></label>
                      </div>
                      <div class="ps-checkbox">
                        <input class="form-control" onclick="formsubmitmin()" type="checkbox" id="review-007mob" name="size[]" value="4XL" @if(is_array($size) && in_array('4XL',$size)) checked @endif >
                        <label for="review-007mob"><span>4XL</span></label>
                      </div>                
                     </section>
                     <!-- Section:  Size End -->

                  {{-- <button type="button" class="btn btn-default fbtn-mob" style="background-color: black;color: white;margin-top: 10px;">Submit</button> --}}
                </form>
              </figure>
            </aside>
      </div>
    </div>
    <!---Mobile Filters ends-->







@endsection    
    <!-- custom scripts-->
@section('pagelevel_scripts')  

<script>
    function formsubmit() {
      $('#formm').submit();
    }

    function formsubmitmin() {
      $('#formm-mob').submit();
    }
</script>

 <script>

  $(document).ready(function(){

  
    var count=1;
    $('.child').on('click',function(){
      if(count == 0){
        $('.child-menu').css('display','none');
        count = 1;
      }
      else{
        $(this).css('rotate',360,'deg');
        $('.child-menu').css('display','block');
        count = 0;
      }
      
    })
    $('.fbtn').on('click',function(){
    // var min =$('.min').html();
    // var max =$('.max').html();
    // $('#min').val(min.substring(1,min.length));
    // $('#max').val(max.substring(1,max.length));    
    $('#formm').submit();
   });

    $('.fbtn-mob').on('click',function(){    
    $('#formm-mob').submit();
   });
    $('.price-range-field1').on('click',function(){
      $('#review-17pr').prop("checked", true);
      $('#review-17prmob').prop("checked", true);
    // var min =$('.min').html();
    // var max =$('.max').html();
    // $('#min').val(min.substring(1,min.length));
    // $('#max').val(max.substring(1,max.length));    
    // $('#formm').submit();
   });
        $('.location-field1').on('click',function(){
      $('#review-17loc').prop("checked", true);
      $('#review-17locmob').prop("checked", true);

       });


  })
 </script>
 <script>

  $(document).ready(function() {
      $('.ps-variant').on('click',function(){
        $(this).css('border', "solid 2px red");
        var vale=$(this).data('color');
        $('#color').val(vale);
      })
    // when dynamic attribute changes
    $(".attribute-input, #sortby").on('change', function() {
      $("#ajaxLoader").show();
      filter();
    });

    // when price changed & clicked in search button
    $(".filter-btn").on('click', function(e) {
      e.preventDefault();
      $("#ajaxLoader").show();
      filter();
    });
  });

  function filter() {
    let filterlink = '';

    if ($("#prod_name").val() != '') {
      if (filterlink == '') {
        filterlink += '{{route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}' + '?search='+$("#prod_name").val();
      } else {
        filterlink += '&search='+$("#prod_name").val();
      }
    }

    $(".attribute-input").each(function() {
      if ($(this).is(':checked')) {
        if (filterlink == '') {
          filterlink += '{{route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}' + '?'+$(this).attr('name')+'='+$(this).val();
        } else {
          filterlink += '&'+$(this).attr('name')+'='+$(this).val();
        }
      }
    });

    if ($("#sortby").val() != '') {
      if (filterlink == '') {
        filterlink += '{{route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}' + '?'+$("#sortby").attr('name')+'='+$("#sortby").val();
      } else {
        filterlink += '&'+$("#sortby").attr('name')+'='+$("#sortby").val();
      }
    }

    if ($("#min_price").val() != '') {
      if (filterlink == '') {
        filterlink += '{{route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}' + '?'+$("#min_price").attr('name')+'='+$("#min_price").val();
      } else {
        filterlink += '&'+$("#min_price").attr('name')+'='+$("#min_price").val();
      }
    }

    if ($("#max_price").val() != '') {
      if (filterlink == '') {
        filterlink += '{{route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}' + '?'+$("#max_price").attr('name')+'='+$("#max_price").val();
      } else {
        filterlink += '&'+$("#max_price").attr('name')+'='+$("#max_price").val();
      }
    }

    // console.log(filterlink);
    console.log(encodeURI(filterlink));
    $("#ajaxContent").load(encodeURI(filterlink), function(data) {
      // add query string to pagination
      addToPagination();
      $("#ajaxLoader").fadeOut(1000);
    });
  }

  // append parameters to pagination links
  function addToPagination() {
    // add to attributes in pagination links
    $('ul.pagination li a').each(function() {
      let url = $(this).attr('href');
      let queryString = '?' + url.split('?')[1]; // "?page=1234...."

      let urlParams = new URLSearchParams(queryString);
      let page = urlParams.get('page'); // value of 'page' parameter

      let fullUrl = '{{route('front.category', [Request::route('category'),Request::route('subcategory'),Request::route('childcategory')])}}?page='+page+'&search='+'{{request()->input('search')}}';

      $(".attribute-input").each(function() {
        if ($(this).is(':checked')) {
          fullUrl += '&'+encodeURI($(this).attr('name'))+'='+encodeURI($(this).val());
        }
      });

      if ($("#sortby").val() != '') {
        fullUrl += '&sort='+encodeURI($("#sortby").val());
      }

      if ($("#min_price").val() != '') {
        fullUrl += '&min='+encodeURI($("#min_price").val());
      }

      if ($("#max_price").val() != '') {
        fullUrl += '&max='+encodeURI($("#max_price").val());
      }

      $(this).attr('href', fullUrl);
    });
  }

  $(document).on('click', '.categori-item-area .pagination li a', function (event) {
    event.preventDefault();
    if ($(this).attr('href') != '#' && $(this).attr('href')) {
      $('#preloader').show();
      $('#ajaxContent').load($(this).attr('href'), function (response, status, xhr) {
        if (status == "success") {
          $('#preloader').fadeOut();
          $("html,body").animate({
            scrollTop: 0
          }, 1);

          addToPagination();
        }
      });
    }
  });

</script>


<script type="text/javascript">
        $("#sortby").on('change',function () {
        let sort = $("#sortby").val();
        $('#sort').val(sort);

        let filterlink = '{{route('front.category', [Request::route('category'),Request::route('subcategory'),Request::route('childcategory')])}}';

        $('#formm').attr('action',filterlink);
             $('#formm').submit();
        // var url = window.location.href;
        // window.location = url + '?sort='+sort; 
        // window.location = "{{route('front.category')}}?sort="+sort;
        // window.location = mainurl + '?sort='+sort;
      });
</script>
<script type="text/javascript">
        $("#sortby1").on('change',function () {
        let sort = $("#sortby1").val();
        $('#sort-mob').val(sort);

        let filterlink = '{{route('front.category', [Request::route('category'),Request::route('subcategory'),Request::route('childcategory')])}}';

        $('#formm-mob').attr('action',filterlink);
             $('#formm-mob').submit();
      });
</script>

@endsection        
