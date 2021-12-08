<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>Luwaay - Multi Vendor &amp; Marketplace</title>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700&amp;amp;subset=latin-ext" rel="stylesheet">
<link rel="stylesheet" href="{{asset('assets/front/plugins/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/fonts/Linearicons/Linearicons/Font/demo-files/demo.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/plugins/bootstrap4/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/plugins/owl-carousel/assets/owl.carousel.css')}}">

    <link rel="stylesheet" href="{{asset('assets/front/css/common.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/login_modal/modal.css')}}">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
  

    <link rel="stylesheet" href="{{asset('assets/front/plugins/slick/slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/plugins/lightGallery-master/dist/css/lightgallery.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/custom.css')}}">

    <link rel="stylesheet" href="{{asset('assets/front/plugins/jquery-ui/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/plugins/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/plugin.css')}}">
  </head>
  <body>
    <div class="ps-page--comming-soon">
      <div class="container">
        <div class="ps-page__header"><a class="ps-logo" href="{{route('front.index')}}"><img src="{{asset('assets/images/'.$gs->logo)}}" style="height: 40px" alt=""></a>
          <h1> Coming Soon</h1>
          <p>Condimentum ipsum a adipiscing hac dolor set consectetur urna commodo elit parturient</p><a>molestie ut nisl partu convallier ullamcorpe.</a>
        </div>
        <div class="ps-page__content"><img src="{{asset('assets/front/img/coming-soon.jpg')}}" alt="">
          <figure>
            <figcaption>NEW STORE WE BE LAUNCHED IN:</figcaption>
            <ul class="ps-countdown" data-time="July 21, 2020 15:37:25">
              <li><span class="days"></span>
                <p>Days</p>
              </li>
              <li><span class="hours"></span>
                <p>Hours</p>
              </li>
              <li><span class="minutes"></span>
                <p>Minutes</p>
              </li>
              <li><span class="seconds"></span>
                <p>Second</p>
              </li>
            </ul>
          </figure>
        </div>
        <div class="ps-page__footer">
              <ul class="ps-list--social">
                @if(App\Models\Socialsetting::find(1)->f_status == 1)
                  <li>
                    <a href="{{ App\Models\Socialsetting::find(1)->facebook }}" class="facebook" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                  </li>
                  @endif

                  @if(App\Models\Socialsetting::find(1)->g_status == 1)
                  <li>
                    <a href="{{ App\Models\Socialsetting::find(1)->gplus }}" class="google-plus" target="_blank">
                        <i class="fab fa-google-plus-g"></i>
                    </a>
                  </li>
                  @endif

                  @if(App\Models\Socialsetting::find(1)->t_status == 1)
                  <li>
                    <a href="{{ App\Models\Socialsetting::find(1)->twitter }}" class="twitter" target="_blank">
                        <i class="fab fa-twitter"></i>
                    </a>
                  </li>
                  @endif

                  @if(App\Models\Socialsetting::find(1)->l_status == 1)
                  <li>
                    <a href="{{ App\Models\Socialsetting::find(1)->linkedin }}" class="linkedin" target="_blank">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                  </li>
                  @endif

                  @if(App\Models\Socialsetting::find(1)->d_status == 1)
                  <li>
                    <a href="{{ App\Models\Socialsetting::find(1)->dribble }}" class="dribbble" target="_blank">
                        <i class="fab fa-dribbble"></i>
                    </a>
                  </li>
                  @endif
              </ul>
        </div>
      </div>
    </div>
    <div id="back2top"><i class="pe-7s-angle-up"></i></div>
    <div class="ps-site-overlay"></div>
    <div id="loader-wrapper">
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
    </div>
    <div class="ps-search" id="site-search"><a class="ps-btn--close" href="#"></a>
      <div class="ps-search__content">
        <form class="ps-form--primary-search" action="do_action" method="post">
          <input class="form-control" type="text" placeholder="Search for...">
          <button><i class="aroma-magnifying-glass"></i></button>
        </form>
      </div>
    </div>
     <script src="{{asset('assets/front/plugins/jquery-1.12.4.min.js')}}"></script>
    
     <script src="{{asset('assets/front/plugins/popper.min.js')}}"></script>
     
     <script src="{{asset('assets/front/plugins/bootstrap4/js/bootstrap.min.js')}}"></script>
     <script src="{{asset('assets/front/plugins/imagesloaded.pkgd.min.js')}}"></script>
     <script src="{{asset('assets/front/plugins/masonry.pkgd.min.js')}}"></script>
     <script src="{{asset('assets/front/plugins/isotope.pkgd.min.js')}}"></script>
     <script src="{{asset('assets/front/plugins/jquery.matchHeight-min.js')}}"></script>
     <script src="{{asset('assets/front/plugins/slick/slick/slick.min.js')}}"></script>
     <script src="{{asset('assets/front/plugins/jquery-bar-rating/dist/jquery.barrating.min.js')}}"></script>
     <script src="{{asset('assets/front/plugins/slick-animation.min.js')}}"></script>
     <script src="{{asset('assets/front/plugins/lightGallery-master/dist/js/lightgallery-all.min.js')}}"></script>
     <script src="{{asset('assets/front/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
     <script src="{{asset('assets/front/plugins/sticky-sidebar/dist/sticky-sidebar.min.js')}}"></script>
     <script src="{{asset('assets/front/plugins/jquery.slimscroll.min.js')}}"></script>

     <script src="{{asset('assets/front/plugins/select2/dist/js/select2.full.min.js')}}"></script>
    <!-- custom scripts-->
    <script src="{{asset('assets/front/js/main.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxflHHc5FlDVI-J71pO7hM1QJNW1dRp4U&amp;region=GB"></script>
  </body>
</html>