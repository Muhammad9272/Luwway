@extends('front.layouts.app')
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
         <form style="max-width: 430px !important" id="forgotform" class="ps-form--account ps-tab-root" action="{{route('user-forgot-submit')}}" method="post">
            @csrf

            <ul class="ps-tab-list">
               <li class="active"><a href="">Forgot Password</a></li>
            </ul>
            @include('includes.admin.form-login')

            <div class="ps-tabs">
               <div class="ps-tab active" id="sign-in">
                  <div class="ps-form__content" style="padding-bottom: 30px">
                     <h5>Enter Email Address</h5>
                     <div class="form-group">
                        <input id="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" type="email" placeholder="Username or email address" required="">
                        @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                     </div>
                     <input class="authdata" type="hidden" value="{{ $langg->lang195 }}">

                     <div class="form-group submtit">
                        <button type="submit" class="submit-btn ps-btn ps-btn--fullwidth">Send Password Reset Link</button>
                     </div>
                     <p><span><strong>Remember Password! </strong><a href="{{route('user.login')}}"> Login</a></span></p>
                  </div>

               </div>
            </div>
         </form>
      </div>
   </div>
</div>


@endsection