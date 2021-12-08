@extends('front.layouts.app')

@section('pagelevel_css')
<link rel="stylesheet" href="{{asset('assets/front/css/lu_checkout.css')}}">

<style type="text/css">
   .root.root--in-iframe {
      background: #4682b447 !important;
   }
</style>

@endsection



@section('page_content')



<!-- Check Out Area Start -->
<section class="checkout">
   <div class="container">
      <div class="row">
         @if(Auth::guard('web')->check())
         <div class="col-lg-12">
            <div class="checkout-area mb-0 pb-0">
               <div class="checkout-process">
                  <ul class="nav" role="tablist">
                     <li class="nav-item">
                        <a class="nav-link active" id="pills-step1-tab" data-toggle="pill" href="#pills-step1" role="tab" aria-controls="pills-step1" aria-selected="true">
                           <span>1</span> {{ $langg->lang743 }}
                           <i class="far fa-address-card"></i>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link disabled" id="pills-step2-tab" data-toggle="pill" href="#pills-step2" role="tab" aria-controls="pills-step2" aria-selected="false">
                           <span>2</span> {{ $langg->lang744 }}
                           <i class="fas fa-dolly"></i>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link disabled" id="pills-step3-tab" data-toggle="pill" href="#pills-step3" role="tab" aria-controls="pills-step3" aria-selected="false">
                           <span>3</span> {{ $langg->lang745 }}
                           <i class="far fa-credit-card"></i>
                        </a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="col-12 d-inline-flex" id="checkout_bucket">
            @include('includes.checkout.bucket')
         </div>
         @else
         <div class="col-md-12">
            <h3 class="text-center">Please login First !!</h3>
         </div>
         @endif

      </div>
   </div>
</section>
<!-- Check Out Area End-->
{{-- @if($gs->is_loader == 1) --}}
    <div class="preloader" id="preloader" style="background: url({{asset('assets/images/'.$gs->loader)}}) no-repeat scroll center center #FFF;"></div>
{{-- @endif --}}


@endsection

@section('pagelevel_scripts')

<script src="https://js.paystack.co/v1/inline.js"></script>

<script type="text/javascript">
    $('a.payment:first').addClass('active');
    $('.checkoutform').prop('action',$('a.payment:first').data('form'));
    $($('a.payment:first').attr('href')).load($('a.payment:first').data('href'));


        var show = $('a.payment:first').data('show');
        if(show != 'no') {
            $('.pay-area').removeClass('d-none');
        }
        else {
            $('.pay-area').addClass('d-none');
        }
    $($('a.payment:first').attr('href')).addClass('active').addClass('show');
</script>


<script type="text/javascript">

var coup = 0;
var pos = {{ $gs->currency_format }};

@if(isset($checked))

    $('#myModal').modal('show');

@endif

var mship = $('.shipping').length > 0 ? $('.shipping').first().val() : 0;
var mpack = $('.packing').length > 0 ? $('.packing').first().val() : 0;
mship = parseFloat(mship);
mpack = parseFloat(mpack);
var gstax={{$gs->tax}};

$('#shipping-cost').val(mship);
$('#packing-cost').val(mpack);
var ftotal = parseFloat($('#grandtotal').val()) + mship + mpack;
ftotal = parseFloat(ftotal);
      if(ftotal % 1 != 0)
      {
        ftotal = ftotal.toFixed(2);
      }
        if(pos == 0){
            $('#final-cost').html('{{ $curr->sign }}'+ftotal)
        }
        else{
            $('#final-cost').html(ftotal+'{{ $curr->sign }}')
        }

$('#grandtotal').val(ftotal);

$(document).on('change','#shipop',function () {

    var val = $(this).val();
    if(val == 'pickup'){
        $('#shipshow').removeClass('d-none');
        $("#ship-diff-address").parent().addClass('d-none');
        $('.ship-diff-addres-area').addClass('d-none');  
        $('.ship-diff-addres-area input, .ship-diff-addres-area select').prop('required',false);  
    }
    else{
        $('#shipshow').addClass('d-none');
        $("#ship-diff-address").parent().removeClass('d-none');
        $('.ship-diff-addres-area').removeClass('d-none');  
        $('.ship-diff-addres-area input, .ship-diff-addres-area select').prop('required',true); 
    }

});


  // Display States
  $(document).on('change','.checkout_region',function () {
    $('#preloader').show();
    var link = $(this).find(':selected').attr('data-href');    
    if(link != ""){
        $( "#checkout_bucket" ).load(link, function( response, status, xhr ) {
           
        });
    }
    $('#preloader').hide();
  });





