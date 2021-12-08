<!DOCTYPE html>
<html lang="en">

  <head>
    @include('front.layouts.head')
  </head>

  <body  oncontextmenu="return {{$gs->front_debug==1?true:false}}" >
     
    @include('front.layouts.header')

    
    @section('page_content')
    @show

<!-- Popup banner Start-->

    @if($gs->is_popup== 1)

    @if(isset($visited))
        <div style="display:none">
            <img src="{{asset('assets/images/'.$gs->popup_background)}}">
        </div>

        <!--  Starting of subscribe-pre-loader Area   -->
          <div class="ps-popup" id="subscribe" data-time="500">
            <div class="ps-popup__content bg--cover" data-background="{{asset('assets/images/'.$gs->popup_background)}}"><a class="ps-popup__close" href="#"><i class="icon-cross"></i></a>
              <form class="ps-form--subscribe-popup" action="{{route('front.subscribe')}}" id="subscribeform" method="POST" >
                @csrf
                <div class="ps-form__content">
                  <h4>{{$gs->popup_title}}</h4>
                  <p>{{$gs->popup_text}}</p>
                  <div class="form-group">
                    <input class="form-control" type="email" name="email" placeholder="Email Address" required>
                    <button class="ps-btn" id="sub-btn" >Subscribe</button>
                  </div>
                              <div class="ps-checkbox">
                                <input class="form-control" type="checkbox" id="not-show" name="not-show">
                                <label for="not-show">Don't show this popup again</label>
                              </div>
                </div>
              </form>
            </div>
          </div>
        <!--  Ending of subscribe-pre-loader Area   -->

    @endif

    @endif
<!-- Popup banner Ends-->


  <!-- Modals -->
  @include('includes.modal');
  <!--Ends Modals -->



<!-- Order Tracking modal Start-->
    <div class="modal fade" id="track-order-modal" tabindex="-1" role="dialog" aria-labelledby="order-tracking-modal" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title"> <b>{{ $langg->lang772 }}</b> </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                        <div class="order-tracking-content">
                            <form id="track-form" class="track-form">
                                {{ csrf_field() }}
                                <input type="text" class="form-control" id="track-code" placeholder="{{ $langg->lang773 }}" required="">
                                <button type="submit" id="trackorderBtn" class="mybtn1 btn btn-Default">{{ $langg->lang774 }}</button>
                                <a href="#"  data-toggle="modal" data-target="#order-tracking-modal"></a>
                            </form>
                        </div>

                        <div>
                    <div class="submit-loader d-none">
                <img src="{{asset('assets/images/'.$gs->loader)}}" alt="">
              </div>
              <div id="track-order">

              </div>
                        </div>

            </div>
            </div>
        </div>
    </div>
<!-- Order Tracking modal End -->









    <!----------Footer Section --------------------------------------->
    @include('front.layouts.footer')


     
      <!----------------------------  Scripts ------------------------->
      @include('front.layouts.scripts')

<script type="text/javascript">
  $(".toggle-password").click(function() {
  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});


@if($gs->front_debug==0)
$(document).bind("contextmenu",function(e) {  
  e.preventDefault(); 
  //window.location = url('/');
}); 

document.onkeydown = function(e) {
  if(event.keyCode == 123) {
  return false;
  window.location = url('/');
  }
  if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
  return false;
  window.location = url('/');
  }
  if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
  return false;
  window.location = url('/');
  }
  if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
  return false;
  window.location = url('/');
  }
}
@endif



</script>

  </body>
</html>
