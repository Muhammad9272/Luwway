@extends('front.layouts.app')
@section('page_content')

    <div class="ps-page--single">
{{--       <div class="ps-breadcrumb">
        <div class="container">
          <ul class="breadcrumb">
            <li><a href="{{route('front.index')}}">Home</a></li>
            <li>Become a Vendor</li>
          </ul>
        </div>
      </div>
 --}}
{{--        <div class="ps-vendor-banner bg--cover" data-background="{{asset('assets/images/vendor_banner.jpg')}}">
        <div class="container">
          <h2>Millions Of Shoppers Can’t Wait To See What You Have In Store</h2><a class="ps-btn ps-btn--lg" href="#">Start Selling</a>
        </div>
      </div> --}}
      <div class="">
      <div class="row">
        <div class="col-md-12">
          <div class="seller-banner">
          <img style="height:auto" src="{{asset('assets/front/images/becomeseller/11.jpeg')}}">
          </div>
          <div class="seller-banner-btn"><button class="ps-btn ps-btn--lg point-area">Start Selling</button></div>
          
        </div>
      </div>        
      </div>

      <div class="ps-section--vendor ps-vendor-about" style="padding:20px 0px">
        <div class="container">
          <div class="ps-section__header" style="padding-bottom: 0px;color: 000">
            <p>Sell your Fashion, Craft, handmade Food plan and More, … </p>
            {{-- <h4>Join a marketplace where nearly 50 million buyers around <br> the world shop for unique items</h4> --}}
          </div>
          <div class="ps-section__content">
            <div class="pasd">
              <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                  <div class="ps-block--icon-box-2 ps-block-cus" >
                    <div class="ps-block__thumbnail"><img src="{{asset('assets/front/img/icons/vendor-1.png')}}" alt=""></div>
                    <div class="ps-block__content">
                      <h4>Great Margins</h4>
                      <div class="ps-block__desc" data-mh="about-desc">
                        <p>It doesn’t take much to list your items and once you make a sale, money get Credited</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                  <div class="ps-block--icon-box-2 ps-block-cus" >
                    <div class="ps-block__thumbnail"><img src="{{asset('assets/front/img/icons/vendor-2.png')}}" alt=""></div>
                    <div class="ps-block__content">
                      <h4>Powerful Tools</h4>
                      <div class="ps-block__desc" data-mh="about-desc">
                        <p>Our tools and services make it easy to manage, promote and grow your business.</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                  <div class="ps-block--icon-box-2 ps-block-cus" >
                    <div class="ps-block__thumbnail"><img src="{{asset('assets/front/img/icons/vendor-3.png')}}" alt=""></div>
                    <div class="ps-block__content">
                      <h4>Support 24/7</h4>
                      <div class="ps-block__desc" data-mh="about-desc">
                        <p>Our customer support provide a better service to facilitate your experience on our platform. We always online to respond to your need.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <div class="ps-section__content ps-section__content11" id="pointed-area">
            <div class="pasd">
              <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ps-block-cus">
                  <div class="row vendor-reg-pad">
                    <div class="col-md-6 col-lg-6 col-xl-6">
                      <div class="reg-padd">
                        <div class="sel-pack">
                            <div class="ps-sell__img" data-background="{{asset('assets/front/images/'.$gs->vendor_type_1)}}">
                              <div class="img-transparent"></div>
                            </div>
                        </div>
                        <div class="ps-block__content1" style="left: 30%" >
                          <a href="">Boutique Shop</a>
                        </div>
                        <div class="seller-banner-btn1"><a class="ps-btn ps-btn--lg" href="{{ route('vendor-register') }}">Create my shop</a></div>
                      </div>                      
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-6">
                      <div class="reg-padd" >
                        <div class="sel-pack">
                            <div class="ps-sell__img " data-background="{{asset('assets/front/images/'.$gs->vendor_type_2)}}" >
                              <div class="img-transparent">                                
                              </div>
                            </div>
                        </div>
                        <div class="ps-block__content1" style="left: 15%"  >
                          <a href="">Restaurant & Food Shop </a>                          
                        </div>
                        <div class="seller-banner-btn1"><a class="ps-btn ps-btn--lg" href="">Create my shop</a></div>
                      </div>                      
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <div class="container" style="margin-top:80px;margin-bottom: 80px">
            <div class="row">
              <div class="col-md-6">

                <div style="text-align: center;">
                  <h4 style="margin-bottom: 0px;color: #2f5497;font-size: 20px;" >Boutique Shop Fee</h4>
                  <div style="margin: 3px 36%;margin-bottom: 30px; border-bottom: 2px solid #2f5497;" ></div>
                  <p style=";font-size: 16px">Affordable, Transparent, and Secure  </p>              
                  <p style="padding: 4px 20px;font-size: 16px">It doesn’t cost anything to list up to 7 items, and you only pay after you sells. It's just a small percent of the money you earn</p>
                </div>

                <div class="inline-d-fle">
                    @foreach($packs as $key=>$pack)
                    
                    <div class="col-md-12 col-lg-6 col-xl-6">
                      <div class="reg-padd" >
                        <div class="ps-block__content" >
                          <h5 class="planss" style="font-size: 17px">{{$pack->title}}</h5>
                        </div>
                        <div class="ps-block__contentin">
                          <div class="par-pad">
                          <p>{!! $pack->details !!}</p> 
                          
                          </div>
                        </div>
                        
                      </div>                      
                    </div>
                   
                    @endforeach   
                </div>

                <div class="col-md-12">
                  <div class="" style="box-shadow: 0px 2px 18px #bfbfbf; padding:15px;margin-top: 50px;">
                    <div style="text-align: center;"><img style="" src="{{asset('assets/front/dollar-hand.JPG')}}"></div>
                    <div style="padding: 14px">
                    <figcaption style="text-align: justify;padding-bottom: 8px;font-size: 18px; font-family: serif;">
                    {{ $gs->withdraw_fee }}% Transaction fee, {{ $gs->withdraw_charge }}% + {{ $gs->withdraw_fixedprice }}$ payment processing fee</figcaption>
                    <p style="text-align: justify;font-size: 14px">When you sell an item, we take a small commission and an additional payment for processing fee</p>
                    </div>
                  </div>
                </div>

              </div>
              <div class="col-md-6 mob-mar-100" >

                <div style="text-align: center;">
                  <h4 style="margin-bottom: 0px;color: #2f5497;font-size: 20px;" >Restaurant & Food Shop Fee</h4>
                  <div style="margin: 3px 29%;margin-bottom: 30px; border-bottom: 2px solid #2f5497;" ></div>
                  <p style=";font-size: 16px">Affordable, Transparent, and Secure  </p>              
                  <p style="padding: 4px 20px;font-size: 16px">It doesn’t cost anything to list up to 15 food items, and you only pay after your stuff sells. It’s just a small percent of the money you earn</p>
                </div>

                <div class="inline-d-fle">
                    @foreach($packs as $key=>$pack)
                    
                    <div class="col-md-12 col-lg-6 col-xl-6">
                      <div class="reg-padd" >
                        <div class="ps-block__content" >
                          <h5 class="planss" style="font-size: 17px">{{$pack->title}}</h5>
                        </div>
                        <div class="ps-block__contentin">
                          <div class="par-pad">
                          <p>{!! $pack->details !!}</p> 
                          
                          </div>
                        </div>
                        
                      </div>                      
                    </div>
                   
                    @endforeach   
                </div>

                <div class="col-md-12">
                  <div class="" style="box-shadow: 0px 2px 18px #bfbfbf; padding:15px;margin-top: 50px;">
                    <div style="text-align: center;"><img style="" src="{{asset('assets/front/dollar-hand.JPG')}}"></div>
                    <div style="padding: 14px">
                    <figcaption style="text-align: justify;padding-bottom: 8px;font-size: 18px; font-family: serif;">
                    {{ $gs->withdraw_fee }}% Transaction fee, {{ $gs->withdraw_charge }}% + {{ $gs->withdraw_fixedprice }}$ payment processing fee</figcaption>
                    <p style="text-align: justify;font-size: 14px">When you sell an item, we take a small commission and an additional payment for processing fee</p>
                    </div>
                  </div>
                </div>

              </div>
            </div>

                         
          </div>

        </div>
      </div>

        

