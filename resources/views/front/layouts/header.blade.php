<header class="header header--organic header-cust-shadow" data-sticky="true">
  <link rel="stylesheet" type="text/css" href="https://pro.fontawesome.com/releases/v5.0.10/css/all.css">
  @if($gs->announcement_check==1)
  <div class="header__top1" style="background-color:{{$gs->announcement_color}}">
    <div class="container">     
        <p>{!! $gs->announcement_title !!}</p>  
    </div>
  </div>
  @endif
  <div class="header__top">
    <div class="container" >
      <div class="header__left">
        <div class="menu--product-categories">
          <div class="menu__toggle"><a  href="{{url('/')}}"><img  src="{{asset('assets/images/'.$gs->logo)}}" height="42px" alt=""></div>
        </div><a class="ps-logo" href="{{url('/')}}"><img src="{{asset('assets/images/'.$gs->logo)}}" height="42px" alt=""></a>
      </div>
      <div class="header__center">
        <form id="searchForm" style="margin: 0px" class="search-form ps-form--quick-search" action="{{ route('front.category', [Request::route('category'),Request::route('subcategory'),Request::route('childcategory')]) }}" method="GET">
          @if (!empty(request()->input('sort')))
                  <input type="hidden" name="sort" value="{{ request()->input('sort') }}">
                @endif
                @if (!empty(request()->input('minprice')))
                  <input type="hidden" name="minprice" value="{{ request()->input('minprice') }}">
                @endif
                @if (!empty(request()->input('maxprice')))
                  <input type="hidden" name="maxprice" value="{{ request()->input('maxprice') }}">
                @endif
                  
          <input class="form-control" type="text"  id="prod_name" name="search" placeholder="I am Looking for ..." value="{{ request()->input('search') }}">
          <span class="header-search-magnifier" ><button style="color: black;background-color: white !important;" id="header-search-submit" type="submit"><i class="icon-magnifier"></i></button></span>
          
        </form>
      </div>
      
      <!----------------------------Header Right------------------------------------->
        <div class="header__right">
            <div class="header__actions">
                
                @if(Auth::guard('web')->check())       
                    @if(Auth::user()->IsVendor())
                       <a style="display:flex" href="{{route('vendor-dashboard')}}" data-toggle="tooltip" title="Shop Manager">
                      <img height:40px style="max-width:40px"   src="{{asset('assets/images/icons/email-logo.png')}}"/><span>&nbsp;</span></a>
                    @else
                     <a class="" href="{{route('vendor.types')}}" style="font-weight: 500"> Sell on luwaay</a>
                    @endif  
                @else
                  <a class="" href="{{route('vendor.types')}}" style="font-weight: 700"> Sell on luwaay </a>
                @endif

                @if(Auth::guard('web')->check())
                <a class="header__extra" href="{{route('user-favorites','products')}}"><i class="icon-heart"></i><span id="wishlist-count"><i>{{ count(Auth::user()->wishlists) }}</i></span></a>
                @endif

                @if(!Auth::guard('web')->check())
                  <a style="font-weight: 700" href="{{route('user.login')}}">Sign in</a>
                  <a class="btn mybtn" href="{{route('user-register')}}">Sign up</a>
                @endif
                  
              
                    @if(Auth::guard('web')->check())                            
                        <a class="header__extra" href=""><img class="bell-icon" src="/assets/images/icons/nofify.png"></a>
                        <div class="ps-block__right">
                          <div class="ps-dropdown"> 
                              <a href="#"><img width="50" style="border-radius: 50%;" src="{{AppHelper::getUserImage()}}"></a>
                              <ul class="ps-dropdown-menu menu-hover-main" style="width: 250px;">
                                  <li>
                                      <a style="display:flex;" class="main-hover-tag" href="{{route('user-dashboard')}}">
                                          <img style="border-radius: 50%;width: 23px;height: 23px;display: inline-block;align-self: center;margin-right: 6px;" src="{{AppHelper::getUserImage()}}">   
                                          <div class="h-account">
                                              <strong style="text-transform: uppercase;">{{Auth::user()->name }}</strong><br><span >View your profile</span>
                                          </div>
                                      </a>
                                  </li>

                                  @if(Auth::user()->IsVendor())                      
                                  <li><a href="{{route('vendor-dashboard')}}"> <i class="fas fa-user" style=""></i> Vendor Panel</a></li>
                                  @endif
                                  <li>     
                                      <a style="display:flex;" class="main-hover-tag" href="{{route('user-favorites','products')}}">
                                      <i class="far fa-heart"></i><span >Favorite</span></a>
                                  </li>


                                  <li>     
                                      <a style="display:flex;" class="main-hover-tag" href="{{route('user-orders')}}">
                                      <i class="far fa-clipboard-list"></i><span >Your Orders</span></a>
                                  </li>

                                  <li>     
                                      <a style="display:flex;" class="main-hover-tag" href="{{route('comming-soon')}}">
                                      <i class="far fa-comment-alt-dots" ></i><span >Message</span></a>
                                  </li>
                                  <li>
                                      <a style="display:flex;" class="main-hover-tag" href="/user/account-setting">
                                      <i class="far fa-cog" ></i><span >Account Setting</span></a>
                                  </li>

                                  <li>     
                                      <a style="display:flex;" class="main-hover-tag" href="{{route('user-logout')}}">
                                      <i class="far fa-sign-out"></i><span >Sign out</span></a>
                                  </li>
                              </ul>
                          </div>
                        </div>
                    @endif
                    <div class="ps-cart--mini">
                      <a class="header__extra" href="#"><i class="icon-bag2"></i><span class="cart-quantity" id="cart-count">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}</span></a>
                        <div class="ps-cart__content" id="style-6">
                          @include('load.cart')
                        </div>
                    </div>
           </div>
        </div>
      <!----------------------------Header Right Ends------------------------------------->
     


    </div>
  </div>
  <nav class="navigation for-announcement" style="padding: 5px">
    <div class="container">
      <div class="navigation__right" >
        <!----------------------------Mega menu ------------------------------------->
        <div class="headerfull" >
          <div class="wsmain clearfix" >
            
            <nav class="wsmenu clearfix" >
              <ul class="wsmenu-list">
               @foreach($categories as $category)
                <li aria-haspopup="true"><a href="{{
                  route('front.category',$category->slug) }}" class="navtext navtext-hover">
                  <span style="font-size: 16px;font-weight: 400;line-height: 20px;color: #000;">{{ $category->name }}</span></a>
                  @if($category->subs_count>0)
                  
                  <div class="wsshoptabing wtsdepartmentmenu wsmenn clearfix" style="width: 1205px" >
                    <div class="wsshopwp back-col clearfix" >
                      <ul class="wstabitem clearfix">
                        <div class="wstheading clearfix" style="padding: 18px 10px;margin-bottom: 0px">
                          <a class="link-cat" href="{{route('front.category',$category->slug) }}">{{$category->name}}</a>
                        </div>
                        @foreach($category->subs as $key=>$sub)

                        <li class="{{$key==0?'wsshoplink-active':''}}"><a href="#"><i class="fa fa-arrow-right" aria-hidden="true"></i> {{$sub->name}}</a>
                          <div class="wstitemright clearfix wstitemrightactive">
                            <div class="container-fluid">
                              <div class="row">
                                <div class="col-lg-8 col-md-12 clearfix">
                                  <div class="wstheading clearfix"><a class="link-cat" href="{{ route('front.subcat',['slug1' => $category->slug, 'slug2' => $sub->slug]) }}">{{$sub->name}}</a></div>
                                      @if($category->childs_count>0)
                                      <ul class="wstliststy01 clearfix" style="height:57%">
                                        @foreach($category->childs as $child)
                                        
                                        <li><a class="litext-hover" href="{{ route('front.childcat',['slug1' => $category->slug, 'slug2' => $sub->slug, 'slug3' => $child->slug]) }}">{{$child->name}}
                                          @if($child->tag)</a>
                                          <span class="wstmenutag greentag" style="background:{{$child->tag_color}}">{{$child->tag}}</span></li>
                                          @endif
                                        
                                        @endforeach
                                      </ul>
                                      @endif
                                      @if($gs->is_error)
                                      <div class="wstadsize02 clearfix" style="text-align: center;"><a href="{{$gs->error_link}}"><img src="{{ $gs->error_banner ? asset('assets/images/'.$gs->error_banner):''}}" alt=""></a></div>
                                      @endif

                                </div>
                                <div class="col-lg-4 col-md-12 clearfix" >
                                  @if($category->is_menu)
                                 <a href="{{ route('front.category',$category->slug) }}" class="wstmegamenucolr"><img src="{{asset('assets/images/categories/'.$category->image)}}" alt=""></a>
                                 @else
                                 <a href="" class="wstmegamenucolr"><img src="" alt=""></a>
                                 @endif


                                </div>
                              </div>
                            </div>
                          </div>
                        </li>
                        @endforeach
                      </ul>
                    </div>
                  </div>
                  
                  @endif
                </li>                
                @endforeach

              </ul>
            </nav>
          </div>
        </div>
        <!-----------------------End Mega menu ------------------------------------->
                    
        {{-- <div class="ps-block--header-hotline inline">
          <a href="{{route('food.store')}}" >
          <p style="line-height: 0px"><img style="width: 30px" src="{{asset('assets/front/images/food1.png')}}"> &nbsp;Food &nbsp;</p></a>
        </div> --}}
      </div>
    </div>
  </nav>
