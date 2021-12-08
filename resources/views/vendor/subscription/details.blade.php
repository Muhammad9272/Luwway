@extends('layouts.vendor')

@section('content')  
          <input type="hidden" id="headerdata" value="{{ $langg->lang720 }}">
          <div class="content-area">
            <div class="mr-breadcrumb">
              <div class="row">
                <div class="col-lg-12">
                    <h4 class="heading">Subscription plans</h4>
                    <ul class="links">
                      <li>
                        <a href="{{ route('vendor-dashboard') }}">{{ $langg->lang441 }} </a>
                      </li>

                      <li>
                        <a href="javascript:;">Subscription Plans</a>
                      </li>
                      

                    </ul>
                </div>
              </div>
            </div>
            <div class="product-area">

          <div class="user-profile-details" >
            <div class="row">
            <div class="col-lg-8">
                <div class="user-profile-details">

                    <div class="account-info">
                        <div class="header-area">
                            <h4 class="title">
                                {{ $langg->lang409 }} <a class="mybtn1" href="{{route('vendor-subpackage-index')}}"> <i class="fas fa-arrow-left"></i> {{ $langg->lang410 }}</a>
                            </h4>
                        </div>
                        <div class="pack-details" style="padding: 29px">
                            <div class="row">

                                <div class="col-lg-4">
                                    <h5 class="title">
                                        {{ $langg->lang411 }}
                                    </h5>
                                </div>
                                <div class="col-lg-8">
                                    <p class="value">
                                        {{$subs->title}}
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <h5 class="title">
                                        {{ $langg->lang412 }}
                                    </h5>
                                </div>
                                <div class="col-lg-8">
                                    <p class="value">
                                        {{$subs->price}}{{$subs->currency}}
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <h5 class="title">
                                        {{ $langg->lang413 }}
                                    </h5>
                                </div>
                                <div class="col-lg-8">
                                    <p class="value">
                                        {{$subs->days}} {{ $langg->lang403 }}
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <h5 class="title">
                                        {{ $langg->lang414 }}
                                    </h5>
                                </div>
                                <div class="col-lg-8">
                                    <p class="value">
                                        {{ $subs->allowed_products == 0 ? 'Unlimited':  $subs->allowed_products}}
                                    </p>
                                </div>
                            </div>

                            @if(!empty($package))
                            @if($package->subscription_id != $subs->id)
                            <div class="row">
                                <div class="col-lg-4">
                                </div>
                                <div class="col-lg-8">
                                    <span class="notic"><b>{{ $langg->lang415 }}</b> {{ $langg->lang416 }}</span>
                                </div>
                            </div>

                            <br>
                            @else
                            <br>

                            @endif
                            @else
                            <br>
                            @endif

                            <form id="subscribe-form" class="pay-form" action="{{route('vendor-subpackage-request-submit')}}" method="POST">

                                @include('includes.form-success')
                                @include('includes.form-error')
                                @include('includes.admin.form-error')

                                {{ csrf_field() }}



                                <input type="hidden" name="subs_id" value="{{ $subs->id }}">
                                <input type="hidden" name="vendor_id" value="1">
                                @if($subs->price != 0)

                                <div class="row">
                                    <div class="col-lg-4">
                                        <h5 class="title pt-1">
                                            {{ $langg->lang418 }} *
                                        </h5>
                                    </div>
                                    <div class="col-lg-8">

                                        <select name="method" id="option" onchange="meThods(this)" class="option" required="">
                                            <option value="">{{ $langg->lang419 }}</option>
                                            @if($gs->paypal_check == 1)
                                            <option value="Paypal">{{ $langg->lang420 }}</option>
                                            @endif
                                            @if($gs->stripe_check == 1)
                                            <option value="Stripe">{{ $langg->lang421 }}</option>
                                            @endif
                                            @if($gs->is_instamojo == 1)
                                            <option value="Instamojo">{{ $langg->lang763 }}</option>
                                            @endif
                                            @if($gs->is_paystack == 1)
                                            <option value="Paystack">{{ $langg->lang764 }}</option>
                                            @endif
                                            @if($gs->is_molly == 1)
                                            <option value="Molly">{{ $langg->lang802 }}</option>
                                            @endif
                                            @if($gs->is_paytm == 1)
                                            <option value="Paytm">{{ $langg->paytm }}</option>
                                            @endif
                                            @if($gs->is_razorpay == 1)
                                            <option value="Razorpay">{{ $langg->razorpay }}</option>
                                            @endif
                                        </select>

                                    </div>
                                </div>


                                <div id="stripes" style="display: none;">

                                    <br>



                                    <div class="row">
                                        <div class="col-lg-4">
                                            <h5 class="title pt-1">
                                                {{ $langg->lang422 }} *
                                            </h5>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="input-field" name="card" id="scard" placeholder="{{ $langg->lang422 }}">
                                        </div>
                                    </div>

                                    <br>


                                    <div class="row">
                                        <div class="col-lg-4">
                                            <h5 class="title pt-1">
                                                {{ $langg->lang423 }} *
                                            </h5>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="input-field" name="cvv" id="scvv" placeholder="{{ $langg->lang423 }}">
                                        </div>
                                    </div>

                                    <br>


                                    <div class="row">
                                        <div class="col-lg-4">
                                            <h5 class="title pt-1">
                                                {{ $langg->lang424 }} *
                                            </h5>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="input-field" name="month" id="smonth" placeholder="{{ $langg->lang424 }}">
                                        </div>
                                    </div>


                                    <br>

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <h5 class="title pt-1">
                                                {{ $langg->lang425 }} *
                                            </h5>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="input-field" name="year" id="syear" placeholder="{{ $langg->lang425 }}">
                                        </div>
                                    </div>

                                </div>
                                <div id="paypals">
                                    <input type="hidden" name="cmd" value="_xclick">
                                    <input type="hidden" name="no_note" value="1">
                                    <input type="hidden" name="lc" value="UK">
                                    <input type="hidden" name="currency_code" value="{{strtoupper($subs->currency_code)}}">
                                    <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest">
                                    <input type="hidden" name="ref_id" id="ref_id" value="">
                                    <input type="hidden" name="sub" id="sub" value="0">
                                    <input type="hidden" name="ck" id="ck" value="0">
                                </div>

                                @endif
                                <div class="row">
                                    <div class="col-lg-4">
                                    </div>
                                    <div class="col-lg-8">
                                        <button type="submit" id="final-btn" class="mybtn1">{{ $langg->lang426 }}</button>
                                    </div>
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




@endsection 
@section('scripts')


@if($subs->price != 0)
<script type="text/javascript">
    function meThods(val) {
        var action1 = "{{route('vendor.paypal.submit')}}";
        var action2 = "{{route('vendor.stripe.submit')}}";


        if (val.value == "Paypal") {
            $('.pay-form').attr('id','subscribe-form');
            $(".pay-form").attr("action", action1);
            $("#scard").prop("required", false);
            $("#scvv").prop("required", false);
            $("#smonth").prop("required", false);
            $("#syear").prop("required", false);
            $("#stripes").hide();

        }

        else if (val.value == "Stripe") {
            $('.pay-form').attr('id','subscribe-form');
            $(".pay-form").attr("action", action2);
            $("#scard").prop("required", true);
            $("#scvv").prop("required", true);
            $("#smonth").prop("required", true);
            $("#syear").prop("required", true);
            $("#stripes").show();
        }
    }
</script>
@endif

<script type="text/javascript">

    $(document).on('submit','#subscribe-form',function(){
        $('#preloader').show();
    });

</script>

@endsection