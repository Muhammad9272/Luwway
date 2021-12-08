@if($payment == 'cod') 
                                <input type="hidden" name="method" value="Cash On Delivery">


@endif
@if($payment == 'paypal') 
                                <input type="hidden" name="method" value="Paypal">
                                <input type="hidden" name="cmd" value="_xclick">
                                <input type="hidden" name="no_note" value="1">
                                <input type="hidden" name="lc" value="UK">
                                <input type="hidden" name="currency_code" value="{{$curr->name}}">
                                <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest">

@endif

@if($payment == 'stripe') 
                                	<input type="hidden" name="method" value="Stripe">
                                  <div class="stripe-payment-chkout">
                                    <label class="mt-3 d-block">{{$gs->title}} accepts all major credit and debit cards.</label>
                                    <img class="mb-3" src="{{asset('assets/front/reg_form/images/wizard_v3_icon_1.png')}}" alt="pay-1">
                                    <div class="row" >
                                      <div class="col-lg-6">
                                        <input class="form-control card-elements" name="cardNumber" type="text" placeholder="{{ $langg->lang163 }}" autocomplete="off"  autofocus oninput="validateCard(this.value);" />
                                        <span id="errCard"></span>
                                      </div>
                                      <div class="col-lg-6">
                                        <input class="form-control card-elements" name="cardCVC" type="text" placeholder="{{ $langg->lang164 }}" autocomplete="off"  oninput="validateCVC(this.value);" />
                                        <span id="errCVC"></span>
                                      </div>
                                      <div class="col-lg-6">
                                        
                                        <select class="form-control card-elements" placeholder="{{ $langg->lang165 }}" name="month" >
                                          <option value="Month" disabled selected>{{ $langg->lang165 }}</option>
                                          <option value="01">January</option>
                                          <option value="02">February</option>
                                          <option value="03">March</option>
                                          <option value="04">April</option>
                                          <option value="05">May</option>
                                          <option value="06">June</option>
                                          <option value="07">July</option>
                                          <option value="08">August</option>
                                          <option value="09">September</option>
                                          <option value="10">October</option>
                                          <option value="11">November</option>
                                          <option value="12">December</option>
                                        </select>                                       
                                        
                                      </div>
                                      <div class="col-lg-6">
                                        <input class="form-control card-elements" name="year" type="text" placeholder="{{ $langg->lang166 }}"  />
                                      </div>                                    
                                    </div>
                                  </div>


                                <script type="text/javascript" src="{{ asset('assets/front/js/payvalid.js') }}"></script>
                                <script type="text/javascript" src="{{ asset('assets/front/js/paymin.js') }}"></script>
                                <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
                                <script type="text/javascript" src="{{ asset('assets/front/js/payform.js') }}"></script>


                                <script type="text/javascript">
                                  var cnstatus = false;
                                  var dateStatus = false;
                                  var cvcStatus = false;
                              
                                  function validateCard(cn) {
                                    cnstatus = Stripe.card.validateCardNumber(cn);
                                    if (!cnstatus) {
                                      $("#errCard").html('{{ $langg->lang781 }}');
                                    } else {
                                      $("#errCard").html('');
                                    }

                              
                              
                                  }
                              
                                  function validateCVC(cvc) {
                                    cvcStatus = Stripe.card.validateCVC(cvc);
                                    if (!cvcStatus) {
                                      $("#errCVC").html('{{ $langg->lang782 }}');
                                    } else {
                                      $("#errCVC").html('');
                                    }
            
                                  }
                              
                                </script>


@endif


@if($payment == 'instamojo') 
                                	<input type="hidden" name="method" value="Instamojo">

@endif


@if($payment == 'paystack') 
                              
        <input type="hidden" name="ref_id" id="ref_id" value="">
        <input type="hidden" name="sub" id="sub" value="0">
		<input type="hidden" name="method" value="Paystack">





@endif

@if($payment == 'razorpay') 

                                  <input type="hidden" name="method" value="Razorpay">

@endif

@if($payment == 'molly') 
                                  <input type="hidden" name="method" value="Molly">

@endif


@if($payment == 'other') 

                                <input type="hidden" name="method" value="{{ $gateway->title }}">

                                  <div class="row" >

<div class="col-lg-12 pb-2">
	
	{!! $gateway->details !!}

</div>


<div class="col-lg-6">
	<label>{{ $langg->lang167 }} *</label>
	<input class="form-control" name="txn_id4" type="text" placeholder="{{ $langg->lang167 }}"  />
</div>


  </div>
@endif