@extends('front.layouts.app')
<style type="text/css">
  .about_img img{
    width: 100%;
  }
</style>
@section('page_content')

      <div class="" style="padding-top: 40px">
        <div class="container" >
          <div style="text-align: center;">
             <h2>Review From Happy Customers</h2>
          </div>
        </div>
      </div>
      <div class="ps-contact-info">
        <div class="container" >
          <div class="row">
            @foreach($datas as $productt)

                 @php  
                 $rating=App\Models\Rating::where('product_id',$productt->id)->orderBy('rating','desc')->first(); 
                 @endphp
                <div class="col-12 d-inline-flex" style="border: 1px solid #bfb1b1; padding: 15px;margin-bottom: 12px" >
                  <div class="col-3">
                    <div class="ps-product--horizontal" style="margin-bottom: 10px">
                       <div class="ps-product__thumbnail"><a href="{{ route('front.product', $productt->slug) }}"><img class="img-thumbnail" src="{{ $productt->photo ? asset('assets/images/thumbnails/'.$productt->thumbnail):asset('assets/images/noimage.png') }}" alt=""/></a></div>
                     </div>
                     @if(isset($productt->userVendor))
                     <p>
                       <a href="{{ route('vendor.store.detail',$productt->userVendor->shop_name) }}">{{$productt->userVendor->shop_name}} </a>
                     </p>
                     @elseif(isset($productt->user))
                     <p>
                        <a href="{{ route('vendor.hotel.detail',$productt->user->shop_name)}}"> 
                          {{$productt->user->shop_name}}
                         </a>
                     </p>
                     @elseif($productt->user_id == 0)
                     <p>{{ App\Models\Admin::find(1)->shop_name }}</p>
                     @endif

                      <div class="ps-product__rating">
                          <div class="ratings">
                              <div class="empty-stars"></div>

                              <div class="full-stars" style="width:{{App\Models\Rating::ratings($productt->id)}}%"></div>

                          </div>
                          <span>({{count($productt->ratings)}})</span>
                      </div>              
                  </div>

                  <div class="col-9">
                     
                    <p><i class="fa fa-clock-o"></i> {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$rating->review_date)->diffForHumans() }}</p>
                                                                 
                     <div class="d-inline-flex" >
                        <div class="ratings " style="margin-right: 30px">
                          <div class="empty-stars"></div>
                          <div class="full-stars" style="width:{{$rating->rating*20}}%"></div>
                        </div> 
                        <p>
                          <span style="text-transform: capitalize;">{{ $rating->user->name }}</span> on 
                          <span style="color: #3333e8;text-decoration: underline;"> <a class="mob-ps-product__vendor" href="{{route('front.product',$productt->slug)}}">{{ Illuminate\Support\Str::limit($productt->name, 35) }}</a> </span>

                        </p>
                    </div>
                    <div>
                      <p class="dark-grey-text article">{{$rating->review}}</p>
                    </div>

                  </div>
                </div>           
            @endforeach
          </div>
        </div>
        

                      <div class="col-lg-12">
                        <div class="ps-pagination">

                        {{ $datas->Oneachside(2)->links('vendor.pagination.default') }}  
                          
                        </div> 
                      </div>
      </div>


  
@endsection

