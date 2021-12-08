                
                  <div class="ps-block--category-room awaaly-product-shad"   >
                    <div class="ps-block__thumbnail awaaly-product" > 
                      <div class="row">
                        <div class="col-md-12 awaaly-product-heart" >
                          @if(Auth::guard('web')->check())
                            <a href="javascript:;" class="add-to-wish" data-href="{{ route('user-wishlist-add',$feature_product->id) }}" data-toggle="tooltip" data-placement="top" title="Add To wishlist">           
                               <span class="awaaly-heart-span mob-awaaly-heart-span"> 
                                <i class="fa fa-heart" style="color:#7f3f3f" aria-hidden="true"></i>
                               </span>
                             </a> 
                          @else
                            <a href="#myModal" data-toggle="modal">           
                               <span class="awaaly-heart-span mob-awaaly-heart-span"> 
                                <i class="fa fa-heart" style="color:#7f3f3f" aria-hidden="true"></i>
                               </span>
                             </a>
                          @endif   

                        </div>
                      </div>             
                      <a href="{{route('front.product',$feature_product->slug)}}">
                         
                        <img src="{{asset('assets/images/thumbnails/'.$feature_product->thumbnail)}}" height="auto" alt="">
                      </a>
                      <div class="row">
                        <div class="col-md-12 awaaly-product-heart">
                          <a style="cursor: pointer;" data-href="{{ route('product.cart.add',$feature_product->id) }}"  id="addcrt"  >
                            <span class="awaaly-cart-span mob-awaaly-cart-span">
                            <i class="fas fa-shopping-cart"></i>
                            </span>
                          </a>
                        </div>
                      </div>              
                    </div>
                    
                        @if($feature_product->user_id==0)
                          <div class="row">
                            <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                              <span class="awaaly-product-logo">
                                <img src="{{asset('assets/images/'.$gs->favicon)}}" alt="">
                              </span>
                            </div>
                            <div class="col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8 awaaly-vendor-shop" >
                              <span>
                                 <p class="ps-product__vendor mob-ps-product__vendor" style="font-size: 13px;margin-bottom: 0px">{{ App\Models\Admin::find(1)->shop_name }}</p>
                              </span>
                            </div>
                          </div>               
                        @else
                          <div class="row">
                            <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                              <span class="awaaly-product-logo">
                                 <img src="{{asset('assets/images/users/'.$feature_product->user->photo)}}" alt="">
                              </span>
                           
                            </div>
                            <div class="col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8 awaaly-vendor-shop" >
                              <span>
                                 <a class="ps-product__vendor mob-ps-product__vendor mob-ps-product__vendor-font" href="{{ route('front.vendor',str_replace(' ', '-',$feature_product->user->shop_name)) }}"> {{$feature_product->user->shop_name}}</a>
                              </span>                     
                            </div>
                          </div>    
                        @endif

                        <div class="ps-block__content" >
                          <p style="text-align: -webkit-left">
                             <a class="mob-ps-product__vendor" href="{{route('front.product',$feature_product->slug)}}">{{ Illuminate\Support\Str::limit($feature_product->name, 23) }}</a>
                          </p>
                          <p class="ps-product__price">
                            <span class="ps-product__pricee">
                              {{$feature_product->showPrice()}} &nbsp; <span class="ps-product__priceee">
                              {{$feature_product->showPreviousPrice()}}</span> 
                              @if($feature_product->showPreviousPrice())
                              <span class="ps-product__pricee1">
                                @php 
                                  $discount=( $feature_product->showPrice($op)/$feature_product->showPreviousPrice($op) )*100;
                                  $discount=100-$discount;
                                  $discount=intval($discount);
                                @endphp
                              ({{$discount}}% off)</span>
                              @endif
                            </span>
                            
                           
                            @if(count($freeshipping->where('user_id',$feature_product->user_id))>0) 
                            <span class="badge badge-primary-1 ps-prod-badge"   > 
                              <i class="fa fa-truck" aria-hidden="true"></i> Free Delivery </span>
                            @endif
                          </p>
                        </div>
                    

                  </div>
                