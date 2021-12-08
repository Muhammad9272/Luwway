@extends('front.layouts.app')

@section('pagelevel_css')
<link rel="stylesheet" href="{{asset('assets/front/css/lu_checkout.css')}}">

@endsection

@section('page_content')



<!-- Cart Area Start -->
<section class="cartpage">
   <div class="container">
      <div class="row">
            <div class="col-lg-6 mb-3 pl-5">
               <h4 class="text-left">  <span class="cart-quantity">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}</span> items in your cart</h4>
               
            </div>
            <div class="col-lg-6 mb-3">
               
               <a href="{{url('/')}}" class="text-right pr-3 d-block"><b>Keep Shopping</b></a>
            </div>
      </div>
      <div class="row">
         <div class="col-lg-8">
            <div class="left-area d-block">
               <div class="cart-table">
                  <div class="table">
                     @include('includes.form-success')
                     <div class="">
                        @if(Session::has('cart'))
                           @foreach($shops as $shop) 
                              @php
                              $count=1; 
                              @endphp
                           <div class="cartview">
                              
                              @foreach($products as $product)      
                                 @if($product['item']['user_id'] == $shop)                                                                     
                                    @if($count==1) 
                                        <div class="row">
                                          <div class="col-md-12">
                                             @if($product['item']->user_id==0)
                                                <div class="shop-details">
                                                   <a href="{{ route('front.category') }}" class="v-name">
                                                     <img class="store-thum" src="{{asset('assets/images/'.$gs->favicon)}}"> <span>{{ App\Models\Admin::find(1)->shop_name }} </span>
                                                   </a> 
                                                </div>
                                             @else
                                                <div class="shop-details">
                                                   <a href="{{ route('front.vendor',str_replace(' ', '-',$product['item']->user->shop_name)) }}" class="v-name">
                                                    <img class="store-thum" src="{{asset('assets/images/users/'.$product['item']->user->photo)}}"><span>{{$product['item']->user->shop_name}} </span>
                                                   </a> 
                                                   <a href="{{ route('front.vendor',str_replace(' ', '-',$product['item']->user->shop_name)) }}" class="v-shop">
                                                     Contact shop
                                                   </a> 
                                                </div>      
                                             @endif
                                          </div> 
                                       </div>
                                       @php
                                       $count+=1; 
                                       @endphp
                                    @endif
                                    <div class="cartview2 row">
                                       <div class="col-lg-8 cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values']) }}">

                                          <div class="ps-product--cart">
                                              <div class="ps-product__thumbnail py-3 pr-5"><a href="{{ route('front.product', $product['item']['slug']) }}"><img src="{{ $product['item']['photo'] ? asset('assets/images/products/'.$product['item']['photo']):asset('assets/images/noimage.png') }}" alt=""></a>
                                              </div>

                                             <div class="ps-product__content">
                                                <a href="{{ route('front.product', $product['item']['slug']) }}">{{strlen($product['item']['name']) > 60 ? substr($product['item']['name'],0,120).'...' : $product['item']['name']}}</a>
                                                <span class="d-block">
                                                  <a class="cart-remove car-btn" style="cursor: pointer;" data-href="{{ route('product.cart.remove',$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])) }}">Remove</a>
                                                </span>

                                                  @if(!empty($product['size']))
                                                   <b>{{ $langg->lang312 }}</b>: {{ $product['item']['measure'] }}{{$product['size']}} <br>
                                                   @endif
                                                   @if(!empty($product['color']))
                                                   <div class="d-flex mt-2">
                                                      <b>{{ $langg->lang313 }}</b>: <span id="color-bar" style="border: 10px solid #{{$product['color'] == "" ? "white" : $product['color']}};"></span>
                                                   </div>
                                                   @endif

                                                   @if(!empty($product['keys']))

                                                   @foreach( array_combine(explode(',', $product['keys']), explode(',', $product['values'])) as $key => $value)

                                                   <b>{{ ucwords(str_replace('_', ' ', $key))  }} : </b> {{ $value }} <br>
                                                   @endforeach

                                                   @endif
                                             </div>
                                          </div>
                                       </div>
                                    

                                       <div class="col-lg-4 ">
                                          <div class="qty-space unit-price quantity">
                                             @if($product['item']['type'] == 'Physical')
                                             <div class="qty">
                                                <ul class="chk-quant-btn">
                                                   <input type="hidden" class="prodid" value="{{$product['item']['id']}}">
                                                   <input type="hidden" class="itemid" value="{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">
                                                   <input type="hidden" class="size_qty" value="{{$product['size_qty']}}">
                                                   <input type="hidden" class="size_price" value="{{$product['item']['price']}}">
                                                    <div class="form-group--number">
                                                       <button class="up qtplus1 adding"><i class="fa fa-plus"></i></button>
                                                       <button class="down qtminus1 reducing"><i class="fa fa-minus"></i></button>
                                                       <input class="form-control qttotal" id="qty{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}" type="text" value="{{$product['qty']}}" readonly>
                                                     </div>
                                                </ul>
                                             </div>
                                             @endif
                                         
                                             @if($product['size_qty'])
                                             <input type="hidden" id="stock{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}" value="{{$product['size_qty']}}">
                                             @elseif($product['item']['type'] != 'Physical')
                                             <input type="hidden" id="stock{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}" value="1">
                                             @else
                                             <input type="hidden" id="stock{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}" value="{{$product['stock']}}">
                                             @endif
                                           
                                       
                                             <div class="pr-price text-right">
                                               <p style="display: none;" class="prc{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">
                                                {{ App\Models\Product::convertPrice($product['price']) }}                 
                                               </p>
                                                <p class="product-unit-price">
                                                  {{ App\Models\Product::convertPrice($product['item']['price']) }}                        
                                                </p>
                                                @php $dis =  App\Models\Product::where('id',$product['item']['id'])->first(); @endphp

                                                @if($dis->previous_price == 0)
                                              
                                                @else
                                                <span>  {{$dis->previous_price}}</span>
                                                @endif                                      
                                             </div>
                                          </div>                                                                      
                                             <div class="product-feat">                                     
                                                 <br>
                                                 @if($dis->previous_price == 0)
                                                 
                                                   @else
                                                   @php 
                                                     $discount=( $dis->price/$dis->previous_price)*100;
                                                     $discount=100-$discount;
                                                     $discount=intval($discount);
                                                   @endphp
                                                   <p class="text-success"> <b> Sale:</b>{{$discount}}% off</p>
                                                   @endif
                                             </div>
                                            <div class="clearfix"></div>
                                       </div>
                                    </div>
                                 @endif
                              @endforeach
                          
                              <div class="after-cart">
                                 <div class="row">
                                   <div class="col-lg-8">
                                     <form class="cart-form">                                    
                                       <div class="form-group">
                                         <textarea  class="form-control" placeholder="Add a note (optional)"></textarea>
                                       </div>
                                     </form>
                                   </div>

                                   <div class="col-lg-4">
                                    <div class="coupon">
                                        <a href="javascript:;"  data-toggle="modal" data-target="#coupn-pop"><i class="fas fa-tag "></i>Apply shop coupon codes</a>
                                        <br>

                                        <div class="clearfix"></div>
                                      </div> 
                                   </div>                                  
                                 </div>                      
                              </div>  
                           </div>                                                           
                           @endforeach
                        @endif
                     </div>
                  </div>
               </div>
            </div>
         </div>
         @if(Session::has('cart'))
         <div class="col-lg-4">
            <div class="right-area ">
               <div class="order-box ps-block--shopping-total">
                  <h4 class="title">{{ $langg->lang127 }}</h4>
                  <ul class="order-list">
                     <li>
                        <p>
                          {{--  {{ $langg->lang128 }} --}} Item(s) Total:
                        </p>
                        <P>
                           <b class="cart-total">{{ Session::has('cart') ? App\Models\Product::convertPrice($totalPrice) : '0.00' }}</b>
                        </P>
                     </li>
                     <li>
                        <p>
                           {{ $langg->lang129 }}
                        </p>
                        <P>
                           <b class="discount">{{ App\Models\Product::convertPrice(0)}}</b>
                           <input type="hidden" id="d-val" value="{{ App\Models\Product::convertPrice(0)}}">
                        </P>
                     </li>
                     <li>
                        <p>
                           {{ $langg->lang130 }}
                        </p>
                        <P>
                           <b>{{$tx}}%</b>
                        </P>
                     </li>
                  </ul>
                  <div class="total-price">
                     <p>
                        {{ $langg->lang131 }}
                     </p>
                     <p>
                        <span class="main-total">{{ Session::has('cart') ? App\Models\Product::convertPrice($mainTotal) : '0.00' }}</span>
                     </p>
                  </div>

                  <a href="{{ route('front.checkout') }}" class="order-btn1 ps-btn ps-btn--fullwidth mb-2">
                     {{ $langg->lang135 }}
                  </a>
               </div>
            </div>
         </div>
         @endif
      </div>
   </div>



<!--Coupon Modal -->
<div class="modal fade" id="coupn-pop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        
          <h4>Coupon Discount</h4>
          <form id="coupon-form" class="coupon">
            <div class="form-row" style="margin-bottom: 25px; margin-top: 25px;">
             <input type="text" class="form-control" placeholder="{{ $langg->lang133 }}" id="code" required="" autocomplete="off">                      
            </div>

            <input type="hidden" class="form-control" id="grandtotal" value="{{ Session::has('cart') ? App\Models\Product::convertPrice($mainTotal) : '0.00' }}">
            <button type="submit" class="ps-btn ps-btn--outline">{{ $langg->lang134 }}</button>
          </form>
                
      </div>
      
    </div>
  </div>
</div>
<!--Coupon Modal ends-->

</section>
<!-- Cart Area End -->
@endsection
@section('pagelevel_scripts')
@endsection