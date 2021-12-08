@extends('front.layouts.app')
@section('page_content')


<section class="user-dashbord">
    <div class="container">
      <div class="row">
        @include('includes.user-dashboard-sidebar')
        <div class="col-lg-8">
            <div class="user-profile-details">
                <div class="order-history">
                    <div class="header-area d-flex align-items-center">
                        <h4 class="title">{{ $langg->lang772 }}</h4>          
                    </div>
                        <div class="order-tracking-content" style="padding: 20px 0px 20px 20px;width: 70%;">
                            @include('includes.form-success')
                            <form id="t-form" class="tracking-form">
                                {{ csrf_field() }}
                                <div class="row">
                                     <div class="col-md-8">
                                         <input type="text" class="form-control input-field" id="code" placeholder="{{ $langg->lang773 }}" required="">
                                    </div>
                                    <div class="col-md-4">
                                         <button type="submit" class="mybtn1">{{ $langg->lang774 }}</button>
                                         <a href="#"  data-toggle="modal" data-target="#order-tracking-modal"></a>
                                    </div>
                                </div>
                               
                               
                            </form>
                        </div>
                      
                    </div>
                </div>
		    </div>
	    </div>
	</div>
</section>


<!-- Order Tracking modal Start-->
    <div class="modal fade" id="order-tracking-modal" tabindex="-1" role="dialog" aria-labelledby="order-tracking-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title"> <b>{{ $langg->lang772 }}</b> </h6>
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
    $('#t-form').on('submit',function(e){
        e.preventDefault();
        var code = $('#code').val();
        $('#order-track').load('{{ url("user/order/trackings/") }}/'+code);
        $('#order-tracking-modal').modal('show');
    });


</script>

@endsection

