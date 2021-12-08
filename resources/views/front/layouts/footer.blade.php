<footer class="ps-footer ps-footer--2 ps-footer--furniture" >
  <div class="ps-newsletter">
        <div class="ps-container">
          <form class="ps-form--newsletter" id="subscribeform" action="{{route('front.subscribe')}}" method="post">
            @csrf
            <div class="row">
                          <div class="col-md-2 col-lg-3 "></div>
                          <div class="col-xl-6 col-lg-6 col-md-8 col-sm-12 col-12 ">
                            <div class="ps-form__left" style="     text-align: center;   padding: 0 0 12px;">
                              <h4 style="font-family: initial;
                              font-size: 20px;">Register now to get updates on promotions & coupons</h4>
                            </div>
                          </div>
                          <div class="col-md-2 col-lg-3"></div>

                          <div class="col-md-2 col-lg-3"></div>
                          <div class="col-xl-6 col-lg-6 col-md-8 col-sm-12 col-12 ">
                            <div class="ps-form__right">
                              <div class="form-group--nest">
                                <input class="form-control footersearch" type="email" placeholder="Email address" name="email" required="">
                                <button class="ps-btn-footer" type="submit">Subscribe</button>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3 col-lg-3"></div>
            </div>
          </form>
        </div>
      </div>

      <div class="container sim-footer">
        <div class="ps-footer__content">
          <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 ">
                          <aside class="widget widget_footer">
                            <h4 class="widget-title">Company</h4>
                            <ul class="ps-list--link">
                              <li>
                                <a href="{{ route('front.index') }}">
                                  Home
                                </a>
                              </li>
                              
                              <li>
                                <a href="{{ route('front.blog') }}">
                                  Blogs
                                </a>
                              </li>

                              @foreach($footerpages as $data)
                              <li>
                                <a href="{{ route('front.page',$data->slug) }}">
                                  {{ $data->title }}
                                </a>
                              </li>
                              @endforeach

                              <li><a href="{{route('front.partner')}}">Partnership  </a></li>

                            </ul>
                          </aside>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 ">
                          <aside class="widget widget_footer">
                            <h4 class="widget-title">Support</h4>
                            <ul class="ps-list--link">


                              <li>
                                <a href="{{ route('front.contact') }}">
                                  Contact Us
                                </a>
                              </li>
                              <li>
                                <a href="{{ route('front.trackOrder') }}">
                                 Track Order
                                </a>
                              </li>
                              <li>
                                <a href="{{ route('front.faq') }}">
                                  FAQ
                                </a>
                              </li>


                              {{--                               <li><a href="policy.html">Policy</a></li>
                              <li><a href="term-condition.html">Term &amp; Condition</a></li>
                              <li><a href="shipping.html">Shipping</a></li>
                              <li><a href="return.html">Return</a></li>
                              <li><a href="faqs.html">FAQs</a></li> --}}
                            </ul>
                          </aside>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 ">
                          <aside class="widget widget_footer">
                            <h4 class="widget-title">Sell Center</h4>
                            <ul class="ps-list--link">
                              <li><a href="{{route('vendor.types')}}">Sell On {{$gs->title}} </a></li>
                              
                              <li><a href="{{ route('comming-soon') }}">Seller Help</a></li>
                              <li><a href="{{ route('comming-soon') }}">Forums</a></li>
                              <li><a href="{{ route('comming-soon') }}">Advertise on {{$gs->title}}</a></li>
                            </ul>
                          </aside>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 ">
                          <aside class="widget widget_newletters widget_footer">
                            <h4 class="widget-title">Follow Us</h4>
                           {{--  <p>Register now to get updates on promotions &amp; coupons</p> --}}

                          <ul class="ps-list--social">
                            @if($socialsetting->f_status == 1)
                              <li>
                                <a href="{{ $socialsetting->facebook }}" class="facebook" target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                              </li>
                              @endif

                              @if($socialsetting->g_status == 1)
                              <li>
                                <a href="{{ $socialsetting->gplus }}" class="google-plus" target="_blank">
                                    <i class="fab fa-google-plus-g"></i>
                                </a>
                              </li>
                              @endif

                              @if($socialsetting->t_status == 1)
                              <li>
                                <a href="{{ $socialsetting->twitter }}" class="twitter" target="_blank">
                                    <i class="fab fa-twitter"></i>
                                </a>
                              </li>
                              @endif

                              @if($socialsetting->l_status == 1)
                              <li>
                                <a href="{{ $socialsetting->linkedin }}" class="linkedin" target="_blank">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                              </li>
                              @endif

                              @if($socialsetting->d_status == 1)
                              <li>
                                <a href="{{ $socialsetting->dribble }}" class="dribbble" target="_blank">
                                    <i class="fab fa-dribbble"></i>
                                </a>
                              </li>
                              @endif
                              @if($socialsetting->i_status == 1)
                              <li>
                                <a href="{{ $socialsetting->instagram }}" class="instagram" target="_blank">
                                    <i class="fab fa-instagram"></i>
                                </a>
                              </li>
                              @endif
                              @if($socialsetting->p_status == 1)
                              <li>
                                <a href="{{ $socialsetting->pinterest }}" class="pinterest" target="_blank">
                                    <i class="fab fa-pinterest"></i>
                                </a>
                              </li>
                              @endif

                              @if($socialsetting->y_status == 1)
                              <li>
                                <a href="{{ $socialsetting->youtube }}" class="youtube" target="_blank">
                                    <i class="fab fa-youtube"></i>
                                </a>
                              </li>
                              @endif                              

                          </ul>

                            <br><br>
                                <button class="ps-btn-lang" data-toggle="modal" data-target="#exampleModalCenter">
                                  <i class="flagstrap-icon flagstrap-{{Session::has('country_flag') ? Illuminate\Support\Str::lower(Session::get('country_flag')):'us'}}" style="margin-right: 10px;"></i> {{ Session::has('country_flag') ? Session::get('country_flag'):'US'}} | English | {{ Session::has('currency') ?   $currencies->where('id','=',Session::get('currency'))->first()->sign   : $currencies->where('is_default','=',1)->first()->sign }} {{ Session::has('currency') ?   $currencies->where('id','=',Session::get('currency'))->first()->name  : $currencies->where('is_default','=',1)->first()->name }} 
                                </button>


                             
                          </aside>
                        </div>
          </div>
        </div>
        <div class="ps-footer__copyright" style="padding: 0px">
          <p> {!! $gs->copyright !!}</p>
          <p><a style="color:#666;text-decoration: underline;" href="{{url('/privacy')}}">Privacy & Policy</a> &nbsp;
            <a style="color:#666;text-decoration: underline;margin-left: 2px" href="{{url('/terms')}}">Term of Use</a></p>
          
        </div>
      </div>

      <div class="container mob-footer" style="display: none">
        <div class="ps-footer__content">
          <div class="row">
                        <div class="col-12">
                          <aside class="widget_footer">
                            
                            <ul class="menu--mobile">
                              <li class="menu-item-has-children"><h4 class="widget-title">Company</h4><span class="sub-toggle" style="top:-9px"></span>
                                <ul class="sub-menu" style="margin-bottom: 25px;">
                                  <li class="current-menu-item" >
                                    <a href="{{ route('front.index') }}">
                                      Home
                                    </a>
                                  </li>

                                  {{-- <li class="current-menu-item">
                                    <a href="{{route('food.store')}}">
                                      Food
                                    </a>
                                  </li> --}}

                                  <li class="current-menu-item">
                                    <a href="{{ route('front.blog') }}">
                                      Blogs
                                    </a>
                                  </li>

                                  @foreach($footerpages as $data)
                                    <li class="current-menu-item">
                                      <a href="{{ route('front.page',$data->slug) }}">
                                        {{ $data->title }}
                                      </a>
                                    </li>
                                  @endforeach

                                  <li class="current-menu-item"><a href="{{route('front.partner')}}">Partnership  </a></li>

                                </ul>
                              </li>

                            </ul>

                          </aside>
                        </div>
                        <div class="col-12 ">
                          <aside class="widget_footer">
                            <ul class="menu--mobile">
                              <li class="menu-item-has-children"><h4 class="widget-title">Support</h4><span class="sub-toggle" style="top:-9px"></span>
                                 <ul class="sub-menu" style="margin-bottom: 25px;">

                                  <li class="current-menu-item">
                                    <a href="{{ route('front.contact') }}">
                                      Contact Us
                                    </a>
                                  </li>
                                  <li class="current-menu-item">
                                    <a href="{{ route('front.trackOrder') }}">
                                     Track Order
                                    </a>
                                  </li>
                                 <li class="current-menu-item">
                                    <a href="{{ route('front.faq') }}">
                                      FAQ
                                    </a>
                                  </li>


                                </ul>
                              </li>
                            </ul>


                          </aside>
                        </div>

                        <div class="col-12 ">
                          <aside class="widget_footer">
                            <ul class="menu--mobile">
                              <li class="menu-item-has-children"><h4 class="widget-title">Sell Center</h4><span class="sub-toggle" style="top:-9px"></span>

                                <ul class="sub-menu" style="margin-bottom: 25px;">
                                  <li class="current-menu-item"><a href="{{route('vendor.types')}}">Sell On {{$gs->title}} </a></li>
                                  
                                  <li class="current-menu-item"><a href="{{ route('comming-soon') }}">Seller Help</a></li>
                                  <li class="current-menu-item"><a href="{{ route('comming-soon') }}">Forums</a></li>
                                  <li class="current-menu-item"><a href="{{ route('comming-soon') }}">Advertise on {{$gs->title}}</a></li>
                                </ul>

                              </li>

                            </ul>



                          </aside>
                        </div>
                        
                        <div class="col-12">
                          <div style="text-align: center;margin-bottom: 22px">
                              <button class="ps-btn-lang" data-toggle="modal" data-target="#exampleModalCenter">
                                  <i class="flagstrap-icon flagstrap-{{Session::has('country_flag') ? Illuminate\Support\Str::lower(Session::get('country_flag')):'us'}}" style="margin-right: 10px;"></i> {{ Session::has('country_flag') ? Session::get('country_flag'):'US'}} | English | {{ Session::has('currency') ?   $currencies->where('id','=',Session::get('currency'))->first()->sign   : $currencies->where('is_default','=',1)->first()->sign }} {{ Session::has('currency') ?   $currencies->where('id','=',Session::get('currency'))->first()->name  : $currencies->where('is_default','=',1)->first()->name }} 
                                </button>
                          </div>
                        </div>

                        <div class="col-12 ">
                          <aside class="widget widget_newletters widget_footer" style="text-align: center;">
                           
                          <ul class="ps-list--social">
                            @if($socialsetting->f_status == 1)
                              <li>
                                <a href="{{ $socialsetting->facebook }}" class="facebook" target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                              </li>
                              @endif

                              @if($socialsetting->g_status == 1)
                              <li>
                                <a href="{{ $socialsetting->gplus }}" class="google-plus" target="_blank">
                                    <i class="fab fa-google-plus-g"></i>
                                </a>
                              </li>
                              @endif

                              @if($socialsetting->t_status == 1)
                              <li>
                                <a href="{{ $socialsetting->twitter }}" class="twitter" target="_blank">
                                    <i class="fab fa-twitter"></i>
                                </a>
                              </li>
                              @endif

                              @if($socialsetting->l_status == 1)
                              <li>
                                <a href="{{ $socialsetting->linkedin }}" class="linkedin" target="_blank">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                              </li>
                              @endif

                              @if($socialsetting->d_status == 1)
                              <li>
                                <a href="{{ $socialsetting->dribble }}" class="dribbble" target="_blank">
                                    <i class="fab fa-dribbble"></i>
                                </a>
                              </li>
                              @endif
                              @if($socialsetting->i_status == 1)
                              <li>
                                <a href="{{ $socialsetting->instagram }}" class="instagram" target="_blank">
                                    <i class="fab fa-instagram"></i>
                                </a>
                              </li>
                              @endif
                              @if($socialsetting->p_status == 1)
                              <li>
                                <a href="{{ $socialsetting->pinterest }}" class="pinterest" target="_blank">
                                    <i class="fab fa-pinterest"></i>
                                </a>
                              </li>
                              @endif

                              @if($socialsetting->y_status == 1)
                              <li>
                                <a href="{{ $socialsetting->youtube }}" class="youtube" target="_blank">
                                    <i class="fab fa-youtube"></i>
                                </a>
                              </li>
                              @endif                              

                          </ul>
                             
                          </aside>
                        </div>
          </div>
        </div>

        <div class="ps-footer__copyright" style="padding: 0px">
          <p> {!! $gs->copyright !!}</p>
          <p><a style="text-decoration: underline;" href="{{url('/privacy')}}">Privacy & Policy</a> &nbsp;
            <a style="text-decoration: underline;margin-left: 2px" href="{{url('/terms')}}">Term of Use</a></p>
        </div>
      </div>



</footer>
