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

   .pagination {
      font-weight: 400;
   }

   font-size: medium !important;

   .ps-list--categories li a {}

   .empty-stars:before,
   .full-stars:before {
      font-size: 17px !important;
   }
</style>

@section('page_content')


<div class="ps-page--single ps-page--vendor">
   <section class="ps-store-list">
      <div class="container">
         <aside class="ps-block--store-banner">
            <div class="ps-block__content bg--cover" data-background="{{  $store->shop_image != null ? asset('assets/images/vendor/'.$store->shop_image) : asset('assets/images/'.$gs->vendor_image) }}">
               <input type="hidden" id="user_id" value={{$store->id}}>
            </div>
            <div class="ps-block__user" style="padding: 14px 3%;">
               <div class="row" style="width:100%">
                  <div class="col-md-12 col-lg-9 col-xl-9 d-flex">
                     <div class="ps-block__user-avatar">                     
                        <img src="{{ $store->photo ? asset('assets/images/users/'.$store->photo):asset('assets/images/'.$gs->user_image) }}" alt="">

                     </div>
                     <div class="ps-block__user-content" style="padding-left: 16px;">
                        <h3><a style="font-size: 22px;font-weight: 500;" href="{{route('front.vendor',['store_name'=>str_replace(' ', '-',$store->shop_name)])}}">{{$store->shop_name}}</a>&nbsp;
                           @if($store->checkStatus())
                           <span class="badge badge-danger">
                              <lable style="font-size: 14px">Verified</label>
                           </span>
                        </h3>
                        @endif




                        <p><i class="icon-map-marker"></i>{{$store->state->name}}, {{$store->countryy->name}} | On {{ App\Models\Admin::find(1)->shop_name }} since {{$store->created_at->format('Y')}}</p>
                        <p style="display: inline;"><i class="icon-grid"></i>{{ App\Models\VendorOrder::where('user_id','=',$store->id)->where('status','=','completed')->sum('qty') }} Sales |
                           @php
                           $counter1=App\Models\Rating::where('vendor_id',$store->id)->get();
                           $counter=App\Models\Rating::storeratings13($store->id);
                           @endphp
                        <div class="ratings">
                           <div class="empty-stars"></div>
                           <div class="full-stars" style="width:{{$counter}}%"></div>

                        </div>
                        <label style="font-size: 15px">({{App\Models\Rating::StoreReviewCount($store->id)}})</label>

                        <div class="ps-dropdown language"><a style="font-size: 15px"> {{App\Models\Rating::storeratingsfeed($store->id)}}% Postive Feedback</a>
                           <ul class="ps-dropdown-menu drop-tooltip" style="width: 420px;padding: 22px;min-width: auto;max-width: none;border: 1px solid #ababab;border-radius: 5px;right: auto;">
                              <li>
                                 <h4> <label class="lbl-des1">Item Description :</label>
                                    <div class="ratings">
                                       <div class="empty-stars"></div>
                                       <div class="full-stars" style="width:{{App\Models\Rating::rate_desc($store->id)}}%"></div>
                                    </div>
                                    <label class="lbl-textt">({{App\Models\Rating::rate_desc1($store->id)}})</label>
                                    <label class="lbl-textt">Very Accurate</label>
                                 </h4>

                              </li>
                              <li>
                                 <h4> <label class="lbl-des1">Communication :</label>
                                    <div class="ratings">
                                       <div class="empty-stars"></div>
                                       <div class="full-stars" style="width:{{App\Models\Rating::rate_com($store->id)}}%"></div>
                                    </div>
                                    <label class="lbl-textt">({{App\Models\Rating::rate_com1($store->id)}})</label>
                                    <label class="lbl-textt">Satisfied</label>
                                 </h4>
                              </li>
                              <li>
                                 <h4> <label class="lbl-des1">Shipping Speed :</label>
                                    <div class="ratings">
                                       <div class="empty-stars"></div>
                                       <div class="full-stars" style="width:{{App\Models\Rating::rate_ship($store->id)}}%"></div>
                                    </div>
                                    <label class="lbl-textt">({{App\Models\Rating::rate_ship($store->id)}})</label>
                                    <label class="lbl-textt">Fast</label>
                                 </h4>
                              </li>
                           </ul>
                        </div>
                        <div class="">
                           <label style="padding-top: 6px;font-size: 15px;"><i style="color: #b3b3b3;" class="fa fa-user" aria-hidden="true"></i> &nbsp;
                              Shop Own By {{$store->name}}</label>
                        </div>
                        </p>



                     </div>


                  </div>

                  <div class="col-md-12 col-lg-3 col-xl-3">
                     <div class="ps-block__user-content-social" style="margin-top: 0px;">
                        @if(Auth::guard('web')->user())
                           @if(
                           Auth::guard('web')->user()->favorites()->where('vendor_id','=',$store->id)->get()->count() >
                           0)

                           <p class="ps-btn-seller"><i style="color: #000 !important;" class="fa fa-heart" aria-hidden="true"></i>&nbsp;Favourite Shop ({{App\Models\FavoriteSeller::where('vendor_id',$store->id)->count() }})</p>

                           @else
                           <a class="ps-btn-seller favorite-prod11 view-stor" data-href="{{ route('user-favorite',['id1' => Auth::guard('web')->user()->id, 'id2' => $store->id]) }}" href="javascript:;">
                              <i class="icofont-plus"></i>
                              Add to Favorite shop
                           </a>
                           @endif
                           <div style="margin: 15px 0px 15px 0px;">
                              <a href="#vendorform1" class="contactsel" data-toggle="modal">
                                 <i class="fa fa-envelope"></i> Contact Seller
                              </a>
                           </div>
                        @else
                        <a href="#myModal" data-toggle="modal" class="ps-btn-seller"><i class="icofont-plus"></i>
                           {{ $langg->lang224 }} </a>

                        <div style="margin: 15px 0px 15px 0px;">
                           <a href="#myModal" class="contactsel" data-toggle="modal">
                              <i class="fa fa-envelope"></i> Contact Seller
                           </a>
                        </div>


                        @endif

                        

                        <!-- AddToAny BEGIN -->
                        <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                           <a class="a2a_button_facebook"><img src="https://static.addtoany.com/buttons/custom/facebook-icon-long-shadow.png" border="0" alt="Facebook" width="27" height="27"></a>

                           <a class="a2a_button_twitter"> <img src="https://static.addtoany.com/buttons/custom/twitter-icon-long-shadow.png" border="0" alt="Twitter" width="27" height="27"></a>
                           <a class="a2a_button_gmail"></a>

                           <a class="a2a_button_instagram"></a>

                        </div>
                        <script>
                           var a2a_config = a2a_config || {};
                           a2a_config.num_services = 4;
                        </script>
                        <script async src="https://static.addtoany.com/menu/page.js"></script>
                        <!-- AddToAny END -->
                        {{-- <ul class="ps-list--social ps-list--social-cus">
                                @if($store->f_check == 1)
                                  <li>
                                    <a href="{{ $store->f_url }}" class="facebook" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                        </a>
                        </li>
                        @endif

                        @if($store->g_check == 1)
                        <li>
                           <a href="{{ $store->g_url }}" class="google-plus" target="_blank">
                              <i class="fab fa-google-plus-g"></i>
                           </a>
                        </li>
                        @endif

                        @if($store->t_check == 1)
                        <li>
                           <a href="{{ $store->t_url}}" class="twitter" target="_blank">
                              <i class="fab fa-twitter"></i>
                           </a>
                        </li>
                        @endif

                        @if($store->l_check == 1)
                        <li>
                           <a href="{{$store->t_url}}" class="linkedin" target="_blank">
                              <i class="fab fa-linkedin-in"></i>
                           </a>
                        </li>
                        @endif
                        </ul> --}}
                     </div>
                  </div>
               </div>





            </div>
         </aside>
         <div class="ps-section__wrapper">
            <div class="ps-section__left">
               <aside class="widget widget--vendor">
                  <h3 class="widget-title">Product Search</h3>
                  <div class="form-group--icon">
                     <form id="searchform" action="{{route('front.vendor', [str_replace(' ', '-',$store->shop_name),Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}" method="get">

                        <input type="hidden" name="sort" id="sort">
                        <input class="form-control" type="text" name="search" id="search" placeholder="Search..." value="{{$search}}"><i id="magnifier" style="cursor: pointer;" class="icon-magnifier"></i>
                     </form>
                  </div>
               </aside>
               <aside class="widget widget--vendor">
                  <h3 class="widget-title">Store Categories</h3>
                  <ul class="ps-list--categories">
                     <li><a href="{{route('front.vendor',['store_name'=>str_replace(' ', '-',$store->shop_name)])}}">All</a></li>
                  </ul>
                  @foreach($ccategories as $category)
                  <ul class="ps-list--categories">
                     <li class="current-menu-item menu-item-has-children"><a href="{{route('front.vendor',['store_name'=>str_replace(' ', '-',$store->shop_name),'category'=>$category->slug])}}">{{$category->name}}</a>

                        @if($category->subs)
                        @foreach($category->subs as $sub)
                        <span class="sub-toggle"><i class="fa fa-angle-down"></i></span>
                        <ul class="sub-menu">
                           <li class="current-menu-item menu-item-has-children"><a href="{{route('front.vendor',['store_name'=>str_replace(' ', '-',$store->shop_name),'category'=>$category->slug,'subcategory'=>$sub->slug])}}">{{$sub->name}}</a>
                              @if($sub->childs)
                              @foreach($sub->childs as $child)
                              <span class="sub-toggle"><i class="fa fa-angle-down"></i></span>
                              <ul class="sub-menu">
                                 <li class="current-menu-item "><a href="{{route('front.vendor',['store_name'=>str_replace(' ', '-',$store->shop_name),'category'=>$category->slug,'subcategory'=>$sub->slug,'childcategory'=>$child->slug])}}">{{$child->name}}</a>
                                 </li>
                              </ul>
                              @endforeach
                              @endif
                           </li>
                        </ul>
                        @endforeach
                        @endif
                     </li>
                  </ul>
                  @endforeach
               </aside>
               {{-- @if($store->storeschedule)
              <aside class="widget widget--vendor widget--open-time">
                <h3 class="widget-title"><i class="icon-clock3"></i> Store Hours</h3>
                <ul>
                  @if($store->storeschedule->closed1==1)
                  <li><strong>Monday:</strong><span>Closed</span></li>
                  @else
                  <li><strong>Monday:</strong><span>{{date('g:i a',strtotime($store->storeschedule->opening1))}} - {{date('g:i a',strtotime($store->storeschedule->closing1))}}</span></li>
               @endif

               @if($store->storeschedule->closed2==1)
               <li><strong>Thuesday:</strong><span>Closed</span></li>
               @else
               <li><strong>Thuesday:</strong><span>{{date('g:i a',strtotime($store->storeschedule->opening2))}} - {{date('g:i a',strtotime($store->storeschedule->closing2))}}</span></li>
               @endif

               @if($store->storeschedule->closed3==1)
               <li><strong>Wedneday:</strong><span>Closed</span></li>
               @else
               <li><strong>Wednesday:</strong><span>{{date('g:i a',strtotime($store->storeschedule->opening3))}} - {{date('g:i a',strtotime($store->storeschedule->closing3))}}</span></li>
               @endif

               @if($store->storeschedule->closed4==1)
               <li><strong>Thursday:</strong><span>Closed</span></li>
               @else
               <li><strong>Thursday:</strong><span>{{date('g:i a',strtotime($store->storeschedule->opening4))}} - {{date('g:i a',strtotime($store->storeschedule->closing4))}}</span></li>
               @endif

               @if($store->storeschedule->closed5==1)
               <li><strong>Friday:</strong><span>Closed</span></li>
               @else
               <li><strong>Friday:</strong><span>{{date('g:i a',strtotime($store->storeschedule->opening5))}} - {{date('g:i a',strtotime($store->storeschedule->closing5))}}</span></li>
               @endif

               @if($store->storeschedule->closed6==1)
               <li><strong>Saturday:</strong><span>Closed</span></li>
               @else
               <li><strong>Saturday:</strong><span>{{date('g:i a',strtotime($store->storeschedule->opening6))}} - {{date('g:i a',strtotime($store->storeschedule->closing6))}}</span></li>
               @endif


               @if($store->storeschedule->closed7==1)
               <li><strong>Sunday:</strong><span>Closed</span></li>
               @else
               <li><strong>Sunday:</strong><span>{{date('g:i a',strtotime($store->storeschedule->opening7))}} - {{date('g:i a',strtotime($store->storeschedule->closing7))}}</span></li>
               @endif

               </ul>
               </aside>
               @endif --}}
            </div>
            <div class="ps-section__right">
               {{-- <nav class="ps-store-link">
                <ul>
                  <li class="active"><a href="{{route('front.vendor',['id'=>$store->id])}}">Products</a></li>
               <li><a href="store-detail-info.html">About</a></li>
               <li><a href="store-detail.html">Policies</a></li>
               <li><a href="store-detail.html">Reviews(0)</a></li>
               </ul>
               </nav> --}}


               <div class="ps-product__content ps-tab-root">
                  <div class="ps-store-link">
                     <ul class="ps-tab-list">
                        <li class="active"><a href="#tab-1">Products</a></li>
                        <li><a href="#tab-2">About The Shop</a></li>
                        <li><a href="#tab-3">Policies</a></li>

                        <li><a href="#tab-4">Reviews({{App\Models\Rating::StoreReviewCount($store->id)}}) </a></li>

                     </ul>
                  </div>

                  <header class="header header--mobile header--mobile-categories">
                     <div class="header__filter">
                        <button class="ps-shop__filter-mb" id="filter-sidebar"><i class="icon-equalizer"></i><span>Filter</span></button>
                        <div class="header__sort">
                           <div class="item-filter">
                              <ul class="filter-list">
                                 <li class="item-short-area">

                                    <select id="sortby1" name="sort" class="short-item">
                                       <option value="date_desc" {{($sort=='date_desc')?'selected':''}}>{{$langg->lang65}}</option>
                                       <option value="date_asc" {{($sort=='date_asc')?'selected':''}}>{{$langg->lang66}}</option>
                                       <option value="price_asc" {{($sort=='price_asc')?'selected':''}}>{{$langg->lang67}}</option>
                                       <option value="price_desc" {{($sort=='price_desc')?'selected':''}}>{{$langg->lang68}}</option>
                                    </select>
                                 </li>
                              </ul>
                           </div>
                        </div>

                     </div>
                  </header>
                  <div class="ps-tabs">
                     <div class="ps-tab active" id="tab-1">
                        <div class="ps-shopping ps-tab-root">
                           <div class="ps-shopping__header tt-tab1">

                              @if($products->total()>0)
                              <p><strong>{{$products->total()}}</strong> Products found</p>
                              @else
                              <p style="font-weight: 400;font-size:large;"> No Product found </p>
                              @endif

                              <div class="ps-shopping__actions">
                                 @include('includes.filterprod')
                              </div>
                           </div>
                           <div class="ps-tabs">
                              <div class="ps-tab active" id="tab-1">
                                 <div class="ps-shopping-product">
                                    <div class="row">
                                       @if($products->total()>0)
                                       @foreach($products as $feature_product)
                                       <div class="prod-padd col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 " style="padding-right: 7px;padding-left: 7px">
                                          @include('includes.product.product')
                                       </div>
                                       @endforeach
                                       @endif
                                    </div>
                                 </div>
                                 <div class="ps-pagination">
                                    <ul class="pagination">
                                       <li> {{$products->Oneachside(2)->appends($datapag)->links('vendor.pagination.default')}}</li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="ps-tab" id="tab-2">
                        <div class="ps-document">
                           <h4>{{$store->shop_name}}</h4>
                           <p>{!! $store->shop_details !!}</p>
                        </div>
                     </div>
                     <div class="ps-tab" id="tab-3">
                        <div class="ps-document">
                           @if(!is_null($store->return_policy) && !empty($store->return_policy))
                           <p>{!! $store->return_policy !!}</p>
                           @else
                           <p>No Policies Added yet</p>
                           @endif
                        </div>
                     </div>
                     <div class="ps-tab" id="tab-4">
                        <!--Section: Block Content-->
                        <div class="row">
                           <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12 ">

                              <!--Section: Block Content-->
                              <section class="dark-grey-text mb-5">

                                 <!-- Section heading -->
                                 <h3 class="font-weight-bold text-center mb-5">Customer Reviews</h3>
                                 @if(count($store->Vendorratings) > 0)
                                 @foreach($store->Vendorratings as $review)
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
                              <!--Section: Block Content-->
                           </div>
                           <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 ">
                              @if(Auth::guard('web')->check())
                              <div class="review-area">
                                 <h4 class="title">{{ $langg->lang98 }}</h4>
                                 {{-- <div class="star-area">
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
                                            </div> --}}
                              </div>
                              <div class="write-comment-area">
                                 <div class="gocover" style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
                                 </div>
                                 <br>
                                 <form id="reviewform" action="{{route('front.vendor.review.submit')}}" method="POST">

                                    @include('includes.admin.form-both')
                                    {{ csrf_field() }}

                                    <div class="form-group form-group__rating d-flex">
                                       <label class="lbl-des">Item Description&nbsp;&nbsp;</label>
                                       <div class="br-wrapper br-theme-fontawesome-stars">
                                          <select class="ps-rating" name="rate_desc" data-read-only="false" style="display: none;">
                                             <option value="0">0</option>
                                             <option value="1">1</option>
                                             <option value="2">2</option>
                                             <option value="3">3</option>
                                             <option value="4">4</option>
                                             <option value="5">5</option>
                                          </select>
                                          <div class="br-current-rating"></div>
                                       </div>

                                    </div>

                                    <div class="form-group form-group__rating d-flex">
                                       <label class="lbl-des">Communication&nbsp;&nbsp;</label>
                                       <div class="br-wrapper br-theme-fontawesome-stars">
                                          <select class="ps-rating" name="rate_com" data-read-only="false" style="display: none;">
                                             <option value="0">0</option>
                                             <option value="1">1</option>
                                             <option value="2">2</option>
                                             <option value="3">3</option>
                                             <option value="4">4</option>
                                             <option value="5">5</option>
                                          </select>
                                          <div class="br-current-rating"></div>
                                       </div>
                                    </div>
                                    <div class="form-group form-group__rating d-flex">
                                       <label class="lbl-des">Shipping Speed &nbsp;&nbsp;</label>
                                       <div class="br-wrapper br-theme-fontawesome-stars">
                                          <select class="ps-rating" name="rate_ship" data-read-only="false" style="display: none;">
                                             <option value="0">0</option>
                                             <option value="1">1</option>
                                             <option value="2">2</option>
                                             <option value="3">3</option>
                                             <option value="4">4</option>
                                             <option value="5">5</option>
                                          </select>
                                          <div class="br-current-rating"></div>
                                       </div>
                                    </div>

                                    <div class="form-group form-group__rating d-flex">
                                       <label class="lbl-des">Overall &nbsp;&nbsp;</label>
                                       <div class="br-wrapper br-theme-fontawesome-stars">
                                          <select class="ps-rating" name="rating" data-read-only="false" style="display: none;">
                                             <option value="0">0</option>
                                             <option value="1">1</option>
                                             <option value="2">2</option>
                                             <option value="3">3</option>
                                             <option value="4">4</option>
                                             <option value="5">5</option>
                                          </select>
                                          <div class="br-current-rating"></div>
                                       </div>
                                    </div>

                                    {{-- <input type="hidden" id="rating" name="rating" value="5"> --}}
                                    <input type="hidden" name="user_id" value="{{Auth::guard('web')->user()->id}}">
                                    <input type="hidden" name="vendor_id" value="{{$store->id}}">
                                    <div class="row">
                                       <div class="col-lg-12">
                                          <textarea name="review" class="form-control" placeholder="{{ $langg->lang99 }}" cols="40" rows="5" required=""></textarea>
                                       </div>
                                    </div>
                                    <div class="row" style="margin-top: 13px;">
                                       <div class="col-lg-12">
                                          <button style="background-color: #fcb800;
                                            border-color: #fcb800;" class="submit-btn btn btn-primary" type="submit">
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
                        <!--Section: Block Content-->
                     </div>
                  </div>
               </div>




            </div>
         </div>
      </div>
   </section>
