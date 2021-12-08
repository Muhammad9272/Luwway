@extends('front.layouts.app')

@section('page_content')



<section class="user-dashbord">
   <div class="container">
      <div class="row">
         @include('includes.user-dashboard-sidebar')
         <div class="col-lg-9">

            <div class="user-profile-details">

               <div class="account-info">
                  <div class="header-area">
                     <h4 class="title">
                        Account Setting
                     </h4>
                  </div>
                  <div class="row">
                     <div class="col-lg-6">
                        <div class="mycard">
                           <div class="title">
                              <h4>About you</h4>
                           </div>
                           <div class="body">
                              <ul>
                                 <li><b>Name</b></li>
                                 <li>{{Auth::user()->name }} <a class="edit" href="{{route('user-profile')}}"> Edit Profile</a></li>
                                 <li>On {{$gs->title}} since</li>
                                 <li>{{date('d-M-Y', strtotime(Auth::user()->created_at)) }} </li>
                              </ul>
                           </div>
                        </div>

                        <div class="mycard">

                           <div class="title">
                              <h4>Password</h4>
                           </div>
                           {{-- @if(session()->has('success1'))
                           <div class="alert alert-success">
                              {{ session()->get('success1') }}
                           </div>
                           @endif --}}
                            @include('includes.admin.form-both')
                           <div class="body">
                               <form id="userform" action="{{route('user-reset-submit')}}"  class="ps-form--account"  method="POST" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                 
                                 <div class="form-group form-forgot">
                                    <label>Current Password</label>
                                    <input id="eye1" type="password" class="form-control" name="cpass" required>
                                    <span toggle="#eye1" class="fa fa-fw fa-eye field-icon3 toggle-password"></span>
                                 </div>
                                 <div class="form-group form-forgot">
                                    <label>New Password</label>
                                    <input id="eye2" type="password" class="form-control" name="password" required>
                                    <span toggle="#eye2" class="fa fa-fw fa-eye field-icon3 toggle-password"></span>
                                 </div>
                                 <div class="form-group form-forgot">
                                    <label>Confirm Password</label>
                                    <input id="eye3" type="password" class="form-control" name="password_confirmation" required>
                                    <span toggle="#eye3" class="fa fa-fw fa-eye field-icon3 toggle-password"></span>
                                 </div>

                                 <button type="submit" class="btn ">Change Password</button>

                              </form>
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="mycard">
                           <div class="title">
                              <h4>Email</h4>
                           </div>
                           <div class="body">
                              {{-- @if ($errors->any())
                              <div class="alert alert-danger">
                                 <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                 </ul>
                              </div>
                              @endif

                              @if(session()->has('success'))
                              <div class="alert alert-success">
                                 {{ session()->get('success') }}
                              </div>
                              @endif --}}
                               @if (Session::has('success'))
                                    <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                          {{ Session::get('success') }}
                                    </div>
                              @endif
                              <ul>
                                 <li><b>Current Email</b></li>
                                 <li>{{Auth::user()->email }}</li>

                              </ul>

                              
                              <form  action="{{route('user-emailreset-submit')}}"  class="ps-form--account"  method="POST" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                 @csrf
                                 <h5>Change Your Email</h5>
                                 <div class="form-group">
                                    <label>New Email</label>
                                    <input type="email" class="form-control" name="new_email">
                                 </div>
                                 
                                 <button class="btn ">Change Email</button>
                              </form>
                           </div>
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

@endsection