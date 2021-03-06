<!doctype html>
<html lang="en" dir="ltr">

<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="author" content="GeniusOcean">
    	<meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- Title -->
		<title>{{$gs->title}}</title>
		<!-- favicon -->
		<link rel="icon"  type="image/x-icon" href="{{asset('assets/images/'.$gs->favicon)}}"/>
		<!-- Bootstrap -->
		<link href="{{asset('assets/admin/css/bootstrap.min.css')}}" rel="stylesheet" />
		<!-- Fontawesome -->
		<link rel="stylesheet" href="{{asset('assets/admin/css/fontawesome.css')}}">
		<!-- icofont -->
		<link rel="stylesheet" href="{{asset('assets/admin/css/icofont.min.css')}}">
		<!-- Sidemenu Css -->
		<link href="{{asset('assets/admin/plugins/fullside-menu/css/dark-side-style.css')}}" rel="stylesheet" />
		<link href="{{asset('assets/admin/plugins/fullside-menu/waves.min.css')}}" rel="stylesheet" />

		<link href="{{asset('assets/admin/css/plugin.css')}}" rel="stylesheet" />

		<link href="{{asset('assets/admin/css/jquery.tagit.css')}}" rel="stylesheet" />
    	<link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap-coloroicker.css') }}">

		<!-- Main Css -->

		<!-- stylesheet -->
		@if(DB::table('admin_languages')->where('is_default','=',1)->first()->rtl == 1)

		<link href="{{asset('assets/admin/css/rtl/style.css')}}" rel="stylesheet"/>
		<link href="{{asset('assets/admin/css/rtl/custom.css')}}" rel="stylesheet"/>
		<link href="{{asset('assets/admin/css/rtl/responsive.css')}}" rel="stylesheet" />
		<link href="{{asset('assets/admin/css/common.css')}}" rel="stylesheet" />

		@else

		<link href="{{asset('assets/admin/css/style.css')}}" rel="stylesheet"/>
		<link href="{{asset('assets/admin/css/custom.css')}}" rel="stylesheet"/>
		<link href="{{asset('assets/admin/css/responsive.css')}}" rel="stylesheet" />
		<link href="{{asset('assets/admin/css/common.css')}}" rel="stylesheet" />
		@endif

		@yield('styles')

<style type="text/css">
	#sidebar::after{
		background: #393838;
	}
	#sidebar ul > li > ul > li a{
		color: white;
	}
	#sidebar ul > li > ul > li a:hover{
		background:#3a3a3a;
		color: white;
	}
	#sidebar ul ul a:hover{
		background:#3a3a3a;
		color: white;
	}
	#sidebar ul > li > ul > li a:hover span{
		color: white;
	}
    #sidebar ul li.active>a{
    	background: #989898  !important;
    }
    .menu-toggle-button .nav-link span{
    	background: black;
    }
    .header .right-eliment .list li a{
    	color: black;
    }
    .header .right-eliment .list li.login-profile-area .user-img img{
      border: 3px solid #f2f3f8;
    }
    .header{
    	background: white;
    }
    @media only screen and (max-width: 480px){
    	.dd-moni{
          display: none;
    	}
    	
    }
