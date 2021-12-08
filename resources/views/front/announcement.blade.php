@extends('front.layouts.app')
<style type="text/css">
    .ann-img img{
    width: 100%;
  }
/*special food part css*/
.for-announcement{
    display: none !important;
  }


.header.header--mobile {

    -ms-box-shadow: 0 0 3px 0 rgba(0, 0, 0, 0.2);
    box-shadow: 0 0 3px 0 rgba(0, 0, 0, 0.2);
    }
   .header-cust-shadow{
    padding-bottom: 22px;
   } 
 /*special food part css ends*/   

</style>
@section('page_content')
<div class="container">
    <div class="ps-page--single" style="min-height: 350px">
      <div class="page_content ann-img">
       <p>{!! $gs->announcement_desc !!}</p> 
      </div>
    </div>
  </div>

@endsection  

    <!-- custom scripts-->
@section('pagelevel_scripts')    
    
@endsection