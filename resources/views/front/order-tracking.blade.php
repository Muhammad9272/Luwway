@extends('front.layouts.app')

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
      <div class="ps-order-tracking">
        <div class="container">
          <div class="ps-section__header">
            <h3>Track Your Order</h3>

            <div class="alert alert-success validation" style="display: none;">
            <button type="button" class="close alert-close"><span>×</span></button>
                  <p class="text-left"></p> 
            </div>

            <p>To track your order please enter your Order ID in the box below and press the "Track" button. This was given to you on your receipt and in the confirmation email you should have received.</p>
          </div>
          <div class="ps-section__content">
             <form id="t-form" class="tracking-form ps-form--order-tracking">
              {{ csrf_field() }}
              <div class="form-group">
                <label>Order ID</label>
                <input class="form-control" name="track_id" id="code" type="text" placeholder="Found in your order confimation email">
              </div>
              <div class="form-group">
                <button class="ps-btn ps-btn--fullwidth">Track Your Order</button>
              </div>
            </form>
          </div>
        </div>
      </div>


<!-- Order Tracking modal Start-->
    <div class="modal fade" id="order-tracking-modal" tabindex="-1" role="dialog" aria-labelledby="order-tracking-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"> <b>{{ $langg->lang772 }}</b> </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="order-track">

            </div>
            </div>
        </div>
    </div>
<!-- Order Tracking modal End -->

@endsection
@section('pagelevel_scripts')    
<script type="text/javascript">
      $(document).ready(function() {
      @if($message = Session::get('ordersuccess'))
        toastr.success({!! json_encode($message) !!});

      $('.alert-success').show();
      $('.alert-success p').html({!! json_encode($message) !!});
      @endif
      });  
</script>

<script type="text/javascript">
    $('#t-form').on('submit',function(e){
        e.preventDefault();
        var code = $('#code').val();
        $('#order-track').load('{{ url("/order/trackings/") }}/'+code);
        $('#order-tracking-modal').modal('show');
    });


</script>
@endsection 
