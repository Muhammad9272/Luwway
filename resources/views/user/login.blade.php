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
         <form style="max-width: 440px !important" class="ps-form--account ps-tab-root " action="{{route('user.login.submit')}}" id="loginform" method="post">
            @csrf
            <ul class="ps-tab-list">
               <li class="active"><a href="#sign-in">Login</a></li>
            </ul>
            
            <div class="ps-tabs">
               <div class="ps-tab active" id="sign-in">
                  <div class="ps-form__content" style="padding-bottom: 30px">
                     <h5>Sign in your Account</h5>
                     @include('includes.admin.form-login')
                     <div class="form-group">
                        <label>Email address</label>
                        <input class="form-control" type="text" name="email" placeholder="Username or email address">
                     </div>
                     <div class="form-group form-forgot">
                        <label>Password</label>
                        <input class="form-control" id="eye" type="password" name="password" placeholder="Password">
                        <span toggle="#eye" class="fa fa-fw fa-eye field-icon2 toggle-password">

                        </span>

                        <p class="text-muted">Minimum 8 Characters</p>
                     </div>
                     <div class="px-4 m-0 m-auto">
                        <div class="form-group">
                           <h6 style="float: left;"> Stay Signed in</h6>
                           <a style="float: right; margin-bottom: 10px; font-size: 12px;margin-top: -2px;" href="{{route('user-forgot')}}">Forgot your password?</a>
                        </div>



                         <input id="authdata" type="hidden" value="{{ $langg->lang177 }}">
                        <div class="form-group submtit">
                           <button class="ps-btn ps-btn--fullwidth submit-btn">Sign in</button>
                        </div>
                     </div>

                     <div class="text-center pt-2"> <strong style="font-style: 15px">Don't Have an account! </strong> <a class="signbtn btn" href="{{route('user-register')}}"> Sign Up</a></div>
                     @if(App\Models\Socialsetting::find(1)->f_check == 1 || App\Models\Socialsetting::find(1)->g_check ==1)
                     <div class="ps-form__footer">
                        <p class="text-center mt-3">Or Sign in with</p>

                        <ul class="ps-list--social" style="display: block;margin-left: 30px">
                           @if(App\Models\Socialsetting::find(1)->f_check == 1)
                           <li style="width: 100%;padding: 7px">
                              <a class="facebook" href="{{ route('social-provider','facebook') }}">
                                 <span class="icon121"><i class="fab fa-facebook-f"></i></span>
                                 &nbsp;<span class="text1211 font-weight-bold" style="color:#666">Continue with facebook</span>
                              </a>
                           </li>
                           @endif
                           @if(App\Models\Socialsetting::find(1)->g_check == 1)
                           <li style="width: 100%;padding: 7px">
                              <a class="google" href="{{ route('social-provider','google') }}">
                                 <span class="icon1211"><img style="width: 16px;padding-bottom: 3px;" src="{{asset('assets/front/images/google_icon.png')}}"></i></span>&nbsp;<span class="text1211 font-weight-bold">Continue with google</span>
                              </a>
                           </li>
                           @endif
                        </ul>
                     </div>
                     @endif
                     <div class="px-4 m-0 m-auto ">

                        <p class="text-justify mb-3">By clicking Sign in or Continue with Google, Facebook, or Apple, you agree to Luwaay's <a style="color: blue; text-decoration: underline;" href="">Terms of Use</a> And <a href="" style="color: blue; text-decoration: underline;">Privacy Policy</a>.Luwaay may send you communications, you may change your preferences in your account settings.We'll never post without your permission.</p>
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