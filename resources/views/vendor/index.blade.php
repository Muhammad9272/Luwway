@extends('layouts.vendor')
<style type="text/css">
   .c-info-box-area {
      padding: 2px 30px 38px;
   }

   .row-cards-one .mycard {
      padding: 10px 23px 14px !important;
   }

   .row-cards-one .mycard .left .title {
      font-size: 15px !important;
      color: #000 !important;
      line-height: 17px !important;
      margin-bottom: 2px !important;
      font-weight: 600 !important;
   }

   .row-cards-one .mycard .left .number {
      font-size: 38px !important;
      color: #000 !important;
   }

   .row-cards-one .mycard .right .icon {
      color: #000 !important;
   }

   .bgg1 {
      background: rgb(169, 209, 142);
   }

   .bgg2 {
      background: rgb(255, 242, 204);
   }

   .bgg3 {
      background: rgb(255, 217, 102);
   }

   .bgg4 {
      background: rgb(237, 237, 237);
   }

   .bgg5 {
      background: rgb(173, 185, 202);
   }

   .bgg6 {
      background: rgb(143, 170, 220);
   }
</style>
@section('content')
<div class="wrapper-mob">
   <div class="content-area content-area-mob" style="width: 63%">
      @if($user->checkWarning())

      <div class="alert alert-danger validation text-center">
         <h3>{{ $user->displayWarning() }} </h3> <a href="{{ route('vendor-warning',$user->verifies()->where('admin_warning','=','1')->orderBy('id','desc')->first()->id) }}"> {{$langg->lang803}} </a>
      </div>

      @endif

      @php
      $notify = Carbon\Carbon::now()->addDays(1)->format('Y-m-d');
      $today = Carbon\Carbon::now()->format('Y-m-d');
      @endphp
      @if($notify==$user->date)

      <div class="alert alert-danger validation text-center">
         <h3>Your Subscription plan is expiring within 1 day </h3> <a href="{{ route('vendor-subpackage-index') }}"> Please Renew It </a>
      </div>
      @elseif($today>=$user->date)
      <div class="alert alert-danger validation text-center">
         <h3>Your Subscription plan has expired </h3> <a href="{{ route('vendor-subpackage-index') }}"> Please Renew It </a>
      </div>


      @endif

      @include('includes.form-success')
      <div class="row row-cards-one">
         <div class="col-md-12 col-lg-6 col-xl-4">
            <div class="mycard bgg1">
               <div class="left">
                  <h5 class="title">{{ $langg->lang465 }} </h5>
                  <span class="number">{{ count($pending) }}</span>
                  <a href="{{route('vendor-order-index')}}" class="link">{{ $langg->lang471 }}</a>
               </div>
               <div class="right d-flex align-self-center">
                  <div class="icon">
                     <i class="icofont-dollar"></i>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-12 col-lg-6 col-xl-4">
            <div class="mycard bgg2">
               <div class="left">
                  <h5 class="title">{{ $langg->lang466 }}</h5>
                  <span class="number">{{ count($processing) }}</span>
                  <a href="{{route('vendor-order-index')}}" class="link">{{ $langg->lang471 }}</a>
               </div>
               <div class="right d-flex align-self-center">
                  <div class="icon">
                     <i class="icofont-truck-alt"></i>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-12 col-lg-6 col-xl-4">
            <div class="mycard bgg3">
               <div class="left">
                  <h5 class="title">{{ $langg->lang467 }}</h5>
                  <span class="number">{{ count($completed) }}</span>
                  <a href="{{route('vendor-order-index')}}" class="link">{{ $langg->lang471 }}</a>
               </div>
               <div class="right d-flex align-self-center">
                  <div class="icon">
                     <i class="icofont-check-circled"></i>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-12 col-lg-6 col-xl-4">
            <div class="mycard bgg4">
               <div class="left">
                  <h5 class="title">{{ $langg->lang468 }}</h5>
                  <span class="number">{{ count($user->products) }}</span>
                  <a href="{{route('vendor-prod-index')}}" class="link">{{ $langg->lang471 }}</a>
               </div>
               <div class="right d-flex align-self-center">
                  <div class="icon">
                     <i class="icofont-cart-alt"></i>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-12 col-lg-6 col-xl-4">
            <div class="mycard bgg5">
               <div class="left">
                  <h5 class="title">{{ $langg->lang469 }}</h5>
                  <span class="number">{{ App\Models\VendorOrder::where('user_id','=',$user->id)->where('status','=','completed')->sum('qty') }}</span>
               </div>
               <div class="right d-flex align-self-center">
                  <div class="icon">
                     <i class="icofont-shopify"></i>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-12 col-lg-6 col-xl-4">
            <div class="mycard bgg6">
               <div class="left">
                  <h5 class="title">{{ $langg->lang470 }}</h5>
                  <span class="number">{{ App\Models\Product::vendorConvertPrice( App\Models\VendorOrder::where('user_id','=',$user->id)->sum('price') ) }}</span>
               </div>
               <div class="right d-flex align-self-center">
                  <div class="icon">
                     <i class="icofont-dollar-true"></i>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="Vendor-content">

         <div class="row">
            <div class="col-md-12">
               <div class="border-bottom">
                  <div class="vendor-upper">
                     <p><strong>Shop overview for last:</strong></p>&nbsp;&nbsp;

                     <div class="form-group">
                        <form action="{{route('vendor-dashboard')}}" id="chart-form1" method="get">
                           <select class="form-control" id="sortby234" name="sortby">
                              <option value="all" selected>All Time</option>
                              <option value="234-7" {{($j==7)?'selected':''}}>Last 7 days</option>
                              <option value="234-30" {{($j==30)?'selected':''}}>Last 30 days</option>
                           </select>
                        </form>
                     </div>
                  </div>
               </div>
            </div>



            <div class="row" style="width: 100%;margin-left: 1%">
               <div class="col-12 col-md-12 col-lg-6 col-xl-4 border-right">
                  <div class="c-info-box-area c-info-box">
                     <div class="c-info-box-content1">
                        <h6 class="title">{{ __('Customers Visits') }}</h6>
                     </div>
                     <div class="c-info-box box1">
                        <p>{{$clicks}}</p>
                     </div>
                  </div>
               </div>
               <div class="col-12 col-md-12 col-lg-6 col-xl-4 border-right">
                  <div class="c-info-box-area c-info-box ">
                     <div class="c-info-box-content1">
                        <h6 class="title">{{ __('Orders ') }}</h6>
                     </div>
                     <div class="c-info-box box1">
                        <p>{{$ttsales->count()}} </p>
                     </div>

                  </div>
               </div>
               <div class="col-12 col-md-12 col-lg-12 col-xl-4">
                  <div class="c-info-box-area c-info-box">
                     <div class="c-info-box-content1">
                        <h6 class="title">{{ __('Revenue') }}</h6>
                     </div>
                     <div class="c-info-box box1">
                        <p>{{$ttsales->sum('price')}}$</p>
                     </div>

                  </div>
               </div>
            </div>

         </div>
      </div>
   </div>
   <nav class="nav-sidebar nav22 border">

      <div class="upper-side border-bottom">
         <i class="fa fa-bell" aria-hidden="true"></i>
         <br><br>
         @if($not>0)
         <p><a href="{{route('vendor-order-index')}}">You have {{$not}} new Notification(s)</a></p>
         @else
         <p>No new Notification</p>
         @endif
      </div>

      <div class="lower-cont">
         <p><strong>Recent Activity:</strong></p>&nbsp;&nbsp;
         <div class="form-group">
            <form action="{{route('vendor-dashboard')}}" id="chart-form2" method="get">
               <select class="form-control" id="sortby334" name="sort">
                  <option value="all" selected>All Time</option>
                  <option value="334-7" {{($i==7)?'selected':''}}>Last 7 days</option>
                  <option value="334-30" {{($i==30)?'selected':''}}>Last 30 days</option>
               </select>
            </form>
         </div>
      </div>
      @if(count($notifications)>0)
      <div class="d-inline-flex" style="padding-left: 19px">
         <p><strong>Orders Received</strong>
         <p>&nbsp;&nbsp;&nbsp;&nbsp;

         <p><a href="{{route('vendor-order-notf-clear',Auth::user()->id)}}">Clear ALL</a></p>
      </div>
      <div class="scroll-table" id="style-6">
         <ul>


            @foreach($notifications as $not)
            <li><a href="{{route('vendor-order-show',$not->order_number)}}"> Order no:{{$not->order_number}}</a> </li>
            @endforeach


         </ul>
      </div>
      @else
      <p style="padding-left: 20px">No Activity Found</p>
      @endif
   </nav>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
   $(document).ready(function() {
      $("#sortby234").on('change', function() {
         $('#chart-form1').submit();
      })
      $("#sortby334").on('change', function() {
         $('#chart-form2').submit();
      })
   })
</script>
@endsection