$(document).on('click', '.shipping', function(){
    mship = $(this).val();

    $('#shipping-cost').val(mship);
    var ttotal = parseFloat($('#tgrandtotal').val()) + parseFloat(mship) + parseFloat(mpack);
    ttotal = parseFloat(ttotal);
    if(ttotal % 1 != 0)
    {
        ttotal = ttotal.toFixed(2);
    }
    if(pos == 0){
        $('#final-cost').html('{{ $curr->sign }}'+ttotal);
    }
    else{
        $('#final-cost').html(ttotal+'{{ $curr->sign }}');
    }    
    $('#grandtotal').val(ttotal);

})

$(document).on('click', '.packing', function(){
    mpack = $(this).val();
    $('#packing-cost').val(mpack);
    var ttotal = parseFloat($('#tgrandtotal').val()) + parseFloat(mship) + parseFloat(mpack);
    ttotal = parseFloat(ttotal);
    if(ttotal % 1 != 0)
    {
        ttotal = ttotal.toFixed(2);
    }

    if(pos == 0){
        $('#final-cost').html('{{ $curr->sign }}'+ttotal);
    }
    else{
        $('#final-cost').html(ttotal+'{{ $curr->sign }}');
    }   
    $('#grandtotal').val(ttotal);       
})

$(document).on('submit', '#check-coupon-form', function() {
    var val = $("#code").val();
    var total = $("#grandtotal").val();
    var ship = 0;
        $.ajax({
                type: "GET",
                url:mainurl+"/carts/coupon/check",
                data:{code:val, total:total, shipping_cost:ship},
                success:function(data){
                    if(data == 0)
                    {
                        toastr.error(langg.no_coupon);
                        $("#code").val("");
                    }
                    else if(data == 2)
                    {
                        toastr.error(langg.already_coupon);
                        $("#code").val("");
                    }
                    else
                    {
                        $("#check-coupon-form").toggle();
                        $(".discount-bar").removeClass('d-none');

                        if(pos == 0){
                            $('#total-cost').html('{{ $curr->sign }}'+data[0]);
                            $('#discount').html('{{ $curr->sign }}'+data[2]);
                        }
                        else{
                            $('#total-cost').html(data[0]+'{{ $curr->sign }}');
                            $('#discount').html(data[2]+'{{ $curr->sign }}');
                        }
                            $('#grandtotal').val(data[0]);
                            $('#tgrandtotal').val(data[0]);
                            $('#coupon_code').val(data[1]);
                            $('#coupon_discount').val(data[2]);
                            if(data[4] != 0){
                            $('.dpercent').html('('+data[4]+')');
                            }
                            else{
                            $('.dpercent').html('');                                    
                            }


                                var ttotal = parseFloat($('#grandtotal').val()) + parseFloat(mship) + parseFloat(mpack);
                                ttotal = parseFloat(ttotal);
                              if(ttotal % 1 != 0)
                              {
                                ttotal = ttotal.toFixed(2);
                              }

                                if(pos == 0){
                                    $('#final-cost').html('{{ $curr->sign }}'+ttotal)
                                }
                                else{
                                    $('#final-cost').html(ttotal+'{{ $curr->sign }}')
                                }   

                        toastr.success(langg.coupon_found);
                        $("#code").val("");
                    }
                  }
          }); 
          return false;
});

// Password Checking

$(document).on('change', '#open-pass', function(){
    if(this.checked){
     $('.set-account-pass').removeClass('d-none');  
     $('.set-account-pass input').prop('required',true); 
     $('#personal-email').prop('required',true);
     $('#personal-name').prop('required',true);
    }
    else{
     $('.set-account-pass').addClass('d-none');   
     $('.set-account-pass input').prop('required',false); 
     $('#personal-email').prop('required',false);
     $('#personal-name').prop('required',false);

    }
});

// Password Checking Ends


// Shipping Address Checking

$(document).on('change', '#ship-diff-address', function() {
    if(this.checked){
     $('.ship-diff-addres-area').removeClass('d-none');  
     $('.ship-diff-addres-area input, .ship-diff-addres-area select').prop('required',true); 
    }
    else{
     $('.ship-diff-addres-area').addClass('d-none');  
     $('.ship-diff-addres-area input, .ship-diff-addres-area select').prop('required',false);  
    }
    
});


