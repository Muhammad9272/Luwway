@extends('layouts.vendor')
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/css/intlTelInput.css" rel="stylesheet" media="screen">
<style type="text/css">
   .hide {
      display: none;
   }

   .intl-tel-input {
      width: 100%;
   }
</style>
@section('content')

<div class="content-area">
   <div class="mr-breadcrumb">
      <div class="row">
         <div class="col-lg-12">
            <h4 class="heading">{{ $langg->lang479 }} <a class="add-btn" href="{{ url()->previous() }}"><i class="fas fa-arrow-left"></i> {{ $langg->lang480 }}</a></h4>
            <ul class="links">
               <li>
                  <a href="{{ route('vendor-dashboard') }}">{{ $langg->lang441 }} </a>
               </li>
               <li>
                  <a href="javascript:;">{{ $langg->lang472 }} </a>
               </li>
               <li>
                  <a href="javascript:;">{{ $langg->lang479 }}</a>
               </li>
            </ul>
         </div>
      </div>
   </div>


   <div class="add-product-content">
      <div class="row">
         <div class="col-lg-12">
            <div class="product-description">
               <div class="body-area">

                  <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>

                  @include('includes.admin.form-both')
                  <form id="geniusform" class="form-horizontal" action="{{route('vendor-wt-store')}}" method="POST" enctype="multipart/form-data">

                     {{ csrf_field() }}


                     <div class="item form-group">
                        <label class="control-label col-sm-4" for="name"><b>{{ $langg->lang498 }} : {{ App\Models\Product::vendorConvertPrice(Auth::user()->current_balance) }}</b></label>
                     </div>

                     <div class="item form-group">
                        <label class="control-label col-sm-4" for="name">{{ $langg->lang481 }} *

                        </label>
                        <div class="col-sm-12">
                           <select class="form-control" name="methods" id="withmethod" required>
                              <option value="">{{ $langg->lang482 }}</option>
                              <option value="Paypal">{{ $langg->lang483 }}</option>
                              <option value="Skrill">{{ $langg->lang484 }}</option>
                              <option value="Payoneer">{{ $langg->lang485 }}</option>
                              <option value="Bank">{{ $langg->lang486 }}</option>
                              <option value="MoneyGram"> MoneyGram </option>
                              <option value="Western_union">Western union </option>
                           </select>
                        </div>
                     </div>

                     <div class="item form-group">
                        <label class="control-label col-sm-12" for="name">{{ $langg->lang487 }} *

                        </label>
                        <div class="col-sm-12">
                           <input name="amount" placeholder="{{ $langg->lang487 }}" class="form-control" type="text" value="{{ old('amount') }}" required>
                        </div>
                     </div>

                     <div id="paypal" style="display: none;">

                        <div class="item form-group">
                           <label class="control-label col-sm-12" for="name">{{ $langg->lang488 }}l *

                           </label>
                           <div class="col-sm-12">
                              <input name="acc_email" placeholder="{{ $langg->lang488 }}" class="form-control" value="{{ old('email') }}" type="email">
                           </div>
                        </div>

                     </div>
                     <div id="bank" style="display: none;">

                        <div class="item form-group">
                           <label class="control-label col-sm-12" for="name">{{ $langg->lang489 }} *

                           </label>
                           <div class="col-sm-12">
                              <input name="iban" value="{{ old('iban') }}" placeholder="{{ $langg->lang489 }}" class="form-control" type="text">
                           </div>
                        </div>

                        <div class="item form-group">
                           <label class="control-label col-sm-12" for="name">{{ $langg->lang490 }} *

                           </label>
                           <div class="col-sm-12">
                              <input name="acc_name" value="{{ old('accname') }}" placeholder="{{ $langg->lang490 }}" class="form-control" type="text">
                           </div>
                        </div>

                        <div class="item form-group">
                           <label class="control-label col-sm-12" for="name">{{ $langg->lang491 }} *

                           </label>
                           <div class="col-sm-12">
                              <input name="address" value="{{ old('address') }}" placeholder="{{ $langg->lang491 }}" class="form-control" type="text">
                           </div>
                        </div>

                        <div class="item form-group">
                           <label class="control-label col-sm-12" for="name">{{ $langg->lang492 }} *

                           </label>
                           <div class="col-sm-12">
                              <input name="swift" value="{{ old('swift') }}" placeholder="{{ $langg->lang492 }}" class="form-control" type="text">
                           </div>
                        </div>

                     </div>

                     <div id="additional" style="display: none;">

                        <div class="item form-group">
                           <label class="control-label col-sm-12" for="fname">First Name *

                           </label>
                           <div class="col-sm-12">
                              <input name="fname" value="{{ old('fname') }}" placeholder="First Name" class="form-control" type="text">
                           </div>
                        </div>

                        <div class="item form-group">
                           <label class="control-label col-sm-12" for="mname"> Middle name (optional)

                           </label>
                           <div class="col-sm-12">
                              <input name="mname" id="mname" value="{{ old('mname') }}" placeholder="Middle Name" class="form-control" type="text">
                           </div>
                        </div>

                        <div class="item form-group">
                           <label class="control-label col-sm-12" for="lname"> Last name *

                           </label>
                           <div class="col-sm-12">
                              <input name="lname" value="{{ old('lname') }}" placeholder="Last Name" class="form-control" type="text">
                           </div>
                        </div>



                        <div class="item form-group">
                           <label class="control-label col-sm-12" for="phone"> Phone *

                           </label>
                           <div class="col-sm-12">

                              <input id="phone" style="border-radius: 4px" class=" form-control" type="tel" required="" value="">

                              <span id="error-msg" style="color: red" class="hide">Invalid number</span>
                              <input id="phone_orig" type="hidden" style="border-radius: 4px" class="form-control " name="phone_no" type="tel" value="">
                           </div>
                        </div>


                        <div class="item form-group">
                           <label class="control-label col-sm-12" for="aaddress"> Address *

                           </label>
                           <div class="col-sm-12">
                              <input name="aaddress" value="{{ old('aaddress') }}" placeholder="Address" class="form-control" type="text">
                           </div>
                        </div>




                        <div class="item form-group">
                           <label class="control-label col-sm-4" for="name">Add Regional Address*

                           </label>
                           <div class="d-inline-flex">

                              <div class="col-sm-3">
                                  <select class="form-control" id="country" name="country_id" type="text" >
                                     <option selected="" disabled="">Select Country</option>
                                     @foreach($countries as $country)   
                                     <option data-href="{{ route('states-load',$country->id) }}" value="{{$country->id}}">{{$country->name}}</option>
                                     @endforeach
                                  </select> 
                              </div>

                              <div class="col-sm-3">
                                <select class="form-control" id="state" name="state_id" type="text" >
                                                              
                                 </select>
                              </div>
                              <div class="col-sm-3">
                                 <input name="city" value="{{ old('city') }}" placeholder="City" class="form-control" type="text">
                              </div>
                              <div class="col-sm-3">
                                 <input name="zip_code" value="{{ old('zip') }}" placeholder="Zip" class="form-control" type="text">
                              </div>

                           </div>


                        </div>

                        <div class="item form-group">
                           <label class="control-label col-sm-12" for="aemail"> Email (Optional)*

                           </label>
                           <div class="col-sm-12">
                              <input name="aemail" id="aemail" value="{{ old('aemail') }}" placeholder="Email" class="form-control" type="email">
                           </div>
                        </div>


                     </div>


                     <div class="item form-group">
                        <label class="control-label col-sm-12" for="name">{{ $langg->lang493 }}) *

                        </label>
                        <div class="col-sm-12">
                           <textarea class="form-control" name="reference" rows="6" placeholder="{{ $langg->lang493 }}">{{ old('reference') }}</textarea>
                        </div>
                     </div>

                     <div id="resp" class="col-md-12">

                        <span class="help-block">
                           {{-- <strong>{{ $langg->lang494 }} ${{ $gs->withdraw_fee }} {{ $langg->lang495 }} {{ $gs->withdraw_charge }}% {{ $langg->lang496 }}</strong> --}}

                           <strong>{{ $gs->withdraw_charge }}% Transaction fee,{{ $gs->withdraw_fee }}% +${{ $gs->withdraw_fixedprice }} payment processing fee</strong>
                        </span>
                     </div>

                     <hr>
                     <div class="add-product-footer">
                        <button name="addProduct_btn" type="submit" class="mybtn1">{{ $langg->lang497 }}</button>
                     </div>
                  </form>


               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
   $("#withmethod").change(function() {
      var method = $(this).val();

      if (method == "Bank") {

         $("#bank").show();
         $("#bank").find('input, select').attr('required', true);

         $("#paypal").hide();
         $("#paypal").find('input').attr('required', false);

         $("#additional").hide();
         $("#additional").find('input, select').attr('required', false);

      } else if (method == "Payoneer" || method == "Paypal" || method == "Skrill") {
         $("#bank").hide();
         $("#bank").find('input, select').attr('required', false);

         $("#paypal").show();
         $("#paypal").find('input').attr('required', true);

         $("#additional").hide();
         $("#additional").find('input, select').attr('required', false);
      } else if (method == "MoneyGram" || method == "Western union") {
         $("#bank").hide();
         $("#bank").find('input, select').attr('required', false);

         $("#paypal").hide();
         $("#paypal").find('input').attr('required', false);

         $("#additional").show();
         $("#additional").find('input, select').attr('required', true);
         $('#aemail').attr('required', false);
         $('#mname').attr('required', false);
      } else if (method == "") {
         $("#bank").hide();
         $("#paypal").hide();
         $("#bank").find('input, select').attr('required', false);
         $("#paypal").find('input').attr('required', false);

         $("#additional").hide();
         $("#additional").find('input, select').attr('required', false);
      }

   })
</script>



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
            // $('#contact-btn-sub').css('pointer-events','auto');
         } else {
            telInput.addClass("error");
            errorMsg.removeClass("hide");
            // $('#contact-btn-sub').css('pointer-events','none');
         }
      }
   });

   // on keyup / change flag: reset
   telInput.on("keyup change", reset);
</script>



@endsection