</div>


<!---Mobile Filters-->
<div class="ps-filter--sidebar">
   <div class="ps-filter__header">
      <h3>Filter Products</h3><a class="ps-btn--close ps-btn--no-boder" href="#"></a>
   </div>
   <div class="ps-filter__content">
      <aside class="widget widget--vendor">
         <h3 class="widget-title">Product Search</h3>
         <div class="form-group--icon">
            <form id="searchform-mob" action="{{route('front.vendor', [str_replace(' ', '-',$store->shop_name),Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}" method="get">

               <input type="hidden" name="sort" id="sort-mob">
               <input class="form-control" type="text" name="search" id="search" placeholder="Search..." value="{{$search}}"><i id="magnifier-mob" style="cursor: pointer;" class="icon-magnifier"></i>
            </form>
         </div>
      </aside>
      <aside class="widget widget--vendor">
         <h3 class="widget-title">Store Categories</h3>
         <ul class="ps-list--categories">
            <li><a href="{{route('front.vendor',['store_name'=>str_replace(' ', '-',$store->shop_name)])}}">All</a></li>
         </ul>
         @foreach($ccategories as $category)
         <ul class="ps-list--categories">
            <li class="current-menu-item menu-item-has-children"><a href="{{route('front.vendor',['store_name'=>str_replace(' ', '-',$store->shop_name),'category'=>$category->slug])}}">{{$category->name}}</a>

               @if($category->subs)
               @foreach($category->subs as $sub)
               <span class="sub-toggle"><i class="fa fa-angle-down"></i></span>
               <ul class="sub-menu">
                  <li class="current-menu-item menu-item-has-children"><a href="{{route('front.vendor',['store_name'=>str_replace(' ', '-',$store->shop_name),'category'=>$category->slug,'subcategory'=>$sub->slug])}}">{{$sub->name}}</a>
                     @if($sub->childs)
                     @foreach($sub->childs as $child)
                     <span class="sub-toggle"><i class="fa fa-angle-down"></i></span>
                     <ul class="sub-menu">
                        <li class="current-menu-item "><a href="{{route('front.vendor',['store_name'=>str_replace(' ', '-',$store->shop_name),'category'=>$category->slug,'subcategory'=>$sub->slug,'childcategory'=>$child->slug])}}">{{$child->name}}</a>
                        </li>
                     </ul>
                     @endforeach
                     @endif
                  </li>
               </ul>
               @endforeach
               @endif
            </li>
         </ul>
         @endforeach
      </aside>
      {{-- @if($store->storeschedule)
              <aside class="widget widget--vendor widget--open-time">
                <h3 class="widget-title"><i class="icon-clock3"></i> Store Hours</h3>
                <ul>
                  @if($store->storeschedule->closed1==1)
                  <li><strong>Monday:</strong><span>Closed</span></li>
                  @else
                  <li><strong>Monday:</strong><span>{{date('g:i a',strtotime($store->storeschedule->opening1))}} - {{date('g:i a',strtotime($store->storeschedule->closing1))}}</span></li>
      @endif

      @if($store->storeschedule->closed2==1)
      <li><strong>Thuesday:</strong><span>Closed</span></li>
      @else
      <li><strong>Thuesday:</strong><span>{{date('g:i a',strtotime($store->storeschedule->opening2))}} - {{date('g:i a',strtotime($store->storeschedule->closing2))}}</span></li>
      @endif

      @if($store->storeschedule->closed3==1)
      <li><strong>Wedneday:</strong><span>Closed</span></li>
      @else
      <li><strong>Wednesday:</strong><span>{{date('g:i a',strtotime($store->storeschedule->opening3))}} - {{date('g:i a',strtotime($store->storeschedule->closing3))}}</span></li>
      @endif

      @if($store->storeschedule->closed4==1)
      <li><strong>Thursday:</strong><span>Closed</span></li>
      @else
      <li><strong>Thursday:</strong><span>{{date('g:i a',strtotime($store->storeschedule->opening4))}} - {{date('g:i a',strtotime($store->storeschedule->closing4))}}</span></li>
      @endif

      @if($store->storeschedule->closed5==1)
      <li><strong>Friday:</strong><span>Closed</span></li>
      @else
      <li><strong>Friday:</strong><span>{{date('g:i a',strtotime($store->storeschedule->opening5))}} - {{date('g:i a',strtotime($store->storeschedule->closing5))}}</span></li>
      @endif

      @if($store->storeschedule->closed6==1)
      <li><strong>Saturday:</strong><span>Closed</span></li>
      @else
      <li><strong>Saturday:</strong><span>{{date('g:i a',strtotime($store->storeschedule->opening6))}} - {{date('g:i a',strtotime($store->storeschedule->closing6))}}</span></li>
      @endif


      @if($store->storeschedule->closed7==1)
      <li><strong>Sunday:</strong><span>Closed</span></li>
      @else
      <li><strong>Sunday:</strong><span>{{date('g:i a',strtotime($store->storeschedule->opening7))}} - {{date('g:i a',strtotime($store->storeschedule->closing7))}}</span></li>
      @endif

      </ul>
      </aside>
      @endif --}}
   </div>
