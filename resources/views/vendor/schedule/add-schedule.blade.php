@extends('layouts.vendor')

@section('content')

						<div class="content-area">
							<div class="mr-breadcrumb">
								<div class="row">
									<div class="col-lg-12">
											<h4 class="heading">Store Settings</h4>
											<ul class="links">
												<li>
													<a href="{{ route('vendor-dashboard') }}">{{ $langg->lang441 }} </a>
												</li>
												<li>
													<a href="">Edit schedule </a>
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

											<form id="geniusform" action="{{ route('vendor-schedule.submit') }}" method="POST" enctype="multipart/form-data">

												@if(session()->has('message'))
												    <div class="alert alert-success">
												        {{ session()->get('message') }}
												    </div>
												@endif
												{{csrf_field()}}

                                           
												<div class="row">
													<div class="col-lg-2">
														<div class="left-area">
																<h4 class="heading">Monday *</h4>
														</div>
													</div>
													<div class="col-lg-4">
														<input type="time" class="input-field timepicker" name="opening1" placeholder="Opening Time"  value="">
													</div>
													<div class="col-lg-4">
														<input type="time" class="input-field timepicker" name="closing1" placeholder="Closing time"  value="">
													</div>									
													<div class="col-lg-2">
														<div class="right-area">
															<input type="checkbox" name="closed1" id="yyy" value="1">
																<label for="yyy">Closed</label>
																
														</div>
													</div>																	
												</div>
												<div class="row">
													<div class="col-lg-2">
														<div class="left-area">
																<h4 class="heading">Thuesday *</h4>
														</div>
													</div>
													<div class="col-lg-4">
														<input type="time" class="input-field timepicker" name="opening2" placeholder="Opening Time"  value="">
													</div>
													<div class="col-lg-4">
														<input type="time" class="input-field timepicker" name="closing2" placeholder="Closing time"  value="">
													</div>									
													<div class="col-lg-2">
														<div class="right-area">
															<input type="checkbox" name="closed2" id="yyy2" value="1">
																<label for="yyy2">Closed</label>
																
														</div>
													</div>																	
												</div>									
												<div class="row">
													<div class="col-lg-2">
														<div class="left-area">
																<h4 class="heading">Wednesday *</h4>
														</div>
													</div>
													<div class="col-lg-4">
														<input type="time" class="input-field timepicker" name="opening3" placeholder="Opening Time"  value="">
													</div>
													<div class="col-lg-4">
														<input type="time" class="input-field timepicker" name="closing3" placeholder="Closing time"  value="">
													</div>									
													<div class="col-lg-2">
														<div class="right-area">
															<input type="checkbox" name="closed3" id="yyy3" value="1">
																<label for="yyy3">Closed</label>
																
														</div>
													</div>																	
												</div>									
												<div class="row">
													<div class="col-lg-2">
														<div class="left-area">
																<h4 class="heading">Thursday *</h4>
														</div>
													</div>
													<div class="col-lg-4">
														<input type="time" class="input-field timepicker" name="opening4" placeholder="Opening Time"  value="">
													</div>
													<div class="col-lg-4">
														<input type="time" class="input-field timepicker" name="closing4" placeholder="Closing time"  value="">
													</div>									
													<div class="col-lg-2">
														<div class="right-area">
															<input type="checkbox" name="closed4" id="yyy4" value="1">
																<label for="yyy4">Closed</label>
																
														</div>
													</div>																	
												</div>									
												<div class="row">
													<div class="col-lg-2">
														<div class="left-area">
																<h4 class="heading">Friday *</h4>
														</div>
													</div>
													<div class="col-lg-4">
														<input type="time" class="input-field timepicker" name="opening5" placeholder="Opening Time"  value="">
													</div>
													<div class="col-lg-4">
														<input type="time" class="input-field timepicker" name="closing5" placeholder="Closing time"  value="">
													</div>									
													<div class="col-lg-2">
														<div class="right-area">
															<input type="checkbox" name="closed5" id="yyy5" value="1">
																<label for="yyy5">Closed</label>
																
														</div>
													</div>																	
												</div>									

												<div class="row">
													<div class="col-lg-2">
														<div class="left-area">
																<h4 class="heading">Saturday *</h4>
														</div>
													</div>
													<div class="col-lg-4">
														<input type="time" class="input-field timepicker" name="opening6" placeholder="Opening Time"  value="">
													</div>
													<div class="col-lg-4">
														<input type="time" class="input-field timepicker" name="closing6" placeholder="Closing time"  value="">
													</div>									
													<div class="col-lg-2">
														<div class="right-area">
															<input type="checkbox" name="closed6" id="yyy6" value="1">
																<label for="yyy6">Closed</label>
																
														</div>
													</div>																	
												</div>
												<div class="row">
													<div class="col-lg-2">
														<div class="left-area">
																<h4 class="heading">Sunday *</h4>
														</div>
													</div>
													<div class="col-lg-4">
														<input type="time" class="input-field timepicker" name="opening7" placeholder="Opening Time"  value="">
													</div>
													<div class="col-lg-4">
														<input type="time" class="input-field timepicker" name="closing7" placeholder="Closing time"  value="">
													</div>									
													<div class="col-lg-2">
														<div class="right-area">
															<input type="checkbox" name="closed7" id="yyy7" value="1">
																<label for="yyy7">Closed</label>
																
														</div>
													</div>																	
												</div>	

						                        <div class="row">
						                          <div class="col-lg-4">
						                            <div class="left-area">
						                              
						                            </div>
						                          </div>
						                          <div class="col-lg-7">
						                            <button class="addProductSubmit-btn" type="submit">{{ $langg->lang464 }}</button>
						                          </div>
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
<script>
    $("input[type=time]").val( "00:00" );
</script>
@endsection