</header>


<header class="header header--mobile"  data-sticky="true">
  @if($gs->announcement_check==1)
  <div class="header__top1" style="background-color:{{$gs->announcement_color}}">
    <div class="container">     
        <p>{!! $gs->announcement_title !!}</p>  
    </div>
  </div>
  @endif
  <div class="header__top">
    <div class="container" id="mob-logo-set">
      <div class="header__left">
        <a class="navigation__item ps-toggle--sidebar ps-toggle--sidebar-men" id="custom-close-active" href="#navigation-mobile" style=""><i class="icon-menu" style="font-size: 24px;font-weight: 800"></i></a>        
        <div class="menu--product-categories">
          <div class="menu__toggle"><a  href="{{url('/')}}"><img  src="{{asset('assets/images/'.$gs->logo)}}" height="42px" alt=""></div>
        </div><a class="ps-logo" href="{{url('/')}}"><img id="mobile-logo" src="{{asset('assets/images/'.$gs->logo)}}" height="42px" alt=""></a>
      </div>
      <div class="header__center search-mob-hid">
        <form id="searchForm" class="search-form ps-form--quick-search " style="margin: 0px" action="{{ route('front.category', [Request::route('category'),Request::route('subcategory'),Request::route('childcategory')]) }}" method="GET">
          @if (!empty(request()->input('sort')))
                  <input type="hidden" name="sort" value="{{ request()->input('sort') }}">
                @endif
                @if (!empty(request()->input('minprice')))
                  <input type="hidden" name="minprice" value="{{ request()->input('minprice') }}">
                @endif
                @if (!empty(request()->input('maxprice')))
                  <input type="hidden" name="maxprice" value="{{ request()->input('maxprice') }}">
                @endif

                            <div class="ps-form__right">
                              <div class="form-group--nest">
                                <input class="form-control footersearch1" 
                                type="text" placeholder="I am Looking for ..." name="search" required="">
                                <button class="headsearch-btn"  
                                 type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                              </div>
                            </div>        
        </form>

      </div>
      <!----------------------------Header Right------------------------------------->
      <div class="header__right">
          <div class="header__actions">
              
              @if(Auth::guard('web')->check())       
                  @if(Auth::user()->IsVendor())
                      <a style="display:flex" href="{{route('vendor-dashboard')}}" data-toggle="tooltip" title="Shop Manager">
                      <img height:40px style="max-width:40px"   src="{{asset('assets/images/icons/email-logo.png')}}"/><span>&nbsp;</span></a>
                  @else
                      <a class="shop-man" href="{{route('vendor.types')}}" style="font-weight: 500;white-space: nowrap;"> Sell on luwaay</a>
                  @endif  
              @else
                  <a class="shop-man" href="{{route('vendor.types')}}" style="font-weight: 700;white-space: nowrap;"> Sell on luwaay </a>
              @endif

              @if(Auth::guard('web')->check())
              <a class="header__extra" href="{{route('user-favorites','products')}}"><i class="icon-heart"></i><span id="wishlist-count"><i>{{ count(Auth::user()->wishlists) }}</i></span></a>
              @endif

              @if(!Auth::guard('web')->check())
                  <a style="font-weight: 700;white-space: nowrap;" href="{{route('user.login')}}">Sign in</a>
                  <a class="btn mybtn" href="{{route('user-register')}}">Sign up</a>
              @endif
                  
              
              @if(Auth::guard('web')->check())                            
                  <a class="header__extra  ps-block__right-mob" href=""><img class="bell-icon" src="/assets/images/icons/nofify.png"></a>
                  <div class="ps-block__right ps-block__right-mob">
                      <div class="ps-dropdown"> 
                          <a href="#"><img width="50" style="border-radius: 50%;" src="{{AppHelper::getUserImage()}}"></a>
                          <ul class="ps-dropdown-menu menu-hover-main" style="width: 250px;">
                              <li>
                                  <a style="display:flex;" class="main-hover-tag" href="{{route('user-dashboard')}}">
                                      <img style="border-radius: 50%;width: 23px;height: 23px;display: inline-block;align-self: center;margin-right: 6px;" src="{{AppHelper::getUserImage()}}">   
                                      <div class="h-account">
                                          <strong style="text-transform: uppercase;">{{Auth::user()->name }}</strong><br><span >View your profile</span>
                                      </div>
                                  </a>
                              </li>

                              @if(Auth::user()->IsVendor())                      
                              <li><a href="{{route('vendor-dashboard')}}"> <i class="fas fa-user" style=""></i> Vendor Panel</a></li>
                              @endif
                              <li>     
                                  <a style="display:flex;" class="main-hover-tag" href="{{route('user-favorites','products')}}">
                                  <i class="far fa-heart"></i><span >Favorite</span></a>
                              </li>


                              <li>     
                                  <a style="display:flex;" class="main-hover-tag" href="{{route('user-orders')}}">
                                  <i class="far fa-clipboard-list"></i><span >Your Orders</span></a>
                              </li>

                              <li>     
                                  <a style="display:flex;" class="main-hover-tag" href="{{route('comming-soon')}}">
                                  <i class="far fa-comment-alt-dots" ></i><span >Message</span></a>
                              </li>
                              <li>
                                  <a style="display:flex;" class="main-hover-tag" href="/user/account-setting">
                                  <i class="far fa-cog" ></i><span >Account Setting</span></a>
                              </li>

                              <li>     
                                  <a style="display:flex;" class="main-hover-tag" href="{{route('user-logout')}}">
                                  <i class="far fa-sign-out"></i><span >Sign out</span></a>
                              </li>
                          </ul>
                      </div>
                  </div>
              @endif

              <a class="navigation__item ps-toggle--sidebar header__extra" href="#cart-mobile"><i class="icon-bag2"></i><span class="cart-quantity" id="cart-count1">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}</span></a>

          </div>
      </div>
      <!----------------------------Header Right Ends------------------------------------->
    </div>
  </div>
  <div class="container serach-for-mob" >
      <div class="d-inline-flex" style="width: 100%">
        <a class="navigation__item ps-toggle--sidebar  ps-toggle--sidebar-men item-dis-non" id="custom-close-active" style="height: 37px;margin-top: 2px;padding: 1px 4px;" href="#navigation-mobile" ><i class="icon-menu" style="font-size: 24px;line-height: 31px;font-weight: 800"></i></a> 

        <form id="searchForm" class="search-form ps-form--quick-search" style="width: 100%" action="{{ route('front.category', [Request::route('category'),Request::route('subcategory'),Request::route('childcategory')]) }}" method="GET">
          @if (!empty(request()->input('sort')))
                  <input type="hidden" name="sort" value="{{ request()->input('sort') }}">
                @endif
                @if (!empty(request()->input('minprice')))
                  <input type="hidden" name="minprice" value="{{ request()->input('minprice') }}">
                @endif
                @if (!empty(request()->input('maxprice')))
                  <input type="hidden" name="maxprice" value="{{ request()->input('maxprice') }}">
                @endif
                           <div class="ps-form__right" style="width: 100%">
                              <div class="form-group--nest">
                                <input class="form-control footersearch1" style="border-radius: 10px 0 0 10px" 
                                type="text" placeholder="I am Looking for ..." name="search" required="">
                                <button class="headsearch-btn"  
                                 type="submit" style="border-radius: 0 10px 10px 0;padding: 1px"><i class="fa fa-search" style="background: #feb333bf;padding: 12px;border-radius: 10px;" aria-hidden="true"></i></button>
                              </div>
                            </div>

        </form>  

        <a class="navigation__item ps-toggle--sidebar header__extra item-dis-non"  href="#cart-mobile"><i class="icon-bag2"></i><span class="cart-quantity" id="cart-count1">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}</span></a>
      </div>
  </div>