</div>
<!---Mobile Filters ends-->



@if(Auth::guard('web')->check())

{{-- MESSAGE VENDOR MODAL --}}

<div class="message-modal">
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
                      <input type="text" class="input-field" readonly="" placeholder="Send To {{ $store->shop_name }}" readonly="">
                    </li>

                    <li>
                      <input type="text" class="input-field" id="subj" name="subject" placeholder="{{ $langg->lang119}}" required="">
                    </li>

                    <li>
                      <textarea class="input-field textarea" name="message" id="msg" placeholder="{{ $langg->lang120 }}" required=""></textarea>
                    </li>

                    <input type="hidden" name="email" value="{{ Auth::guard('web')->user()->email }}">
                    <input type="hidden" name="name" value="{{ Auth::guard('web')->user()->name }}">
                    <input type="hidden" name="user_id" value="{{ Auth::guard('web')->user()->id }}">
                    <input type="hidden" name="vendor_id" value="{{ $store->id }}">

                  </ul>
                  <button class="submit-btn" id="emlsub1" type="submit">{{ $langg->lang118 }}</button>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>

{{-- MESSAGE VENDOR MODAL ENDS --}}


@endif


@endsection
<!-- custom scripts-->
@section('pagelevel_scripts')


<script type="text/javascript">
          $(document).on("submit", "#emailreply" , function(){
          var token = $(this).find('input[name=_token]').val();
          var subject = $(this).find('input[name=subject]').val();
          var message =  $(this).find('textarea[name=message]').val();
          var email = $(this).find('input[name=email]').val();
          var name = $(this).find('input[name=name]').val();
          var user_id = $(this).find('input[name=user_id]').val();
          var vendor_id = $(this).find('input[name=vendor_id]').val();
          $('#subj').prop('disabled', true);
          $('#msg').prop('disabled', true);
          $('#emlsub').prop('disabled', true);
     $.ajax({
            type: 'post',
            url: "{{URL::to('/vendor/contact')}}",
            data: {
                '_token': token,
                'subject'   : subject,
                'message'  : message,
                'email'   : email,
                'name'  : name,
                'user_id'   : user_id,
                'vendor_id'  : vendor_id
                  },
            success: function() {
          $('#subj').prop('disabled', false);
          $('#msg').prop('disabled', false);
          $('#subj').val('');
          $('#msg').val('');
        $('#emlsub').prop('disabled', false);
        toastr.success("{{ $langg->message_sent }}");
        $('.ti-close').click();
            }
        });
          return false;
        });