// Shipping Address Checking Ends


</script>


<script type="text/javascript">

var ck = 0;

    $(document).on('submit', '.checkoutform', function(e) {
        if(ck == 0) {
                e.preventDefault();         
            $('#pills-step2-tab').removeClass('disabled');
            $('#pills-step2-tab').click();

        }else {
            $('#preloader').show();
        }
        $('#pills-step1-tab').addClass('active');
    });

    $(document).on('click', '#step1-btn', function(e) {
        $('#pills-step1-tab').removeClass('active');
        $('#pills-step2-tab').removeClass('active');
        $('#pills-step3-tab').removeClass('active');
        $('#pills-step2-tab').addClass('disabled');
        $('#pills-step3-tab').addClass('disabled');

        $('#pills-step1-tab').click();

    });

   // Step 2 btn DONE

    $(document).on('click', '#step2-btn', function(e) {
        $('#pills-step3-tab').removeClass('active');
        $('#pills-step1-tab').removeClass('active');
        $('#pills-step2-tab').removeClass('active');
        $('#pills-step3-tab').addClass('disabled');
        $('#pills-step2-tab').click();
        $('#pills-step1-tab').addClass('active');

    });

    $(document).on('click', '#step3-btn', function(e) {
        if($('a.payment:first').data('val') == 'paystack'){
            $('.checkoutform').prop('id','step1-form');
        }
        else {
            $('.checkoutform').prop('id','');
        }
        $('#pills-step3-tab').removeClass('disabled');
        $('#pills-step3-tab').click();

        var shipping_user  = !$('input[name="shipping_name"]').val() ? $('input[name="name"]').val() : $('input[name="shipping_name"]').val();
        var shipping_location  = !$('input[name="shipping_address"]').val() ? $('input[name="address"]').val() : $('input[name="shipping_address"]').val();
        var shipping_phone = !$('input[name="shipping_phone"]').val() ? $('input[name="phone"]').val() : $('input[name="shipping_phone"]').val();
        var shipping_email= !$('input[name="shipping_email"]').val() ? $('input[name="email"]').val() : $('input[name="shipping_email"]').val();

        $('#shipping_user').html('<i class="fas fa-user"></i>'+shipping_user);
        $('#shipping_location').html('<i class="fas fas fa-map-marker-alt"></i>'+shipping_location);
        $('#shipping_phone').html('<i class="fas fa-phone"></i>'+shipping_phone);
        $('#shipping_email').html('<i class="fas fa-envelope"></i>'+shipping_email);

        $('#pills-step1-tab').addClass('active');
        $('#pills-step2-tab').addClass('active');
    });

    $(document).on('click', '#final-btn', function(e) {
        ck = 1;
    })


    $(document).on('click', '.payment', function(e) {
        if($(this).data('val') == 'paystack'){
            $('.checkoutform').prop('id','step1-form');
        }
        else {
            $('.checkoutform').prop('id','');
        }
        $('.checkoutform').prop('action',$(this).data('form'));
        $('.pay-area #v-pills-tabContent .tab-pane.fade').not($(this).attr('href')).html('');
        var show = $(this).data('show');
        if(show != 'no') {
            $('.pay-area').removeClass('d-none');
        }
        else {
            $('.pay-area').addClass('d-none');
        }
        $($(this).attr('href')).load($(this).data('href'));
    })




        $(document).on('submit','#step1-form',function(){
            $('#preloader').hide();
            var val = $('#sub').val();
            var total = $('#grandtotal').val();



                if(val == 0)
                {
                var handler = PaystackPop.setup({
                  key: '{{$gs->paystack_key}}',
                  email: $('input[name=email]').val(),
                  amount: total * 100,
                  currency: "{{$curr->name}}",
                  ref: ''+Math.floor((Math.random() * 1000000000) + 1),
                  callback: function(response){
                    $('#ref_id').val(response.reference);
                    $('#sub').val('1');
                    $('#final-btn').click();
                  },
                  onClose: function(){
                    window.location.reload();
                    
                  }
                });
                handler.openIframe();
                    return false;                    
                }
                else {
                    $('#preloader').show();
                    return true;   
                }

        });





</script>





@endsection