
@if(Session::has('cart'))
	<div class="ps-cart__items carttt" id="style-6">
		<div class="row">
			<div class="col-sm-6">
				<span class="item-no">
				<span class="cart-quantity">
					{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}
				</span> {{ $langg->lang4 }}
				</span>
			</div>
			<div class="col-sm-6">
				<a class="view-cart" style="float: right;" href="{{ route('front.cart') }}">
					{{ $langg->lang5 }}
				</a>
			</div>
		</div>
		<hr>
		@foreach(Session::get('cart')->items as $product)	
	    <div class="ps-product--cart-mobile cartview" >
		  <div class="ps-product__thumbnail"><a href="{{ route('front.product', $product['item']['slug']) }}"><img src="{{ $product['item']['photo'] ? filter_var($product['item']['photo'], FILTER_VALIDATE_URL) ?$product['item']['photo']:asset('assets/images/products/'.$product['item']['photo']):asset('assets/images/noimage.png') }}" alt=""></a></div>
		  <div class="ps-product__content">
		  	<a class="ps-product__remove " style="cursor: pointer;" id="rmveCart" data-href="{{ route('product.cart.remove',$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])) }}"><i class="icon-cross"></i></a>

		  	<a href="{{ route('front.product',$product['item']['slug']) }}">{{strlen($product['item']['name']) > 45 ? substr($product['item']['name'],0,45).'...' : $product['item']['name']}}</a>
		    <p><small>{{$product['qty']}}{{ $product['item']['measure'] }} x{{ App\Models\Product::convertPrice($product['item']['price']) }}</small>
		  </div>
	    </div>
		@endforeach
		<hr>
			<div class="ps-cart__footer">
			<h3>Sub Total:<strong class="cart-total"> {{ Session::has('cart') ? App\Models\Product::convertPrice(Session::get('cart')->totalPrice) : '0.00' }}</strong></h3>
			<figure><a class="ps-btn" href="{{ route('front.cart') }}">View Cart</a><a class="ps-btn" href="{{ route('front.checkout') }}" class="mybtn1">Checkout</a></figure>
		   </div>
	</div>
	
@else

	<p  style="text-align: right;">{{ $langg->lang8 }}</p> 
@endif
   <p id="item-no1" style="text-align: right;"></p> 

