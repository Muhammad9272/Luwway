@extends('front.layouts.app')
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/css/intlTelInput.css" rel="stylesheet" media="screen">
@section('page_content')


<!--     <div class="ps-breadcrumb">
      <div class="container">
        <ul class="breadcrumb">
          <li><a href="{{ route('front.index') }}">Home</a></li>
          <li><a href="">User Panel</a></li>

        </ul>
      </div>
    </div>
 -->

<section class="user-dashbord withinpitcss">
   <div class="container">
      <div class="row">
         @include('includes.user-dashboard-sidebar')
         <div class="col-lg-9">
            <div class="user-profile-details">

               <div class="account-info">
                  <div class="header-area">
                     <h4 class="title">
                        {{ $langg->lang262 }}
                     </h4>
                  </div>
                  <div class="edit-info-area">

                     <div class="body">

                        <div class="edit-info-area-form">
                           <h5>Profile Picture</h5>
                           <div class="gocover" style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
                           </div>
                           <form id="userform" action="{{route('user-profile-update')}}" method="POST" enctype="multipart/form-data">

                              {{ csrf_field() }}

                              @include('includes.admin.form-both')
                              <div class="upload-img">
                                 @if($user->is_provider == 1)
                                 <div class="img"><img src="{{ $user->photo ? asset($user->photo):asset('assets/images/'.$gs->user_image) }}">
                                 </div>
                                 @else
                                 <div class="img"><img src="{{ $user->photo ? asset('assets/images/users/'.$user->photo):asset('assets/images/'.$gs->user_image) }}">
                                 </div>
                                 @endif
                                 @if($user->is_provider != 1)
                                 <div class="file-upload-area">
                                    <label class="lab11">{{ $langg->lang263 }}
                                       <input type="file" name="photo" class="upload" size="60">
                                    </label>

                                 </div>
                                 @endif

                              </div>
                              <p class="text-center">We recommend Jpg, gif, file smaller then 15 MB and at least 400px by 400px.</p>
                              <div class="row">
                                 <div class="col-lg-6">
                                    <input name="fname" type="text" class="form-control input-field" placeholder="First name" required="" value="{{ $user->fname }}">
                                 </div>
                                 <div class="col-lg-6">
                                    <input name="lname" type="text" class="form-control input-field" placeholder="Last name" required="" value="{{ $user->lname }}">
                                 </div>
                              </div>

                              <div class="row">
                                 <div class="col-lg-6">
                                    <input name="name" type="text" class="form-control input-field" placeholder="{{ $langg->lang264 }}" required="" value="{{ $user->name }}">
                                 </div>
                                 <div class="col-lg-6">
                                    <input name="email" type="email" class="form-control input-field" placeholder="{{ $langg->lang265 }}" required="" value="{{ $user->email }}" disabled>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-lg-6">
                                    {{-- <input name="phone" type="text" class="myform-control"
                                                        placeholder="{{ $langg->lang266 }}" required=""
                                    value="{{ $user->phone }}"> --}}

                                    <input id="phone" style="border-radius: 4px" class=" form-control myform-control" type="tel" required="" value="{{ $user->phone }}">

                                    <span id="error-msg" style="color: red" class="hide">Invalid number</span>
                                    <input id="phone_orig" type="hidden" style="border-radius: 4px" class="form-control myform-control" name="phone" type="tel" value="{{ $user->phone }}">

                                 </div>
                                 <div class="col-lg-6">
                                    <select class="form-control input-field" name="gender">
                                       <option selected="" disabled="">Select Gender</option>
                                       <option value="male" {{($user->gender=='male')?'selected':''}}>Male</option>
                                       <option value="female" {{($user->gender=='female')?'selected':''}}>Female</option>
                                       <option value="other" {{($user->gender=='other')?'selected':''}}>Other</option>
                                    </select>


                                 </div>
                              </div>



                              @if(!$user->IsVendor())
                              <div class="row">

                                 <div class="col-lg-6">
                                    <select class="form-control input-field" name="country_id" id="country" required="">
                                       <option value="">{{ $langg->lang157 }}</option>
                                       @foreach($countries as $country)
                                       <option data-href="{{ route('states-load',$country->id) }}" value="{{$country->id}}" {{($user->country_id==$country->id)?'selected':''}}>{{$country->name}}</option>
                                       @endforeach
                                    </select>
                                 </div>

                                 <div class="col-lg-3">

                                    <select class="form-control input-field" id="state" name="state_id" type="text" required value="{{old('lname')}}">
                                       @foreach($states as $state)
                                       <option value="{{$state->id}}" {{ ($state->id == $user->state_id) ? 'selected' : '' }}>{{ $state->name }}</option>
                                       @endforeach

                                    </select>
                                 </div>
                                 <div class="col-lg-3">

                                    <input class="form-control input-field" id="city" name="city" type="text"  placeholder="City" value="{{$user->city}}" required>

                                 </div>
                              </div>
                              @endif
                              <div class="row">
                                 <div class="col-lg-6">
                                    <input name="zip" type="text" class="form-control input-field" placeholder="{{ $langg->lang269 }}" value="{{ $user->zip }}">
                                 </div>

                                 <div class="col-lg-6">
                                    <textarea class="form-control input-field" name="address" required="" placeholder="{{ $langg->lang270 }}">{{ $user->address }}</textarea>
                                 </div>

                              </div>

                              <div class="form-links">
                                 <button class="submit-btn" id="contact-btn-sub" style="background: #3b4a47" type="submit">{{ $langg->lang271 }}</button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

@endsection
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
      preferredCountries: ['us', 'kw', 'ma'],
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
</script>

@endsection