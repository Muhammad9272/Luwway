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
        font-size: medium !important;
  } 
  .ps-list--categories li a {
    font-weight: 400;
  }
  .btn-primary {
    background-color: #fcb800 !important;
    border-color: #fcb800 !important;
    height: 30px;
   }
  .select2 .select2-selection--single .select2-selection__arrow:before {
    margin-left: 12.5pc !important;
    margin-top: -20px !important;
    top:unset !important;
    left: unset !important;
  }
  .select2 .select2-selection--single .select2-selection__arrow {
    position: unset !important;}
    .empty-stars:before, .full-stars:before{
  font-size: 18px !important;
}

</style>
@section('page_content')

    <div class="ps-page--single ps-page--vendor">
      <div class="ps-breadcrumb">
        <div class="container">
          <ul class="breadcrumb">
            <li><a href="{{route('front.index')}}">Home</a></li>
            <li><a href="{{route("front.stores")}}">Store List</a></li>
          </ul>
        </div>
      </div>
      <section class="ps-store-list">
        <div class="container">
          <div class="ps-section__header">
          <aside class="ps-block--store-banner">
            <div class="ps-block__content bg--cover" data-background="{{asset('assets/front/images/store-list.png')}}">
            {{-- <h3><a href="{{route("front.stores")}}">Store list</a></h3> --}}
            </div>
          </aside> 
              <form id="searchform-max" class="searchform-max-shop" action="{{route('front.stores')}}" method="get" >
                  <div class="row">
                    <div class="col-6 col-md-3">
                        <div class="form-group">
                          <select class="form-control" style="border-radius: 12px;height: 40px;" name="country" id="country" >
                             <option selected="" disabled="" value="">Select Country</option>
                           @foreach($countries as $country)
                            <option value="{{$country->id}}"{{$country->id==$country_id?'selected':''}} >{{$country->name}}</option>
                            @endforeach
                          </select>
                        </div>
                    </div>
                    <div class="col-6 col-md-6">
                      <div class="" style="margin-bottom: 20px;">                                        
                          <input class="form-control" style="height: 40px; border-radius: 20px;" type="text" name="searchstore" value="{{$search_rest}}" id="search" placeholder="Search Store..."><i id="magnifier-max" style="position: absolute;
                            cursor: pointer;
                            margin-top: -27px;
                            margin-left: 15pc" class="icon-magnifier magnifier-max14"></i>                    
                      </div>
                    </div>

                    <div class="col-6 col-md-3">
                       <div class="form-group">
                          <select class="form-control" id="sort" style="height: 40px;border-radius: 10px;" name="sort">
                            <option selected="" disabled="">Select Sort</option>
                            <option value="latest" {{$sort=='latest'?'selected':''}} >Sort by Newest:New To Old</option>
                            <option value="old" {{$sort=='old'?'selected':''}}>Sort by Oldest:Old To New</option>
                          </select>
                       </div>                
                    </div>
                  </div>
                </form>
              <form id="searchform-max1" class="searchform-max-shop-mob" action="{{route('front.stores')}}" method="get" >
                  <div class="row">
                    <div class="col-6 ">
                        <div class="form-group">
                          <select class="form-control" style="border-radius: 12px;height: 40px;" name="country" id="country1" >
                             <option selected="" disabled="" value="">Select Country</option>
                           @foreach($countries as $country)
                            <option value="{{$country->id}}"{{$country->id==$country_id?'selected':''}} >{{$country->name}}</option>
                            @endforeach
                          </select>
                        </div>
                    </div>
                    <div class="col-6 ">
                       <div class="form-group">
                          <select class="form-control" id="sort1" style="height: 40px;border-radius: 10px;" name="sort">
                            <option selected="" disabled="">Select Sort</option>
                            <option value="latest" {{$sort=='latest'?'selected':''}} >Sort by Newest:New To Old</option>
                            <option value="old" {{$sort=='old'?'selected':''}}>Sort by Oldest:Old To New</option>
                          </select>
                       </div>                
                    </div>

                    <div class="col-12 ">
                      <div class="" style="margin-bottom: 20px;">                                        
                          <input class="form-control" style="height: 40px; border-radius: 20px;" type="text" name="searchstore" value="{{$search_rest}}" id="search" placeholder="Search Store..."><i id="magnifier-max1" style="position: absolute;
                            cursor: pointer;
                            margin-top: -27px;
                            margin-left: 15pc" class="icon-magnifier magnifier-max14"></i>                    
                      </div>
                    </div>

                  </div>
                </form>

          </div>

          <div class="ps-section__wrapper">
            <div class="ps-section__right" style="padding-left: 0px;">
          
              <section class="ps-store-box">
                <div class="ps-section__header">
                  <p>Showing {{$stores->firstItem()}} -{{$stores->lastItem() }} of {{$stores->total()}} results</p>
                </div>
                @if($token==2)
                @include('front.includes.filter-data.filter-store')                
                @else
                <div class="ps-section__content">
                  <div class="row">
                    @foreach($stores as $store)

                      <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 ">
                        <article class="ps-block--store">
                          <div class="ps-block__thumbnail bg--cover" data-background="{{  $store->shop_image != null ? asset('assets/images/vendor/'.$store->shop_image) : asset('assets/images/'.$gs->vendor_image) }}"></div>
                          <div class="ps-block__content">
                            <div class="row">
                              <div class="col-md-3">
                                <div class="ps-block__author">
                                  
                                  <a class="ps-block__user" href="{{route('front.vendor',['store_name'=>str_replace(' ', '-',$store->shop_name)])}}"><img style="width: 85px;max-width: fit-content;" src="{{ $store->photo ? asset('assets/images/users/'.$store->photo):asset('assets/images/'.$gs->user_image) }}" alt=""></a>
                                 
                                 </div>
                              </div>
                              <div class="col-md-9">                                
                                  <a href="{{route('front.vendor',['store_name'=>str_replace(' ', '-',$store->shop_name)])}}"><h4>{{$store->shop_name}}</h4></a>

                                   @php
                                    $counter1=App\Models\Rating::where('vendor_id',$store->id)->get();
                                    $counter=App\Models\Rating::storeratings13($store->id);
                                    @endphp

                                    <div class="ratings">
                                        <div class="empty-stars"></div>
                                        <div class="full-stars" style="width:{{$counter}}%"></div>
                                    </div> 
                                     <span>({{App\Models\Rating::StoreReviewCount($store->id)}})</span> 

                                  <ul class="ps-block__contact1">                                    
                                    <li style="min-height: 42px"><i class="icon-map-marker"></i>&nbsp;<a href="#">{{$store->state->name}}, {{$store->countryy->name}}</a></li>
                                    <li style="text-align: -webkit-right;"><a class="ps-btn ps-btn-st" href="{{route('front.vendor',['store_name'=>str_replace(' ', '-',$store->shop_name)])}}">Visit Store</a></li>
                                  </ul>
                              </div>
                            </div>





                          </div>
                        </article>
                      </div>

                    @endforeach
                  </div>
                  <div class="ps-pagination">
                    <ul class="pagination">
                      <li>{{$stores->Oneachside(2)->appends($datapag)->links('vendor.pagination.default')}}</li>
                    </ul>
                  </div> 
                </div>                
                @endif
              </section>
            </div>
          </div>
        </div>
      </section>
    </div>




@endsection
@section('pagelevel_scripts')    
<script type="text/javascript">
  $(function(){

    $('#magnifier-max').on('click',function(){
     $('#searchform-max').submit();
    })
        $('#magnifier-max1').on('click',function(){
     $('#searchform-max1').submit();
    })

  })
</script> 
<script type="text/javascript">
  $(function(){
    $('#magnifier-min').on('click',function(){

$('#searchform-min').submit();
    })
  })
</script> 
<script >
  
$('#sort').on('change',function () {
  $('#searchform-max').submit();
});
$('#country').on('change',function () {
  $('#searchform-max').submit();
});

$('#sort1').on('change',function () {
  $('#searchform-max1').submit();
});
$('#country1').on('change',function () {
  $('#searchform-max1').submit();
});

</script>

   
@endsection    
