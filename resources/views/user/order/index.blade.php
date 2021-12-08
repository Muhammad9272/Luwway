@extends('front.layouts.app')
@section('page_content')

@section('pagelevel_css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/front/css/datatable.css')}}">
@endsection

<section class="user-dashbord">
    <div class="container">
      <div class="row">
        @include('includes.user-dashboard-sidebar')
        <div class="col-lg-8">
					<div class="user-profile-details">
						<div class="order-history">
							<div class="header-area">
								<h4 class="title">
									
									Order information
								</h4>
							</div>
							<div class="mr-table allproduct mt-4">
									<div class="table-responsiv">


											<table id="example" class="table table-hover dt-responsive" cellspacing="0" width="100%">
												<thead>
													<tr>
														{{-- <th>Image</th> --}}
														<th>Order ID</th>
														<th>Date</th>
														<th>Order Total</th>
														<th>Order Status</th>
														<th>View</th>
													</tr>
												</thead>
												<tbody>

													 @foreach($orders as $order)

												

													<tr>
														{{-- <td>
																<img src="https://luwaay.com/storage/app/public/VendorFood/MLqZ3Lr7PfDWYuHDRxAOM2SLFELKqr5IlOSY4tq8.png" width="80">
														</td> --}}
														<td>
																{{$order->order_number}}
														</td>
														<td>
																{{date('d M Y',strtotime($order->created_at))}}
														</td>
														<td>
																{{$order->currency_sign}}{{ round($order->pay_amount * $order->currency_value , 2) }}
														</td>
														<td>
																<div class="order-status {{ $order->status }}">
																	{{ucwords($order->status)}}
															</div>
														</td>
														<td>
																<a href="{{route('user-order',$order->id)}}">
																	{{ $langg->lang283 }}
															</a>
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
@endsection
@section('pagelevel_scripts')
<script src="{{asset('assets/front/js/datatable.js')}}"></script>
<script type="text/javascript">
	$(document).ready( function () {
    $('#example').DataTable();
} );
</script>
@endsection