@extends('layouts.vendor')
@section('content')

						<div class="content-area">
							<div class="mr-breadcrumb">
								<div class="row">
									<div class="col-lg-12">
											<h4 class="heading">{{ $langg->lang434 }}</h4>
											<ul class="links">
												<li>
													<a href="{{ route('vendor-dashboard') }}">{{ $langg->lang441 }} </a>
												</li>
												<li>
													<a href="{{ route('vendor-profile') }}">{{ $langg->lang434 }} </a>
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
											<form id="geniusform" action="{{ route('vendor-profile-update') }}" method="POST" enctype="multipart/form-data">
												{{csrf_field()}}

                      						 @include('includes.vendor.form-both')  

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ $langg->lang457 }}: </h4>
														</div>
													</div>
													<div class="col-lg-7">
														<div class="right-area">
																<h6 class="heading"> {{ $data->shop_name }}
																	@if($data->checkStatus())
																	<a class="badge badge-success verify-link" href="javascript:;">{{ $langg->lang783 }}</a>
																	@else
																	 <span class="verify-link"><a href="{{ route('vendor-verify') }}">{{ $langg->lang784 }}</a></span>
																	@endif
																</h6>
														</div>
													</div>
												</div>


                                                 <div class="row">
						                          <div class="col-lg-4">
						                            <div class="left-area">
						                                <h4 class="heading">{{ $langg->lang520 }} *</h4>
						                            </div>
						                          </div>
						                          <div class="col-lg-7">
						                            <div class="img-upload full-width-img">
						                                <div id="image-preview" class="img-preview" style="background: url({{ $data->shop_image ? asset('assets/images/vendor/'.$data->shop_image):asset('assets/images/noimage.png') }});">
						                                    <label for="image-upload" class="img-label" id="image-label"><i class="icofont-upload-alt"></i>{{ $langg->lang522 }}</label>
						                                    <input type="file" name="shop_image" class="img-upload" id="image-upload">
						                                  </div>
						                                  <p class="text">{{ $langg->lang521 }}</p>
						                            </div>

						                          </div>
						                        </div>


												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ $langg->lang458 }} *</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" name="owner_name" placeholder="{{ $langg->lang458 }}" required="" value="{{$data->owner_name}}">
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ $langg->lang459 }} *</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" name="shop_number" placeholder="{{ $langg->lang459 }}" required="" value="{{$data->shop_number}}">
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ $langg->lang460 }} *</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" name="shop_address" placeholder="{{ $langg->lang460 }}" required="" value="{{$data->shop_address}}">
													</div>
												</div>




												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading"> Address</h4>
																<p class="sub-heading"></p>
														</div>
													</div>

													<div class="col-lg-3">
							                            <select class="input-field" id="country" name="country_id" type="text" >
							                               <option selected="" disabled="">Select Country</option>
							                               @foreach($countries as $country)   
							                               <option data-href="{{ route('states-load',$country->id) }}" value="{{$country->id}}" {{($data->country_id==$country->id)?'selected':''}}>{{$country->name}}</option>
							                               @endforeach
							                            </select> 
													</div>
													<div class="col-lg-2">
							                            <select class="input-field" id="state" name="state_id" type="text" >
							                                @foreach($states as $state)
							                                    <option value="{{$state->id}}" {{ ($state->id == $data->state_id) ? 'selected' : '' }}>{{ $state->name }}</option>
							                                @endforeach                              
							                            </select>
													</div>
													<div class="col-lg-2">
							                            <input type="text" class="input-field" name="city" placeholder="Enter City"  id="city" required="" value="{{$data->city}}">
													</div>													

												</div>


												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ $langg->lang461 }}</h4>
																<p class="sub-heading">{{ $langg->lang462 }}</p>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" name="reg_number" placeholder="{{ $langg->lang461 }}" required="" value="{{$data->reg_number}}">
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ $langg->lang463 }} *</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<textarea class="input-field nic-edit" name="shop_details" placeholder="{{ $langg->lang463 }}">{{$data->shop_details}}</textarea>
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