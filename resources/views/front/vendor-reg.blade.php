@extends('front.layouts.app')

@section('pagelevel_css')
<style type="text/css">
  .ps-list--link{
    display: block;
  }
  .mega-menu__list{
    display: block;
  }
  .ps-dropdown-menu{
    display: block;
  }
  .payment_info{
  margin-left: -15px;
  margin-right: -15px;
  background: #fbfbfb;
  padding-top: 40px;
  }
   .country-list{
    display: block;
  }
  #phone-error:after{
    top:20px;
  }
  #plan-detail ul{
    display: block;
    text-align: center;
  }
  .wsmenu>.wsmenu-list>li .wstliststy01{
    display: block;
  }
</style>

    <link rel="stylesheet" href="{{asset('assets/front/reg_form11/fonts/themify-icons/themify-icons.css')}}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{asset('assets/front/reg_form11/css/style.css')}}">

    <link rel="stylesheet" href="{{asset('assets/front/reg_form/css/pricing-plans.css')}}"/>

    <link type="text/css" rel="stylesheet" href="{{asset('assets/front/reg_form/gallery/image-uploader.css')}}">    
    <!-- Main Style Css -->
    <link rel="stylesheet" href="{{asset('assets/front/css/market-place-1.css')}}">
     <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/css/intlTelInput.css" rel="stylesheet" media="screen">

  


@endsection

@section('page_content')

