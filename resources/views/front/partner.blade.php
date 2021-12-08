@extends('front.layouts.app')
@section('pagelevel_css')

 <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/css/intlTelInput.css" rel="stylesheet" media="screen">
 <style type="text/css">
    .ps-form--contact-us .form-group{
        margin-bottom: 13px;
     }
     .ps-form--contact-us .form-control{
        height: 45px;
     }
     .ps-contact-info{
        padding: 60px 0px 90px 0px !important;
     }
 </style>
@endsection
@section('page_content')
<div class="ps-page--single" id="contact-us">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li>
                    <a href="{{ route('front.index') }}">
                        {{ $langg->lang17 }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('front.partner') }}">
                        Partners
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="ps-contact-info">
           <div class="ps-section__header" style="margin-bottom: 50px;">
               <h4 style="font-size: -webkit-xxx-large; font-family: serif;text-align: center;">Let's Be Partner</h4>
            </div>
        <div class="partner_bg">
            <div class="ps-section__content">
               
                <div class="row contact-mob" >
                    <div class="col-md-1 col-lg-2 col-xl-3"></div>
                    <div class="col-xl-6 col-lg-8 col-md-10 col-sm-12 col-12 ">
                        <div class="partner-centr" >
                            <div class="partner-centr22" >
                                <div class="text-cont">
                                <h4 >Luwaay Partnerships</h4>
                                <h5>Tell us about what you can bring us </h5>
                                 </div>
                                <form class="ps-form--contact-us" id="contactform" action="{{route('front.partner.submit')}}" method="POST">
                                    {{csrf_field()}}
                                    @include('includes.vendor.form-both')
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                            <div class="form-group">
                                                <input type="text" class="form-control " name="name" placeholder="{{ $langg->lang47 }} *" required="">
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                            <div class="form-group">
                                                <input type="text" class="form-control " name="company" placeholder="Company Name *" required="">
                                            </div>
                                        </div>

                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                            <div class="form-group">
                                                <input type="email" class="form-control " name="email" placeholder="{{ $langg->lang49 }} *" required="">
                                            </div>
                                        </div>

                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                            <div class="form-group">
                                                <input id="phone" class="form-control " name="phone" type="tel" required="">
                                                {{-- <span id="valid-msg" class="hide">Valid</span> --}}
                                                <span id="error-msg" style="color: red" class="hide">Invalid number</span>
                                                {{-- <input type="phone" class="form-control " name="phone" placeholder="{{ $langg->lang48 }} *"> --}}
                                            </div>
                                        </div>

                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                            <div class="form-group">
                                                <textarea name="text" style="border-radius: 1px;height: auto;" class="form-control " placeholder="Please Tell us more about how you would like to together " required="" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group submit">
                                        <input type="hidden" name="to" value="{{ $ps->contact_email }}">
                                        <input type="hidden" name="country_code" id="country_cod" value="+1">
                                        <button class="ps-btn submit-btn" id="partner-btn-sub" style="width: 100%" type="submit">
                                            <i class="fa fa-refresh fa-spin" style="display: none"></i>
                                            {{-- {{ $langg->lang52 }} --}} Submit
                                        </button>
                                        {{-- <button class="ps-btn">Send message</button> --}}
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 col-lg-2 col-xl-3"></div>

                </div>
            </div>
        </div>
        <div class="container">
            <div class="ps-related-posts">
                <h3 style="margin-bottom: 1px">Our Partners</h3>
                <div style="text-align: center;border-bottom: 3px solid #fcb800;margin: 0px 48%;"></div>
                <div class="row" style="padding: 0 20%;margin-top: 50px">
                    @foreach($partners as $data)
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6 ">
                        <div class="ps-post">
                            <div class="ps-post__thumbnail">
                                <a href="{{ $data->link }}" target="_blank">
                                        <img src="{{asset('assets/images/partner/'.$data->photo)}}" alt="">
                                    </a>
                                
                            </div>

                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>


    </div>
</div>
@endsection

<!-- custom scripts-->
@section('pagelevel_scripts')

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
  preferredCountries: ['us','kw','ma'],
  preventInvalidNumbers: true,
  separateDialCode: true,
  initialCountry: "us",
  geoIpLookup: function(callback) {
  $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
    var countryCode = (resp && resp.country) ? resp.country : "";
    callback(countryCode);

  });
},
   utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"
});

var reset = function() {
  telInput.removeClass("error");
  errorMsg.addClass("hide");
  validMsg.addClass("hide");
};

// on blur: validate
telInput.blur(function() {
  reset();
var val=$(".selected-dial-code").text();
$('#country_cod').val(val);
// alert(val);
  if ($.trim(telInput.val())) {
    if (telInput.intlTelInput("isValidNumber")) {
      validMsg.removeClass("hide");
      $('#partner-btn-sub').css('pointer-events','auto');
    } else {
      telInput.addClass("error");
      errorMsg.removeClass("hide");
      $('#partner-btn-sub').css('pointer-events','none');
    }
  }
});

// on keyup / change flag: reset
telInput.on("keyup change", reset);
  </script>
@endsection