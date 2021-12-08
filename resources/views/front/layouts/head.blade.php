    
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    @if(isset($page->meta_tag) && isset($page->meta_description))
        <meta name="keywords" content="{{ $page->meta_tag }}">
        <meta name="description" content="{{ $page->meta_description }}">
        <title>{{$gs->title}}</title>
    @elseif(isset($blog->meta_tag) && isset($blog->meta_description))
        <meta name="keywords" content="{{ $blog->meta_tag }}">
        <meta name="description" content="{{ $blog->meta_description }}">
        <title>{{$gs->title}}</title>
    @elseif(isset($productt))
        <meta name="keywords" content="{{ !empty($productt->meta_tag) ? implode(',', $productt->meta_tag ): '' }}">
        <meta name="description" content="{{ $productt->meta_description != null ? $productt->meta_description : strip_tags($productt->description) }}">
        <meta property="og:title" content="{{$productt->name}}" />
        <meta property="og:description" content="{{ $productt->meta_description != null ? $productt->meta_description : strip_tags($productt->description) }}" />
        <meta property="og:image" content="{{asset('assets/images/'.$productt->photo)}}" />
        <meta name="author" content="Luwaay">
        <title>{{substr($productt->name, 0,11)."-"}}{{$gs->title}}</title>
    @else
        <meta name="keywords" content="{{ $seo->meta_keys }}">
        <meta name="description" content="{{$gs->web_slogan}}">
        <meta name="author" content="Luwaay">
        <title>{{$gs->web_slogan}}</title>
    @endif
    
    {{-- <link rel="icon"  type="image/x-icon" href="{{asset('assets/Logo/Artboard 1.png')}}"/> --}}
    <link rel="icon"  type="image/x-icon" href="{{asset('assets/images/'.$gs->favicon)}}"/>

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700&amp;amp;subset=latin-ext" rel="stylesheet">

        <link rel="stylesheet" href="{{asset('assets/front/reg_form11/fonts/themify-icons/themify-icons.css')}}">
      
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
<link rel="stylesheet" href="{{asset('assets/front/css/organic.css')}}">
    @section('pagelevel_css')
    @show

    <link rel="stylesheet" href="{{asset('assets/front/plugins/jquery-ui/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/plugins/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/plugin.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <link rel="stylesheet" href="{{asset('assets/front/css/animate.css')}}">


    <link rel="stylesheet" href="{{asset('assets/front/css/toastr.css')}}">
    <link href="{{asset('assets/front/country_dropdown/css/flags.css')}}" rel="stylesheet">

    <style type="text/css">
        #menu-bar-hover i:hover{
            color: green !important;
        }
        .hom > li > a{
            font-weight: 500;
        }
        .hom > li > a:hover{
            color:#000000;
        }
        .ps-block--user-header .ps-block__right a:hover {
        color: #000000;
        }
    </style>



    <!--Start of Tawk.to Script-->
{{--         <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/5eb78daf967ae56c5218602c/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
        </script> --}}
    <!--End of Tawk.to Script-->
    <!--Main Mega Menu File-->

  <link id="effect" rel="stylesheet" type="text/css" media="all" href="{{asset('assets/front/mega_menu/webslidemenu/dropdown-effects/fade-down.css')}}" />
  <link rel="stylesheet" type="text/css" media="all" href="{{asset('assets/front/mega_menu/webslidemenu/webslidemenu.css?version=1')}}" />
  <link rel="stylesheet" href="{{asset('assets/front/mega_menu/use.fontawesome.com/releases/v5.7.2/css/all.css')}}">
  <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{asset('assets/front/mega_menu/webslidemenu/color-skins/white-gry.css')}}" />

  <!--End mega menu -->