<div class="ps-page--my-account">
   <div class="ps-breadcrumb">
      <div class="container">
         <ul class="breadcrumb">
            <li><a href="{{route('front.index')}}">Home</a></li>
            <li>My account</li>
         </ul>
      </div>
   </div>

   <div class="page-content1">

      {{-- @include('includes.form-success')
      @include('includes.form-error')
      @include('includes.admin.form-error') --}}
      <div class="wizard-v11">
         <h2>Register Your Botique Store Here!</h2>
         <form method="post" id="signup-form" action="{{route('vendor-register-submit')}}" class="signup-form" enctype="multipart/form-data">
            @csrf

            <h3>
               <span class="icon"><i class="ti-user"></i></span>
               <span class="title_text">Official</span>
            </h3>
            <fieldset>
               <legend>
                  <span class="step-heading">Personal Information: </span>
                  <span class="step-number">Step 1 / 3</span>
               </legend>
               <div class="form-row">
                  <div class="col-md-3">
                     <div class="form-file">
                        <input type="file" class="inputfile" name="photo" id="your_picture" onchange="readURL(this);" data-multiple-caption="{count} files selected" multiple />
                        <label for="your_picture">
                           <figure>
                              <img src="{{asset('assets/front/images/your-picture.png')}}" alt="" class="your_picture_image">
                           </figure>
                           <span class="file-button">Choose Profile picture</span>
                        </label>
                     </div>
                  </div>
                  <div class="col-md-9">
                     @if ($errors->any())
                     <div class="alert alert-danger">
                        <ul style="display:inline-table;">
                           @foreach ($errors->all() as $error)
                           <li>{{ $error }}</li>
                           @endforeach
                        </ul>
                     </div>
                     @endif

                  </div>

               </div>

               <div class="form-row">
                  <div class="col-md-12 col-lg-6">
                     <label for="first_name" class="form-label required">First name</label>
                     <input type="text" name="fname" id="first_name" />
                  </div>
                  <div class="col-md-12 col-lg-6">
                     <label for="last_name" class="form-label required">Last name</label>
                     <input type="text" name="lname" id="last_name" />
                  </div>

               </div>


               <div class="form-row">
                  <div class="col-md-12 col-lg-6">
                     <label for="user_name" class="form-label required">User name</label>
                     <input type="text" name="name" id="user_name" />
                  </div>
                  <div class="col-md-12 col-lg-6">

                     <label for="email" class="form-label ">Email</label>
                     <input type="email" name="email" id="email" />
                     <span id="error_email"></span>
                  </div>

               </div>
               <div class="form-row">
                  <div class="col-md-12 col-lg-6">
                     <label for="password" class="form-label required">Password</label>
                     <input type="password" name="password" id="regex" />
                     <div id="error_password"></div>
                  </div>
                  <div class="col-md-12 col-lg-6">
                     <label for="password_confirmation" class="form-label required">Confirm Password</label>
                     <input type="password" name="password_confirmation" id="password_confirmation" />
                  </div>
               </div>
               <div class="form-row">
                  <div class="col-md-12 col-lg-6">
                     <label for="phone_no" class="form-label required">Phone</label>
                     {{-- <input type="number" name="phone" id="phone_no" /> --}}

                     <input id="phone" style="border-radius: 4px" class="form-control " type="tel" required="">

                     <span id="error-msg" style="color: red" class="hide">Invalid number</span>
                     <input id="phone_orig" type="hidden" style="border-radius: 4px" class="form-control " name="phone" type="tel">
                  </div>
                  <div class="col-md-12 col-lg-6">
                     <label for="address" class="form-label required">Address</label>
                     <input type="text" name="address" id="address" />
                  </div>

               </div>

               <legend>
                  <span class="step-heading">Store Information: </span>
               </legend>
               <div class="form-row">
                  <div class="col-md-12 col-lg-6">
                     <label for="shop_name" class="form-label required">Shop Name</label>
                     <input type="text" name="shop_name" id="shop_name" />
                  </div>
                  <div class="col-md-12 col-lg-6">
                     <label for="owner_name" class="form-label required">Owner Name</label>
                     <input type="text" name="owner_name" id="owner_name" />
                  </div>

               </div>


               <div class="form-row">
                  <div class="col-md-12 col-lg-6">
                     <label for="shop_address" class="form-label required">Shop Address</label>
                     <input type="text" name="shop_address" id="shop_address" />
                  </div>

                  <div class="col-md-12 col-lg-6 ">
                     <label for="country" class="form-label">Address</label>
                     <div class="form-date-group">
                        <div class="form-date-item">
                           <select id="country" name="country_id" type="text">
                              <option selected="" disabled="">Country</option>
                              @foreach($countries as $country)
                              <option data-href="{{ route('states-load',$country->id) }}" value="{{$country->id}}">{{$country->name}}</option>
                              @endforeach
                           </select>
                           <span class="select-icon"><i class="ti-angle-down"></i></span>
                        </div>
                        <div class="form-date-item">
                           <select class="" id="state" name="state_id" type="text" value="{{old('lname')}}">
                              <option selected="" disabled="">State</option>
                           </select>
                           <span class="select-icon"><i class="ti-angle-down"></i></span>
                        </div>
                        <div class="form-date-item">
                           <input type="text" name="city" id="city" placeholder="City" style="border:none" />
                        </div>
                     </div>
                  </div>

               </div>


               <div class="form-row">
                  <div class="col-md-12 col-lg-6">
                     <label for="zip_code" class="form-label required"> Zip Code</label>
                     <input type="text" name="zip" id="zip_code" />
                  </div>
                  <div class="col-md-12 col-lg-6">
                     <label for="gender" class="form-label required">Gender:</label>
                     <div class="select-list">
                        <select name="gender" id="gender">
                           <option selected="" disabled="">Select Gender</option>
                           <option value="male">Male</option>
                           <option value="female">Female</option>
                           <option value="other">Other</option>


                        </select>
                     </div>
                  </div>
               </div>
               <div class="form-row">
                  <div class="col-md-12 col-lg-6">
                     <label for="shop_image" class="form-label">Store Image</label>
                     <input type="file" name="shop_image">
                  </div>
               </div>





               <div class="form-group">

               </div>



               <div class="form-group">
                  <label for="shop_details" class="form-label required">Service Description</label>
                  <textarea class="form-control" rows="5" name="shop_details" id="service_desc"></textarea>
               </div>

            </fieldset>

            <h3>
               <span class="icon"><i class="ti-star"></i></span>
               <span class="title_text">Policy</span>
            </h3>
            <fieldset>
               <legend>
                  <span class="step-heading">Terms & Conditions: </span>
                  <span class="step-number">Step 2 / 3</span>
               </legend>
               <div>
                  <h4>Cookies and Web Beacons</h4>
                  <p>
                     A cookie is a small text file that a website stores on your computer. This file contains information that your browser provides to the website each time you return. Cookies are used for record keeping purposes. A web beacon is a transparent graphical image that serves to monitor your interaction with a website. This, along with cookies and log files, provides us with analytical information that we can use to improve website performance and user experience in general. We do not link this information to personally identifying information nor do we give this information to outside third parties. This privacy statement regarding the use of cookies and web beacons is only applicable to the Free Website Templates website.
                  </p>
                  <h4>Third Party Ads</h4>
                  <p>
                     Our advertising partners may use cookies and web beacons in the ads that they serve on our website. The use of such technologies will enable the advertiser to store information about your web surfing interests, so that they can show you targeted advertisements that they believe will interest you the most. Our Privacy Policy does not cover the use of cookies and web beacons in the ads of our third party advertisers.
                  </p>

                  <p>
                     Sharing Your Personal Data:
                     Third Party Sites
                     Our website may contain links to third party websites and features. This Policy does not cover the privacy practices of such third parties. These third parties have their own privacy policies and we do not accept any responsibility or liability for their websites, features or policies. Please read their privacy policies before you submit any data to them.
                  </p>
                  <div class="ps-checkbox">
                     <input class="form-control" type="checkbox" id="review-001policy" name="privacy_policy">
                     <label for="review-001policy"><span style="color: #000">I've read and understood {{$gs->title}}'s' <a href="https://luwaay.com/privacy" style="color:#fcb800"> Terms & Conditions</a></span></label>
                  </div>

               </div>
            </fieldset>

            <h3>

               <span class="icon"><i class="ti-credit-card"></i></span>
               <span class="title_text">Plans </span>

            </h3>
            <fieldset>
               <legend>
                  <span class="step-heading"> </span>
                  <span class="step-number">Step 3 / 3</span>
               </legend>
               <h3>Subscription Plans:</h3>
               <section class="pricing-table">
                    <div class="row justify-content-md-center" style="background-color: rgb(140, 106, 14)">
                         @if($plan)
                         <div class="col-md-5 col-lg-4 mt-50 mb-20" >
                            <div class="item" id="plan-detail">
                               <div class="ribbon">Best Value</div>
                               <div class="heading">
                                  <h3 style="display: block;" id="planTitle">{{$plan->title}}</h3>
                               </div>
                               <p>{!! $plan->details !!}</p>
                               <div class="features">
                                  <h4><span class="feature">Duration</span> : <span class="value">{{$plan->days}} Days</span></h4>
                                  @if($plan->allowed_products>0)
                                  <h4><span class="feature" style="margin-left: -34px;">Products Allowed</span> : <span class="value" style="margin-right: -20px;">
                                        {{$plan->allowed_products}}
                                     </span></h4>
                                  @else
                                  <h4><span class="feature" style="margin-left: -34px;">Products Allowed</span> : <span class="value" style="margin-right: -20px;">Unlimited</span></h4>
                                  @endif
                               </div>
                               <div class="price">
                                  <input id="planPrice" type="hidden" value="{{$plan->price}}">
                                  <h4>{{$plan->currency}}{{$plan->price}}</h4>
                               </div>
                              
                            </div>
                         </div>
                         @endif
                    </div>

               </section>



            </fieldset>

         </form>
      </div>
   </div>
