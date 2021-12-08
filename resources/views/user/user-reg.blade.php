@extends('front.layouts.app')

@section('pagelevel_css')

<link rel="stylesheet" href="{{asset('assets/front/css/market-place-1.css')}}">
<style type="text/css">
   .ps-form--account .ps-form__content {
      padding-bottom: 30px;
   }

   label {
      display: block;
   }
</style>
@endsection

@section('page_content')

<div class="ps-page--my-account">
   <!--     <div class="ps-breadcrumb">
        <div class="container">
          <ul class="breadcrumb">
            <li><a href="{{route('front.index')}}">Home</a></li>
            <li>My account</li>
          </ul>
        </div>
      </div> -->

   <div class="ps-my-account">
      <div class="container">
         <form style="max-width: 440px !important;" class="ps-form--account ps-tab-root" id="userRegister" action="{{route('user-register-submit')}}" method="post" enctype="multipart/form-data">
            @csrf
            <ul class="ps-tab-list">
               <li class="active"><a href="#register">Registration</a></li>
            </ul>
            
            <div class="ps-tabs">
               <div class="ps-tab active" id="register">
                  <div class="ps-form__content">
                     <h5>Create your Account</h5>
                     @include('includes.vendor.form-login')
                     <div class="form-group">
                        <label>Username</label>
                        <input class="form-control" name="name" type="text" value="{{old('fname')}}" placeholder="Username" required="">
                     </div>

                     <div class="form-group">
                        <label>Email address</label>
                        <input class="form-control" name="email" type="Email" placeholder="Email address" value="{{old('email')}}" required="">
                     </div>

                     <div class="form-group form-forgot">

                        <label>Password</label>
                        <input class="form-control" id="eye" name="password" type="password" placeholder="Password" required="">
                        <span toggle="#eye" class="fa fa-fw fa-eye field-icon3 toggle-password">
                        </span>
                        <!--  <p class="text-muted">Minimum 8 Characters</p> -->
                        <div id="error_password"></div>

                     </div>

                     <input class="mprocessdata" type="hidden" value="Processing...">

                     <div class="form-group form-forgot">
                        <label>Confirm Pasword</label>
                        <input class="form-control" id="eye1" name="password_confirmation" type="password" placeholder="Confirm Pasword">
                        <span toggle="#eye1" class="fa fa-fw fa-eye field-icon3 toggle-password">
                        </span>
                     </div>


                     <div class="form-group submtit">
                        <button class="ps-btn ps-btn--fullwidth submit-btn" id="regisreg">Sign up</button>
                     </div>
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
{{-- <script type="text/javascript">
  $(document).ready(function(){

})


</script> --}}

@endsection