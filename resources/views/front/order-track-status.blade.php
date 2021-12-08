@extends('front.layouts.app')
<link rel="stylesheet" href="{{asset('assets/front/css/trackorder/trackorder.css')}}">
<style type="text/css">
  .btn11{
    background: #6d685a !important;
  }
/*  a:hover {
    color:white !important;
  }*/
  .font-weight-bold {
    color: #fcb800;
  }
</style>
@section('page_content')
      <div class="ps-breadcrumb">
        <div class="container">
          <ul class="breadcrumb">
            <li><a href="{{route('front.index')}}">Home</a></li>
            <li><a href="{{route('front.category')}}">Shop</a></li>
            <li> Order Tracking</li>
          </ul>
        </div>
      </div>

<!-- Button to Open the Modal --> 

      <div class="container px-1 px-md-4 py-5 mx-auto">
         <h3>Order Status  <span class="badge badge-primary btn11"><a href="{{Route('front.trackOrder')}}">Go Back</a></span></h3>
            @if($order)
              <div class="card">

                  <div class="row d-flex justify-content-between  top1">
                      <div class="d-flex">
                          <h5>ORDER <span class="text-primary font-weight-bold">{{$order->order_number}}</span></h5>

                      </div>
                      <div class="d-flex flex-column text-sm-right">
                          <h5>Status : &nbsp;<span class="font-weight-bold">{{$order->status}}</span></h5>
                          <p class="mb-0">{{--  {{ ucwords($track->title)}} --}}</p>
                          <p>Ordered Date <span class="font-weight-bold">{{ date('d m Y',strtotime($order->created_at)) }}</span></p>
                      </div>
                  </div> <!-- Add class 'active' to progress -->
                  <div class="row d-flex justify-content-center">
                      <div class="col-12">
                          <ul id="progressbar" class="text-center">


                              @if($order->status=="processing")
                              <li class="active step0"></li>
                              <li class="active step0"></li>
                              <li class="step0"></li>
                              <li class="step0"></li>                          
                              @elseif($order->status=="on delivery")
                              <li class="active step0"></li>
                              <li class="active step0"></li>
                              <li class="active step0"></li>
                              <li class="step0"></li>
                              @elseif($order->status=="completed")
                              <li class="active step0"></li>
                              <li class="active step0"></li>
                              <li class="active step0"></li>
                              <li class="active step0"></li>
                              @else
                              <li class="active step0"></li>
                              <li class="step0"></li>
                              <li class="step0"></li>
                              <li class="step0"></li>   
                              @endif                        

                          </ul>
                      </div>
                  </div>
                  <div class="row justify-content-between top1">
                      <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/9nnc9Et.png">
                          <div class="d-flex flex-column">
                              <p class="font-weight-bold">Order<br>Pending</p>
                          </div>
                      </div>
                      <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/u1AzR7w.png">
                          <div class="d-flex flex-column">
                              <p class="font-weight{{($order->status=="processing" ||$order->status=="on delivery" || $order->status=="completed")?'-bold':''}}">Order<br>Processing</p>
                          </div>
                      </div>
                      <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/TkPm63y.png">
                          <div class="d-flex flex-column">
                              <p class="font-weight{{($order->status=="on delivery"||$order->status=="completed")?'-bold':''}}">Order<br>On Delivery</p>
                          </div>
                      </div>
                      <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/HdsziHP.png">
                          <div class="d-flex flex-column">
                              <p class="font-weight{{($order->status=="completed")?'-bold':''}}">Order<br>Completed</p>
                          </div>
                      </div>
                  </div>
              </div>
            @else
        <div class="ps-order-tracking">
          <div class="container">
                <div class="card" style="border: none;text-align: center;">
                <h2>No Order Found </h2>
                </div>
              </div></div>
            @endif              
      </div>



@endsection
@section('pagelevel_scripts')    

@endsection 
