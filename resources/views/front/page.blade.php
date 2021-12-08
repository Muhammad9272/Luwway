@extends('front.layouts.app')
<style type="text/css">
  .about_img img{
    width: 100%;
  }
</style>
@section('page_content')
      <div class="ps-breadcrumb">
        <div class="container">
          <ul class="breadcrumb">
            <li><a href="{{route('front.index')}}">Home</a></li>
            <li><a href="{{ route('front.page',$page->slug) }}">{{ $page->title }}</a></li>

          </ul>
        </div>
      </div>
      <div class="ps-contact-info">
        <div class="container about_img">

        	<h2 class="title">
              {{ $page->title }}
            </h2>
            <p>
              {!! $page->details !!}
            </p>
        </div>
    </div>



@endsection