</script>

<script type="text/javascript">
   $(function() {
      $('#magnifier').on('click', function() {

         $('#searchform').submit();
      })
   })
</script>
<script type="text/javascript">
   $(function() {
      $('#magnifier-mob').on('click', function() {

         $('#searchform-mob').submit();
      })
   })
</script>


<script type="text/javascript">
   $("#sortby").on('change', function() {

      let sort = $("#sortby").val();
      $('#sort').val(sort);
      $('#searchform').submit();

      // var url = window.location.href;
      // window.location = url + '?sort='+sort; 
      // window.location = "{{route('front.category')}}?sort="+sort;
      // window.location = mainurl + '?sort='+sort;
   });
</script>
<script type="text/javascript">
   $("#sortby1").on('change', function() {
      let sort = $("#sortby1").val();
      $('#sort-mob').val(sort);
      $('#searchform-mob').submit();

   });
</script>
{{-- <script type="text/javascript">

$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
<script type="text/javascript">
   $('#search').on('keyup', function(event) {
      if (event.keyCode === 13) {
         var value = $(this).val();
         var user_id = $('#user_id').val();

         if ($('#tab-2').hasClass('active')) {
            $('#tab-2').removeClass('active');
            $('.tab-col').remove();
         }

         $.ajax({
            type: 'get',
            url: "{{url('get-searched-product')}}",
            data: {
               'search': value,
               'user_id': user_id
            },


            success: function(data) {
               if (data) {
                  $('#tab-1').removeClass('active');
                  $.each(data, function(key, value) {

                     $('#tab-2').addClass('active');
                     $("#tab-2-row").append(' <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-6 tab-col"><div class="ps-product"><div class="ps-product__thumbnail"><a href="product-default.html"><img src="/assets/images/thumbnails/' + value.thumbnail + '" alt=""/></a><ul class="ps-product__actions"><li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li><li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li><li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li><li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li></ul></div><div class="ps-product__container"><a class="ps-product__vendor" href="#"></a><div class="ps-product__content"><a class="ps-product__title" href="product-default.html"></a><div class="ps-product__rating"> <select class="ps-rating" data-read-only="true"><option value="1">1</option><option value="1">2</option><option value="1">3</option><option value="1">4</option><option value="2">5</option> </select><span>02</span></div><p class="ps-product__price sale">$990.99 <del>$1050.50 </del></p></div><div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Anderson Composites – Custom Hood</a><p class="ps-product__price sale">$990.99 <del>$1050.50 </del></p></div></div></div></div>');
                     console.log(value.thumbnail);
                  });
               }
            }
         });
      }
   })
</script>

--}}

@endsection