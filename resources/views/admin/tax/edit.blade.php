@extends('layouts.load')
@section('content')

						<div class="content-area">
							<div class="add-product-content">
								<div class="row">
									<div class="col-lg-12">
										<div class="product-description">
											<div class="body-area">
                        @include('includes.admin.form-error') 
											<form id="geniusformdata" action="{{ route('admin-tax-update',$data->id) }}" method="POST" enctype="multipart/form-data">
												{{csrf_field()}}
                                                                                              
                                                @if(is_null($data->state_id))
                                                <div class="row" id="countryrow">
														<div class="col-lg-4">
															<div class="left-area">
																	<h4 class="heading">{{ __("Select Country") }} *</h4>
															</div>
														</div>
														<div class="col-lg-7">
															<input type="text" class="input-field" name="country" value="{{$data->country->name}}" readonly="">
																
															</div>
												</div>
                                                @else
												<div class="row" id="staterow" >
														<div class="col-lg-4">
															<div class="left-area">
																	<h4 class="heading">{{ __("Select State") }} *</h4>
															</div>
														</div>
														<div class="col-lg-7">
																<input type="text" class="input-field" name="country" value="{{$data->state->name}}" readonly="">
															</div>
												</div>
                                                @endif

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __("Tax %") }} *</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="number" step="0.01" class="input-field" name="tax" placeholder="{{ __("Tax %") }}" required="" value="{{$data->amount}}">
													</div>
												</div>




						                        <div class="row">
						                          <div class="col-lg-4">
						                            <div class="left-area">
						                              
						                            </div>
						                          </div>
						                          <div class="col-lg-7">
						                            <button class="addProductSubmit-btn" type="submit">{{ __("Save") }}</button>
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