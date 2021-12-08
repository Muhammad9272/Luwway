@extends('front.layouts.app')
@section('pagelevel_css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/front/css/datatable.css')}}">
@endsection
@section('page_content')


<section class="user-dashbord">
    <div class="container">
      <div class="row">
        @include('includes.user-dashboard-sidebar')
        <div class="col-lg-9">
					<div class="user-profile-details">
						<div class="order-history">
							<div class="header-area ">
								<h4 class="title ">Favorites</h4>          
							</div>
              <div class="row row-cards-one">
                <div class="col-md-12 col-lg-6 col-xl-6">
                  <div class="mycard bg2">
                          <h5 class="title">Favorite Items</h5>
                          <h5 class="number">{{$favorite_products}}</h5>
                          <a href="{{route('user-favorites','products')}}" class="link">View All</a>
                  </div>
              </div>

              <div class="col-md-12 col-lg-6 col-xl-6">
                  <div class="mycard bg3">
                     
                          <h5 class="title">Favorite Shops</h5>
                          <h5 class="number">{{$favorite_shops}}</h5>
                          <a href="{{route('user-favorites','shops')}}" class="link">View All</a>
                     
                     
                  </div>
              </div>

            </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

    <div class="modal-header d-block text-center">
        <h4 class="modal-title d-inline-block">{{ $langg->lang257 }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>

                <div class="modal-body">
            <p class="text-center">{{ $langg->lang258 }}</p>
            <p class="text-center">{{ $langg->lang259 }}</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ $langg->lang260 }}</button>
                    <a class="btn btn-danger btn-ok">{{ $langg->lang261 }}</a>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('pagelevel_scripts')
<script src="{{asset('assets/front/js/datatable.js')}}"></script>
<script type="text/javascript">
  $(document).ready( function () {
    $('#example').DataTable();
} );
</script>
<script type="text/javascript">

      $('#confirm-delete').on('show.bs.modal', function(e) {
          $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
      });

</script>

@endsection