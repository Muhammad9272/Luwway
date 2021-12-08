        <div class="col-lg-3">
          <div class="user-profile-info-area">
            <div style="border-bottom: 4px solid #746f70 !important;" class="card">
              <div class="card-body">
              
               <div class="profile-userpic">
                <img src="{{AppHelper::getUserImage()}}" class="img-responsive" alt="">
              </div>
              
              <!-- END SIDEBAR USERPIC -->
              <!-- SIDEBAR USER TITLE -->
              <div class="profile-usertitle">
                <a href="javascript:;" class="profile-usertitle-name">
                 {{Auth::user()->name }}
                </a>
                <a  href="{{route('user-profile') }}" class="edit-profile">
                  Edit my profile
                </a>
              </div>

              </div>
            </div>
            <ul class="links">
                @php 

                  if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
                  {
                    $link = "https"; 
                  }
                  else
                  {
                    $link = "http"; 
                      
                    // Here append the common URL characters. 
                    $link .= "://"; 
                      
                    // Append the host(domain name, ip) to the URL. 
                    $link .= $_SERVER['HTTP_HOST']; 
                      
                    // Append the requested resource location to the URL 
                    $link .= $_SERVER['REQUEST_URI']; 
                  }      

              @endphp
              <li class="{{ $link == route('user-dashboard') ? 'active':'' }}">
                <a href="{{ route('user-dashboard') }}">
                  <i class="fa fa-home"></i>{{ $langg->lang200 }}
                </a>
              </li>

              <li class="{{ $link == route('user-news') ? 'active':'' }}">
                <a href="{{ route('user-news') }}">
                   <i class="fas fa-newspaper"></i> News
                </a>
              </li>

              @if(Auth::user()->IsVendor())
                <li>
                  <a href="{{ route('vendor-dashboard') }}">
                    <i class="fas fa-warehouse"></i>{{ $langg->lang230 }}
                  </a>
                </li>
              @endif

              <li class="{{ $link == route('user-orders') ? 'active':'' }}">
                <a href="{{ route('user-orders') }}">
                 <i class="far fa-clipboard-list"></i> My Orders
                </a>
              </li>


              <li class="{{ $link == route('user-order-track') ? 'active':'' }}">
                  <a href="{{route('user-order-track')}}"><i class="fas fa-shipping-fast"></i>{{ $langg->lang772 }}</a>
              </li>

              <li class="{{ $link == route('user-favorites-types') ? 'active':'' }}">
                  <a href="{{route('user-favorites-types')}}"><i class="far fa-heart"></i>Favorites</a>
              </li>

              <li class="{{ $link == route('user-reset') ? 'active':'' }}">
                <a href="{{ route('user-reset') }}">
               <i class="far fa-cog"></i> Setting
                </a>
              </li>

              <li>
                <a href="{{ route('user-logout') }}">
                  {{ $langg->lang207 }}
                </a>
              </li>





            </ul>
          </div>
         {{--  @if($gs->reg_vendor == 1)
          @if(Auth::user()->is_food==0 && Auth::user()->affiliate_user==0)
            <div class="row mt-4">
              <div class="col-lg-12 text-center">
                 <a href="{{ route('user-package') }}" class="mybtn1 lg">
                  <i class="fas fa-dollar-sign"></i> {{ Auth::user()->is_vendor == 1 ? $langg->lang233 : (Auth::user()->is_vendor == 0 ? $langg->lang233 : $langg->lang237) }}
                </a>
              </div>
            </div>
            @endif
          @endif --}}
        </div>