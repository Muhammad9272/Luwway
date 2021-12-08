@extends('layouts.load')
@section('content')

						<div class="content-area">
							<div class="add-product-content">
								<div class="row">
									<div class="col-lg-12">
										<div class="product-description">
											<div class="body-area">
                        @include('includes.admin.form-error') 
											<form id="geniusformdata" action="{{ route('admin-tax-store') }}" method="POST" enctype="multipart/form-data">
												{{csrf_field()}}

												<div class="row">
														<div class="col-lg-4">
															<div class="left-area">
																	<h4 class="heading">{{ __("Add Tax By") }} *</h4>
															</div>
														</div>
														<div class="col-lg-7">
																<select  name="taxby" id="Taxby" required="">
																	<option value="1">By Country</option>
																	<option value="2">By State</option>
																	  
																  </select>
															</div>
												</div>

                                                <div class="row" id="countryrow">
														<div class="col-lg-4">
															<div class="left-area">
																	<h4 class="heading">{{ __("Select Country") }} *</h4>
															</div>
														</div>
														<div class="col-lg-7">
																<select  name="country" required="">
																	@foreach(App\Models\Country::get() as $country)
																	<option value="{{$country->id}}">{{$country->name}}</option>
																	@endforeach
																	
																	  
																  </select>
															</div>
												</div>

												<div class="row" id="staterow" style="display: none">
														<div class="col-lg-4">
															<div class="left-area">
																	<h4 class="heading">{{ __("Select State") }} *</h4>
															</div>
														</div>
														<div class="col-lg-7">
																<select  name="state" required="">
																	@foreach(App\Models\State::get() as $state)
																	<option value="{{$state->id}}">{{$state->name}}</option>
																	@endforeach
																	
																	  
																  </select>
															</div>
												</div>


												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __("Tax %") }} *</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="number" class="input-field" name="tax" step="0.01" placeholder="{{ __("Tax %") }}" required="" value="">
													</div>
												</div>

						                        <div class="row">
						                          <div class="col-lg-4">
						                            <div class="left-area">
						                              
						                            </div>
						                          </div>
						                          <div class="col-lg-7">
						                            <button class="addProductSubmit-btn" type="submit">{{ __("Create ") }}</button>
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
<script type="text/javascript">
 $( document ).ready(function() {
	$('#Taxby').change(function () {

		$option=this.value;
		if($option==1){
		$('#countryrow').show();
		$('#staterow').hide();
		}
		else{
		$('#countryrow').hide();
		$('#staterow').show();			
		}

	})
})
	
</script>
@endsection