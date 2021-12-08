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
								<h4 class="title ">News</h4>          
							</div>
							<div class="mr-table allproduct message-area  mt-4">
								@include('includes.form-success')
									<div class="table-responsiv">
											<table id="example" class="table table-hover dt-responsive" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th>SR.</th>
														<th>Title</th>
														<th>View</th>
													</tr>
												</thead>
												<tbody>
                        @foreach($blogs as $blog)

                          <tr class="conv">
                            
                              <td>{{++$loop->index}}</td>
                              <td>{{$blog->title}}</td>
                            <td>
                              <a target="_blank" href="{{route('front.blogshow',$blog->id)}}" class="link view"><i class="fa fa-eye"></i></a>
                            </td>

                          </tr>

                        @endforeach
												</tbody>
											</table>
									</div>
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<div class="modal fade" style="margin-top: 150px;" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
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
                    <button type="button" style="font-size: medium;" class="btn btn-default" data-dismiss="modal">{{ $langg->lang260 }}</button>
                    <a class="btn btn-danger btn-ok" style="font-size: medium;">{{ $langg->lang261 }}</a>
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


@endsection