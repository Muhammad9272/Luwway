@extends('front.layouts.app')

@section('pagelevel_css')
<link rel="stylesheet" href="{{asset('assets/front/css/market-place-1.css')}}">
@endsection

@section('page_content')

<div class="ps-page--my-account">
   <div class="ps-breadcrumb">
      <div class="container">
         <ul class="breadcrumb">
            <li><a href="{{route('front.index')}}">Home</a></li>
            <li>My account</li>
         </ul>
      </div>
   </div>
   <div class="ps-my-account">
      <div class="container">

         <form style="max-width: 440px !important" class="ps-form--account ps-tab-root " action="{{route('user-password-rreset-sub')}}" id="f-reset-password" method="post">
            @csrf
            <ul class="ps-tab-list">
               <li class="active"><a href="#sign-in">Password Reset</a></li>
            </ul>
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="ps-tabs">
               <div class="ps-tab active" id="sign-in">
                  <div class="ps-form__content pb-30" >
                     <h5>Reset Your Password</h5>
                     @include('includes.admin.form-login')
                     <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email"  class="form-control" placeholder="Email Address" value="{{$email}}"   required="" readonly> 
                     </div>
                     <div class="form-group form-forgot" >
                        <label>New Password </label>
                        <input type="password" name="password" id="regex" class="form-control" placeholder="{{ $langg->lang274 }}" value="" required="">
                        <span toggle="#eye" class="fa fa-fw fa-eye field-icon2 toggle-password mt-10">

                        </span>
                     </div>
                     <div class="form-group form-forgot">
                        <label>Confirm Password</label>
                         <input type="password" name="password_confirmation"  class="form-control" placeholder="{{ $langg->lang275 }}" value="" required="">
                        <span toggle="#eye" class="fa fa-fw fa-eye field-icon2 toggle-password mt-10">

                        </span>
                     </div>

                     <div class="px-4 m-0 m-auto">
                       
                         <input id="authdata" type="hidden" value="{{ $langg->lang177 }}">
                        <div class="form-group submtit">
                           <button class="ps-btn ps-btn--fullwidth submit-btn">{{ $langg->lang276 }}</button>
                        </div>
                     </div>


                  </div>

               </div>
            </div>
         </form>
      </div>
   </div>
</div>


@endsection

<!-- custom scripts-->
@section('pagelevel_scripts')
<script type="text/javascript">


</script>
@endsection