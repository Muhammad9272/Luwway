@extends('layouts.admin')
<link href="{{asset('assets/admin/css/jquery-ui.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/admin/dist/slimselect.min.css')}}" rel="stylesheet" />
<style type="text/css">
  .d-done{
    display:none !important;
  }
</style>


@section('content')
            <div class="content-area">

            <div class="mr-breadcrumb">
              <div class="row">
                <div class="col-lg-12">
                    <h4 class="heading">{{ __('Group Email') }}</h4>
                    <ul class="links">
                      <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                      </li>
                      <li>
                        <a href="javascript:;">{{ __('Email Settings') }}</a>
                      </li>
                      <li>
                        <a href="{{ route('admin-group-show') }}">{{ __('Group Email') }}</a>
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
                      <form id="geniusform" action="{{route('admin-group-submit')}}" method="POST" enctype="multipart/form-data">

                        @include('includes.admin.form-both')  

                        
                        {{csrf_field()}}
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Select User Type') }}*</h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                              <select id="user_type" name="type" required="">
                                <option value=""> {{ __('Choose User Type') }} </option>
                                <option value="1">{{ __('Members & Partners') }}</option>
                                <option value="2">{{ __('Members') }}</option>
                                <option value="3">{{ __('Partners') }}</option>
                                {{-- <option value="2">{{ __('Subscribers') }}</option> --}}
                              </select>
                          </div>
                        </div>


                        <div class="row locier d-done" id="location1">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Select Location') }}*</h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                                <select id="select1" multiple="" name="location1[]"  >    
                                    @foreach($locations as $key=>$location)
                                    <option value="{{$location->city}}">{{$location->city}}{{$location->county?(', '.$location->county):''}}{{$location->state?(', '.$location->state):''}} </option>
                                    @endforeach
                                  
                                </select>
                          </div>
                        </div>
                        <div class="row locier d-done" id="location2">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Select Location') }}*</h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                                <select id="select2" multiple="" name="location2[]"  >    
                                    @foreach($locations->where('is_vendor', '=',0) as $key=>$location)
                                    <option value="{{$location->city}}">{{$location->city}}{{$location->county?(', '.$location->county):''}}{{$location->state?(', '.$location->state):''}} </option>
                                    @endforeach
                                  
                                </select>
                          </div>
                        </div>
                        <div class="row locier d-done" id="location3">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Select Location') }}*</h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                                <select id="select3" multiple="" name="location3[]"  >    
                                    @foreach($locations->where('is_vendor', '=', '2') as $key=>$location)
                                    <option value="{{$location->city}}">{{$location->city}}{{$location->county?(', '.$location->county):''}}{{$location->state?(', '.$location->state):''}} </option>
                                    @endforeach
                                  
                                </select>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Email Subject') }} *</h4>
                                <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <input type="text" class="input-field" name="subject" placeholder="{{ __('Email Subject') }}" value="" required="">
                          </div>
                        </div>



                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                              <h4 class="heading">
                                   {{ __('Email Body') }} *
                              </h4>
                              <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-7">
                              <textarea class="nic-edit" name="body" placeholder="{{ __('Email Body') }}"></textarea> 
                          </div>
                        </div>


                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                              
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <button class="addProductSubmit-btn" type="submit">{{ __('Send Email') }}</button>
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
    <!-- select box live search js -->
    <script>
    $('#user_type').on('change', function() {
      var val = $(this).val();
      if(val == 1)
      {
        $('.locier').addClass('d-done');
        $('#location1').removeClass('d-done');
      }
      else if(val == 2){
        $('.locier').addClass('d-done');
        $('#location2').removeClass('d-done');
      }
      else{
        $('.locier').addClass('d-done');
        $('#location3').removeClass('d-done');
        // $('#location').addClass('d-done');
        // $('#location').prop("required", false);
      }
    });  

      setTimeout(function() {
        new SlimSelect({
          select: '#select1',
          selectByGroup: true,
          placeholder: 'Select Location'
        })
      }, 300)
      setTimeout(function() {
        new SlimSelect({
          select: '#select2',
          selectByGroup: true,
          placeholder: 'Select Location'
        })
      }, 300)
      setTimeout(function() {
        new SlimSelect({
          select: '#select3',
          selectByGroup: true,
          placeholder: 'Select Location'
        })
      }, 300)

    </script>

    <script src="{{asset('assets/admin/dist/slimselect.min.js')}}"></script>

@endsection