</header> 


<div class="ps-panel--sidebar" id="cart-mobile">
  <div class="ps-panel__header" style="background: #ffffff;border-bottom: 2px solid">
    <h3 style="color: black">Shopping Cart</h3><a class="ps-btn--close ps-btn--no-boder" id="custom-close1" href="#cart-mobile"></a>
  </div>
  @if(Session::has('cart'))
  <div class="navigation__content">
    <div class="ps-cart--mobile">
    <div class="ps-cart__content" id="style-6">
       @include('load.cart')
    </div>  
    </div>
  </div>
  @endif
</div>



<div class="ps-panel--sidebar" id="navigation-mobile">           
  <div class="ps-panel__header" style="background: white;border-bottom: 2px solid;">
    @if(Auth::guard('web')->check())
    <h3 style="color: black;font-size: 20px"><i class="icon-user"></i> Hello, {{Auth::user()->name }}</h3>
    @else
     <h3 style="color: brown;font-size: 20px"><i class="icon-user"></i> Hello, Login</h3>
    @endif
    <a class="ps-btn--close ps-btn--no-boder" id="custom-close" href="#navigation-mobile"></a>
  </div>
  
  <div class="container">
    <div class="ps-panel__content" style="padding-bottom: 14px;">          
        <ul class="menu--mobile">
            @if(Auth::guard('web')->check())
            <li class="menu-item"><a href="{{route('user-dashboard')}}"> Account</a></li>
            @else
            <li class="menu-item"><a href="{{route('user.login')}}"> Account</a></li>
            @endif
            <li class="menu-item"><a href="{{route('comming-soon')}}">Inbox</a></li>
            <li class="menu-item"><a href="new">My Order</a></li>

            @if(Auth::guard('web')->check() && Auth::user()->IsVendor() )
            <li class="menu-item"><a href="{{route('vendor-dashboard')}}">Shop Manager</a></li>  
            @endif 

            <li class="menu-item"><a href="{{route('vendor.types')}}">Sell On Luwaay</a></li>
            @if(Auth::guard('web')->check())
            <li class="menu-item"><a style="color: brown; font-weight: 700;" href="{{route('user-logout')}}">Logout</a></li>
            @endif

        </ul>
    </div>

    <div class="ps-panel__content">
      <h3>Shop By Categories</h3>            
      <ul class="menu--mobile">
        @php $key=1; @endphp
        @foreach($categories as $category)
            @if($key<8)
            <li class="menu-item{{$category->subs_count>0?'-has-children has-mega-menu':''}} "><a href="{{ route('front.category',$category->slug) }}">{{ $category->name }}</a><span class="sub-toggle"></span>
                @if($category->subs_count>0)
                
                <div class="mega-menu">
                    @foreach($category->subs as $sub)
                    <div class="mega-menu__column">                                    
                    <a href="{{ route('front.subcat',['slug1' => $category->slug, 'slug2' => $sub->slug]) }}"><h4>{{$sub->name}}<span class="sub-toggle"></span></h4></a>
                                @if($category->childs_count>0)
                                
                                    <ul class="mega-menu__list">
                                    @foreach($category->childs as $child)
                                    <li><a href="{{ route('front.childcat',['slug1' => $category->slug, 'slug2' => $sub->slug, 'slug3' => $child->slug]) }}">{{$child->name}}</a>
                                        @endforeach
                                    </li>
                                    </ul>
                                
                                @endif
                                
                    </div>
                    @endforeach 
                </div>
            
                @endif
                                            
            </li> 
            @php $key++; @endphp
            @endif                                    
        @endforeach                                      
      </ul>                 
    </div>
  </div>
