  <script type="text/javascript">
  var mainurl = "{{url('/')}}";
  var gs      = {!! json_encode($gs) !!};
  var langg    = {!! json_encode($langg) !!};

</script>



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
     <script src="{{asset('assets/front/plugins/owl-carousel/owl.carousel.js')}}"></script>
     <script src="{{asset('assets/front/login_modal/modal.js')}}"></script>
     <script src="{{asset('assets/front/plugins/gmap3.min.js')}}"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
{{--      <script src="{{asset('assets/front/js/plugin.js')}}"></script> --}}
  <!-------------------------- Mega menu -------------------------------->

  <script type="text/javascript" src="{{asset('assets/front/mega_menu/webslidemenu/webslidemenu.js')}}"></script>
  <!--Main Menu File-->
  <script type='text/javascript'>
    $(document).ready(function () {
      
      // $('.wsshoplink-active').siblings().removeClass('wsshoplink-active')
      $("a[data-theme]").click(function () {
        $("head link#theme").attr("href", $(this).data("theme"));
        $(this).toggleClass('active').siblings().removeClass('active');
      });
      $("a[data-effect]").click(function () {
        $("head link#effect").attr("href", $(this).data("effect"));
        $(this).toggleClass('active').siblings().removeClass('active');
      });

    });
  </script>
  <!------------------------------End  Mega menu ----------------------------> 
 

    {!! $seo->google_analytics !!}

  @if($gs->is_talkto == 1)
    <!--Start of Tawk.to Script-->
      {!! $gs->talkto !!}
    <!--End of Tawk.to Script-->
  @endif 
    <!-- custom scripts-->

    @section('pagelevel_scripts')
    @show
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
$('#header-search-submit').on('click',function(){
  $('#searchForm').submit();
})
})
</script>

    <script src="{{asset('assets/front/country_dropdown/js/jquery.flagstrap.js')}}"></script>
    <script type="text/javascript">
      
        $('#basic').flagStrap({
        onSelect: function (value, element) {
            
            $('#country_flag').val(value);
            console.log(element);
        }
    });

    </script>

    
    <script src="{{asset('assets/front/js/main.js')}}"></script>
    <script src="{{asset('assets/front/js/custom.js?version=13')}}"></script>
    <script src="{{asset('assets/front/js/toastr.js')}}"></script>
    @section('multiselect')
    @show