{{--       <div class="ps-section--vendor ps-vendor-best-fees" style="padding: 30px 0;">
        <div class="container">
          <div class="ps-section__content">
            <div class="ps-section__desc">
              <div class="row">
                <div class="col-md-3"><img style="width: 40px" src="{{asset('assets/images/money.png')}}"></div>
                <div class="col-md-9">
                  <figcaption style="text-align: justify;    padding-bottom: 8px;">5% Transaction fee, 3% + 0.30$ payment processing fee</figcaption>
                <p style="text-align: justify;font-size: 12px">When you sell an item, we take a small commission and an additional payment processing fee</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> --}}

      <div class="ps-section--vendor ps-vendor-about" style="padding:0px 0px">
        <div class="container">
          <div class="ps-section__content ps-section__content11" style="padding-top: 0px">
            <div class="pasd">
              <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ps-block-cus">
                  <div class="row">
                    <div class="col-md-4 col-lg-6 col-xl-4">
                      <img src="{{asset('assets/front/awaaly_img.jpg')}}">
                    </div>
                    <div class="col-md-8 col-lg-6 col-xl-8">
                     <h5 style="font-size: 16px">How to get your money?</h5>

                    <p>Your fund of each sell is disponible in your shop manager and can be withdraw to you by using this option:</p>
                    <ul>
                      <li>Transfer to your Bank account</li>
                      <li>Transfer your PayPal account</li>
                      <li>Transfer in cash with Western Union</li>
                      <li>Transfer in Cash with MoneyGram</li>
                    </ul> 



                    </div>
                  </div>

                </div>
              </div>              
            </div>      
          </div>  

          <div class="ps-section__content ps-section__content11" style="padding-top: 50px">

            <div class="pasd">
                <div class="sell-content">
                <h5 style="font-size: 16px">What can you sell on luwaay?</h5>
                </div>
              <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                  <div class="row" style="text-align: -webkit-center">
                    <div class="col-md-12 col-lg-4 col-xl-4">
                      <div class="img-sell-type">
                      <img src="{{asset('assets/front/images/becomeseller/1.jpeg')}}">
                      </div>
                      <div class="sel-content">
                        <p>Clothing and Accessories</p>
                      </div>
                    </div>
                    <div class="col-md-12 col-lg-4 col-xl-4">
                      <div class="img-sell-type">
                      <img src="{{asset('assets/front/images/becomeseller/2.jpeg')}}">
                      </div>
                      <div class="sel-content">
                        <p style="margin-bottom: 0px">Restaurant Food</p>
                        <span>We provide a delivery service in the US, and Canada</span>
                      </div>
                    </div>
                    <div class="col-md-12 col-lg-4 col-xl-4">
                         <div class="img-sell-type">
                          <img src="{{asset('assets/front/images/becomeseller/3.jpeg')}}">
                          </div>
                          <div class="sel-content">
                            <p>Handmade Goods</p>
                          </div>
                    </div>
                  </div>

                </div>
              </div>              
            </div>      
          </div> 

        </div>
      </div>


      <div class="ps-section--vendor ps-vendor-faqs">
        <div class="container">
          <div class="ps-section__footer">
            <p>Still have more questions? Feel free to contact us.</p><a class="ps-btn" href="{{route('front.contact')}}">Contact Us</a>
          </div>
        </div>
      </div>
      <div class="ps-vendor-banner bg--cover" data-background="{{asset('assets/front/images/becomeseller/12.jpeg')}}">
        <div class="container">
          <h2>It's time to start making money.</h2><button class="ps-btn ps-btn--lg point-area">Start Selling</button>  
        </div>
      </div>
    </div>
@endsection  

    <!-- custom scripts-->
@section('pagelevel_scripts')    
 <script type="text/javascript">
 
     $(".point-area").click(function() {
    $('html,body').animate({
        scrollTop: $("#pointed-area").offset().top},
        'slow');

   })
 </script>   
@endsection