@extends('front.layouts.app')
@section('pagelevel_css')

 <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/css/intlTelInput.css" rel="stylesheet" media="screen">
{!! NoCaptcha::renderJs() !!}
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
                    <a href="{{ route('front.contact') }}">
                        {{ $langg->lang20 }}
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="ps-contact-info">
        
        <div class="container">
            <div class="ps-section__header">
                {!! $ps->contact_title !!}
                 {!! $ps->contact_text !!}
            </div>

            <div class="ps-section__content">
               
                <div class="row contact-mob" >
                    <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 ">
                        <div class="contact-form11">
                            <form class="ps-form--contact-us" id="contactform" action="{{route('front.contact.submit')}}" method="POST">
                                {{csrf_field()}}
                                @include('includes.vendor.form-both')
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                        <div class="form-group">
                                            <input type="text" class="form-control contact-border" name="name" placeholder="{{ $langg->lang47 }} *" required="">
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                        <div class="form-group">
                                           
                                             <input id="phone" style="border-radius: 4px" class="form-control "  type="tel" required="">
                                                
                                                <span id="error-msg" style="color: red" class="hide">Invalid number</span>
                                            <input id="phone_orig" type="hidden" style="border-radius: 4px" class="form-control " name="phone" type="tel">
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                        <div class="form-group">
                                            <input type="email" class="form-control contact-border" name="email" placeholder="{{ $langg->lang49 }} *" required="">
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                        <div class="form-group">
                                            <textarea name="text" class="form-control contact-border" placeholder="{{ $langg->lang50 }} *" required="" rows="5"></textarea>
                                        </div>
                                    </div>
                                   
                                    {{-- <div class="col-md-12">
                                              <div class="captcha">
                                              <span>{!! captcha_img() !!}</span>
                                              <a data-href="{{route('load-new-captcha')}}"
                                               type="button" href="#" id="reload-cap"  class="btn btn-success btn-refresh"><i class="fa fa-refresh"></i></a>
                                              </div>
                                              <div class="form-group">
                                                  <input id="captcha" type="text" class="form-control mt-20" placeholder="Enter Captcha" required="" name="captcha">
                                              </div>
                                              
                                    </div> --}}
                                    <div class="col-md-12">
                                        <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                            <label class="col-md-4 control-label">Captcha</label>
                                            <div class="col-md-6">
                                                {!! app('captcha')->display() !!}
                                                @if ($errors->has('g-recaptcha-response'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    

 


                                </div>
                                <div class="form-group submit">
                                    <input type="hidden" name="to" value="{{ $ps->contact_email }}">
                                    <button class="ps-btn submit-btn " id="contact-btn-sub" type="submit">
                                        <i class="fa fa-refresh fa-spin" style="display: none"></i>
                                        {{ $langg->lang52 }}
                                    </button>
                                    {{-- <button class="ps-btn">Send message</button> --}}
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class=" col-xl-1 col-lg-1 col-md-12 col-sm-12 col-12"></div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12" id="contact-bg1">
                        <div class="contact-bg1124">
                            @if($ps->site != null || $ps->email != null )

                                <div class="contact-info11">
                                    <div class="icon" style="color: brown">
                                        <i class="fas fa-envelope mt-4 fa-2x"></i>
                                    </div>
                                    <div class="content11">                                    
                                        @if($ps->email != null)
                                         <a href="mailto:{{$ps->email}}">{{$ps->email}}</a>
                                        @endif
                                    </div>
                                </div>

                            @endif
                            @if($ps->street != null)

                                <div class="contact-info11">
                                    <div class="icon" style="color: brown">
                                        <i class="fas fa-map-marker-alt fa-2x"></i>
                                    </div>
                                    <div class="content11">
                                        
                                            @if($ps->street != null)
                                            {!! $ps->street !!}
                                            @endif
                                                                           
                                    </div>

                                </div>

                            @endif
                            @if($ps->phone != null || $ps->fax != null )

                                <div class="contact-info11">
                                    <div class="icon" style="color: brown">
                                        <i class="fas fa-phone mt-4 fa-2x"></i>
                                    </div>
                                    <div class="content11">
                                        @if($ps->phone != null && $ps->fax != null)
                                        <a href="tel:{{$ps->phone}}">{{$ps->phone}}</a>
                                        <a href="tel:{{$ps->fax}}">{{$ps->fax}}</a>
                                        @elseif($ps->phone != null)
                                        <a href="tel:{{$ps->phone}}">{{$ps->phone}}</a>
                                        @else
                                        <a href="tel:{{$ps->fax}}">{{$ps->fax}}</a>
                                        @endif
                                    </div>
                                </div>

                            @endif

{{--                             <div class="contact-social11">
                                <h4 style="color: #000000">{{ $langg->lang53 }}</h4>
                                <ul class="ps-list--social">
                                    @if(App\Models\Socialsetting::find(1)->f_status == 1)
                                    <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->facebook }}" class="facebook" target="_blank">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    @endif

                                    @if(App\Models\Socialsetting::find(1)->g_status == 1)
                                    <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->gplus }}" class="google-plus" target="_blank">
                                            <i class="fab fa-google-plus-g"></i>
                                        </a>
                                    </li>
                                    @endif

                                    @if(App\Models\Socialsetting::find(1)->t_status == 1)
                                    <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->twitter }}" class="twitter" target="_blank">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    @endif

                                    @if(App\Models\Socialsetting::find(1)->l_status == 1)
                                    <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->linkedin }}" class="linkedin" target="_blank">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                    @endif

                                    @if(App\Models\Socialsetting::find(1)->d_status == 1)
                                    <li>
                                        <a href="{{ App\Models\Socialsetting::find(1)->dribble }}" class="dribbble" target="_blank">
                                            <i class="fab fa-dribbble"></i>
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </div> --}}
                        </div>
                                                
                    </div>
    

                </div>
            </div>
        </div>
    </div>
{{--     <div class="ps-contact-form">
        <div class="container">

            <form class="ps-form--contact-us" id="contactform" action="{{route('front.contact.submit')}}" method="POST">
                {{csrf_field()}}

                <h3>Get In Touch</h3>
                @include('includes.vendor.form-both')
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="{{ $langg->lang47 }} *" required="">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="{{ $langg->lang47 }} *" required="">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                        <div class="form-group">
                            <input type="text" class="form-control" name="phonr" placeholder="{{ $langg->lang48 }} *">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="{{ $langg->lang49 }} *" required="">
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                        <div class="form-group">
                            <textarea name="text" class="form-control" placeholder="{{ $langg->lang50 }} *" required="" rows="5"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group submit">
                    <input type="hidden" name="to" value="{{ $ps->contact_email }}">
                    <button class="ps-btn submit-btn " type="submit">
                        <i class="fa fa-refresh fa-spin" style="display: none"></i>
                        {{ $langg->lang52 }}
                    </button>

                </div>
            </form>
        </div>
    </div> --}}
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
    var val=$(".selected-dial-code").text();
    var ph=$('#phone').val();
    var phone=val+" "+ph;
    
$('#phone_orig').val(phone);
  reset();


// alert(val);
  if ($.trim(telInput.val())) {
    if (telInput.intlTelInput("isValidNumber")) {
      validMsg.removeClass("hide");
      $('#contact-btn-sub').css('pointer-events','auto');
    } else {
      telInput.addClass("error");
      errorMsg.removeClass("hide");
      $('#contact-btn-sub').css('pointer-events','none');
    }
  }
});

// on keyup / change flag: reset
telInput.on("keyup change", reset);
  </script>

{{-- <script type="text/javascript">
    $('#reload-cap').click(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'GET',
            url:$(this).attr('data-href'),
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });

</script> --}}

@endsection