</div>


<div class="navigation--list navigation--list-tab for-announcement">
  <nav class="navigation" style="background:white;box-shadow: 0 8px 6px -6px #c0c0c0;
   -moz-box-shadow: 3px 3px 5px 6px #ccc; margin-bottom: 12px">
    <div class="container">
      <div class="navigation__right">
        <!------------------------Mega menu ------------------------------------->
        <div class="headerfull">
          <div class="wsmain clearfix">
            
            <nav class="wsmenu  wsmen clearfix" >
              <ul class="wsmenu-list">
               @foreach($categories as $category)              
                <li aria-haspopup="true"><a href="{{($category->subs_count>0)?
                  '#':route('front.category',$category->slug) }}" class="navtext">
                  <span style="color: black">{{ $category->name }}</span></a>
                  @if($category->subs_count>0)
                  
                  <div class="wsshoptabing wtsdepartmentmenu wsmen2 clearfix " >
                    <div class="wsshopwp clearfix back-col {{($category->subs_count>5) && ($category->subs_count<8) ?'back-col2':''}} {{($category->subs_count>7 )?'back-col3':''}}" >
                      <ul class="wstabitem wsmen23 clearfix" > 
                        <div class="wstheading clearfix li-head" style="padding: 18px 10px;margin-bottom: 0px">
                          <a class="link-cat" href="{{route('front.category',$category->slug) }}">{{$category->name}}</a>
                        </div>
                        @foreach($category->subs as $key=>$sub)
                        <li class="{{$key==0?'wsshoplink-active':''}}" ><a href="#"> {{$sub->name}}</a>
                          <div class="wstitemright clearfix wstitemrightactive"{{-- style="border-left: solid 1px #eeeeee;"  --}}>
                            <div class="container-fluid" style="height: 100%">
                              <div class="row" style="height: 100%">
                                <div class="col-lg-8 col-md-12 clearfix">
                                  <div class="wstheading clearfix">
                                    <a class="link-cat" href="{{ route('front.subcat',['slug1' => $category->slug, 'slug2' => $sub->slug]) }}">{{$sub->name}}</a>
                                  </div>
                                      @if($category->childs_count>0)
                                      <ul class="wstliststy01 clearfix ban-height {{($category->subs_count>5) && ($category->subs_count<8) ?'ban-height1':''}} {{($category->subs_count>7 )?'ban-height2':''}}" >
                                        @foreach($category->childs as $child)
                                        
                                        <li><a href="{{ route('front.childcat',['slug1' => $category->slug, 'slug2' => $sub->slug, 'slug3' => $child->slug]) }}">{{$child->name}}
                                          @if($child->tag)
                                          <span class="wstmenutag greentag" style="background:{{$child->tag_color}}">{{$child->tag}}</span></a></li>
                                          @endif
                                        
                                        @endforeach
                                      </ul>
                                      @endif  
                                      @if($gs->is_error)
                                      <div class=" wstadsize02 clearfix" style="text-align: center;"><a href="{{$gs->error_link}}"><img src="{{ $gs->error_banner ? asset('assets/images/'.$gs->error_banner):''}}" alt=""></a></div>
                                      @endif                                    

                                </div>
                                <div class="col-lg-4 col-md-12 clearfix">
                                  @if($category->is_menu)
                                   <a href="{{ route('front.category',$category->slug) }}" class="wstmegamenucolr"><img src="{{asset('assets/images/categories/'.$category->image)}}" alt=""></a>
                                    @else
                                   <a href="" class="wstmegamenucolr"><img src="" alt=""></a>
                                   @endif

                                 {{--  <a href="{{ route('front.subcat',['slug1' => $sub->category->slug, 'slug2' => $sub->slug]) }}" class="wstmegamenucolr wstbootslider1"><img src="{{$sub->mega_image?asset('assets/images/categories/'.$sub->mega_image):asset('assets/front/mega_menu/images/woman-ad-img02.jpg')}}" alt=""></a> --}}

                                </div>
                              </div>
                            </div>
                          </div>
                        </li>
                        @endforeach


                      </ul>
                    </div>
                  </div>
                  
                  @endif
                </li>
                @endforeach

              </ul>
            </nav>
          </div>
        </div>
        <!------------------------End Mega menu ------------------------------------->
      </div>
      {{-- <div class="navigation__left" style="max-width: 75px">
        <div class="ps-block--header-hotline inline">
          <p><a href="{{route('food.store')}}" >  <img style="width: 30px;" src="{{asset('assets/front/images/food1.png')}}">&nbsp;<span style="display: inline-flex; padding: 12px 0px">Food </span></a></p>
        </div>
      </div> --}}
    </div>
  </nav>
</div>