</div>
@endsection

    <!-- custom scripts-->
@section('pagelevel_scripts')    

    <script src="{{asset('assets/front/reg_form11/vendor/jquery-validation/dist/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/front/reg_form11/vendor/jquery-validation/dist/additional-methods.min.js')}}"></script>
    <script src="{{asset('assets/front/reg_form11/vendor/jquery-steps/jquery.steps.min.js')}}"></script>
    <script src="{{asset('assets/front/reg_form11/vendor/minimalist-picker/dobpicker.js')}}"></script>
   
    <script src="{{asset('assets/front/reg_form11/js/main.js')}}"></script>

    <script type="text/javascript" src="{{asset('assets/front/reg_form/gallery/image-uploader.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"></script>



<script type="text/javascript">

    var telInput = $("#phone"),
       errorMsg = $("#error-msg"),
       validMsg = $("#valid-msg");


    // initialise plugin
    telInput.intlTelInput({

       allowExtensions: true,
       formatOnDisplay: true,
       autoFormat: true,
       autoHideDialCode: true,
       autoPlaceholder: true,
       defaultCountry: "auto",
       ipinfoToken: "yolo",

       nationalMode: false,
       numberType: "MOBILE",
       //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
       preferredCountries: ['us', 'kw', 'ma'],
       preventInvalidNumbers: true,
       separateDialCode: true,
       initialCountry: "us",
       geoIpLookup: function (callback) {
          $.get("http://ipinfo.io", function () { }, "jsonp").always(function (resp) {
             var countryCode = (resp && resp.country) ? resp.country : "";
             callback(countryCode);

          });
       },
       utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"
    });

    var reset = function () {
       telInput.removeClass("error");
       errorMsg.addClass("hide");
       validMsg.addClass("hide");
    };

    // on blur: validate
    telInput.blur(function () {
       var val = $(".selected-dial-code").text();
       var ph = $('#phone').val();
       var phone = val + " " + ph;

       $('#phone_orig').val(phone);
       reset();
       // alert(val);
       if ($.trim(telInput.val())) {
          if (telInput.intlTelInput("isValidNumber")) {
             validMsg.removeClass("hide");
             $('#contact-btn-sub').css('pointer-events', 'auto');
          } else {
             telInput.addClass("error");
             errorMsg.removeClass("hide");
             $('#contact-btn-sub').css('pointer-events', 'none');
          }
       }
    });

    // on keyup / change flag: reset
    telInput.on("keyup change", reset);
</script >


<script>
    $(document).ready(function(){
        $('#email').blur(function () {
            var error_email = '';
            var email = $('#email').val();
            var _token = $('input[name="_token"]').val();
            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!filter.test(email)) {
               $('#error_email').html('<label class="text-danger">Invalid Email</label>');
               $('#email').addClass('has-error');
               $('a[href="#next"]').css('pointer-events', 'none');
            }
            else {
               $.ajax({
                  url: "{{ route('email_available.check') }}",
                  method: "POST",
                  data: { email: email, _token: _token },
                  success: function (result) {
                     if (result == 'unique') {
                        $('#error_email').html('<label class="text-success">Email Available</label>');
                        $('#email').removeClass('has-error');
                        $('a[href="#next"]').css('pointer-events', 'auto');
                        // $('a[href="#next"]').attr('href','#next');
                     }
                     else {
                        $('#error_email').html('<label class="text-danger">Email Already Exists</label>');
                        $('#email').addClass('has-error');
                        $('a[href="#next"]').css('pointer-events', 'none');
                        // $('a[href="#next"]').removeAttr('href');
                     }
                  }
               })
            }
        });
    });
    $('a[href="#finish"]').on('click',function(){
        $('#signup-form').submit();
    });
</script>


@if($gs->front_debug==1)
<script type="text/javascript">
    
$(document).ready(function(){
       $('form').find(':input[required]').prop('required',false);

});
</script>
@endif

@endsection    