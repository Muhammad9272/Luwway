@extends('layouts.vendor')

@section('content')

<div class="content-area">
            <div class="mr-breadcrumb">
              <div class="row">
                <div class="col-lg-12">
                    <h4 class="heading">Store Policy</h4>
                    <ul class="links">
                      <li>
                        <a href="{{ route('vendor-dashboard') }}">{{ $langg->lang441 }} </a>
                      </li>
                      <li>
                        <a href="javascript:;">Policy</a>
                      </li>

                    </ul>
                </div>
              </div>
            </div>
            <div class="social-links-area">
            <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
              <form id="geniusform" class="form-horizontal" action="{{ route('vendor-update-policy') }}" method="POST">   
              {{ csrf_field() }}

              @include('includes.admin.form-both')  

                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                              <h4 class="heading">
                                  Store Buy/Return Policy*
                              </h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <div class="text-editor">
                              <textarea class="nic-edit-p" name="policy">
                                {{ $data->return_policy }}
                              </textarea>
                            </div>
                          </div>
                        </div>

                <div class="row">
                  <div class="col-12 text-center">
                    <button type="submit" class="submit-btn">{{ $langg->lang530 }}</button>
                  </div>
                </div>
              </form>
            </div>
          </div>

@endsection