</style>


	</head>
	<body>
		<div class="page">
			<div class="page-main">
				<!-- Header Menu Area Start -->
				<div class="header">
					<div class="container-fluid">
						<div class="d-flex justify-content-between">
							<div style="display: -webkit-inline-box;">
								<a class="ps-logo dd-moni" href="{{url('/')}}"><img src="{{asset('assets/images/'.$gs->logo)}}" style="margin-top: 17px" height="42px" alt=""></a>
								<div class="menu-toggle-button">
									<a class="nav-link" href="javascript:;" id="sidebarCollapse">
										<div class="my-toggl-icon">
												<span class="bar1"></span>
												<span class="bar2"></span>
												<span class="bar3"></span>
										</div>
									</a>
								</div>
							</div>
							<div class="right-eliment">
								<ul class="list">

									<li class="bell-area">
									<a id="notf_conv" class="dropdown-toggle-1" target="_blank" href="{{ route('front.index') }}">
										<i class="fas fa-globe-americas"></i>
										</a>

									</li>


									<li class="bell-area">
										<a id="notf_conv" class="dropdown-toggle-1" href="javascript:;">
											<i class="far fa-envelope"></i>
											<span data-href="{{ route('conv-notf-count') }}" id="conv-notf-count">{{ App\Models\Notification::countConversation() }}</span>
										</a>
										<div class="dropdown-menu">
											<div class="dropdownmenu-wrapper" data-href="{{ route('conv-notf-show') }}" id="conv-notf-show">
										</div>
										</div>
									</li>

									<li class="bell-area">
										<a id="notf_product" class="dropdown-toggle-1" href="javascript:;">
											<i class="icofont-cart"></i>
											<span data-href="{{ route('product-notf-count') }}" id="product-notf-count">{{ App\Models\Notification::countProduct() }}</span>
										</a>
										<div class="dropdown-menu">
											<div class="dropdownmenu-wrapper" data-href="{{ route('product-notf-show') }}" id="product-notf-show">
										</div>
										</div>
									</li>

									<li class="bell-area">
										<a id="notf_user" class="dropdown-toggle-1" href="javascript:;">
											<i class="far fa-user"></i>
											<span data-href="{{ route('user-notf-count') }}" id="user-notf-count">{{ App\Models\Notification::countRegistration() }}</span>
										</a>
										<div class="dropdown-menu">
											<div class="dropdownmenu-wrapper" data-href="{{ route('user-notf-show') }}" id="user-notf-show">
										</div>
										</div>
									</li>

									<li class="bell-area">
										<a id="notf_order" class="dropdown-toggle-1" href="javascript:;">
											<i class="far fa-newspaper"></i>
											<span data-href="{{ route('order-notf-count') }}" id="order-notf-count">{{ App\Models\Notification::countOrder() }}</span>
										</a>
										<div class="dropdown-menu">
											<div class="dropdownmenu-wrapper" data-href="{{ route('order-notf-show') }}" id="order-notf-show">
										</div>
										</div>
									</li>

									<li class="login-profile-area">
										<a class="dropdown-toggle-1" href="javascript:;">
											<div class="user-img">
												<img src="{{ Auth::guard('admin')->user()->photo ? asset('assets/images/admins/'.Auth::guard('admin')->user()->photo ):asset('assets/images/noimage.png') }}" alt="">
											</div>
										</a>
										<div class="dropdown-menu">
											<div class="dropdownmenu-wrapper">
													<ul>
														<h5>{{ __('Welcome!') }}</h5>
															<li>
																<a href="{{ route('admin.profile') }}"><i class="fas fa-user"></i> {{ __('Edit Profile') }}</a>
															</li>
															<li>
																<a href="{{ route('admin.password') }}"><i class="fas fa-cog"></i> {{ __('Change Password') }}</a>
															</li>
															<li>
																<a href="{{ route('admin.logout') }}"><i class="fas fa-power-off"></i> {{ __('Logout') }}</a>
															</li>
														</ul>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- Header Menu Area End -->
				<div class="wrapper">
					<!-- Side Menu Area Start -->
					<nav id="sidebar" class="nav-sidebar">
						<ul class="list-unstyled components" id="accordion">
							<li>
								<a href="{{ route('admin.dashboard') }}" class="wave-effect active"><i class="fa fa-home mr-2"></i>{{ __('Dashboard') }}</a>
							</li>
							@if(Auth::guard('admin')->user()->IsSuper())
							@include('includes.admin.roles.super')
							@else
							@include('includes.admin.roles.normal')
							@endif

						</ul>
					
					</nav>
					<!-- Main Content Area Start -->
					@yield('content')
					<!-- Main Content Area End -->
					</div>
				</div>
			</div>

			@php
				$curr = \App\Models\Currency::where('is_default','=',1)->first();
			@endphp
			<script type="text/javascript">
			  var mainurl = "{{url('/')}}";
			  var admin_loader = {{ $gs->is_admin_loader }};
			  var whole_sell = {{ $gs->wholesell }};
				var getattrUrl = '{{ route('admin-prod-getattributes') }}';
				var curr = {!! json_encode($curr) !!};
				// console.log(curr);
			</script>

		<!-- Dashboard Core -->
		<script src="{{asset('assets/admin/js/vendors/jquery-1.12.4.min.js')}}"></script>
        <script src="{{asset('assets/admin/js/vendors/vue.js')}}"></script>
		<script src="{{asset('assets/admin/js/vendors/bootstrap.min.js')}}"></script>
		<script src="{{asset('assets/admin/js/jqueryui.min.js')}}"></script>
		<!-- Fullside-menu Js-->
		<script src="{{asset('assets/admin/plugins/fullside-menu/jquery.slimscroll.min.js')}}"></script>
		<script src="{{asset('assets/admin/plugins/fullside-menu/waves.min.js')}}"></script>

		<script src="{{asset('assets/admin/js/plugin.js')}}"></script>
		<script src="{{asset('assets/admin/js/Chart.min.js')}}"></script>
		<script src="{{asset('assets/admin/js/tag-it.js')}}"></script>
		<script src="{{asset('assets/admin/js/nicEdit.js')}}"></script>
        <script src="{{asset('assets/admin/js/bootstrap-colorpicker.min.js') }}"></script>
        <script src="{{asset('assets/admin/js/notify.js') }}"></script>

        <script src="{{asset('assets/admin/js/jquery.canvasjs.min.js')}}"></script>

		<script src="{{asset('assets/admin/js/load.js')}}"></script>
		<!-- Custom Js-->
		<script src="{{asset('assets/admin/js/custom.js')}}"></script>
		<!-- AJAX Js-->
		<script src="{{asset('assets/admin/js/myscript.js')}}"></script>
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
		 <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
		<script>
			$('.nic-edit-p,.nic-edit').summernote({
              height: 200,})
		</script>


		@yield('scripts')

@if($gs->is_admin_loader == 0)
<style>
	div#geniustable_processing {
		display: none !important;
	}
</style>
@endif

	</body>

</html>
