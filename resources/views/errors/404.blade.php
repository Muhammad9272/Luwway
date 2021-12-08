@extends('front.layouts.app')

@section('page_content')

<div class="ps-page--404">
  <div class="container">
    <div class="ps-section__content"><img src="{{asset('assets/front/img/404.jpg')}}" alt="">
      <h3>ohh! page not found</h3>
      <p>It seems we can't find what you're looking for. Perhaps searching can help or go back to<a href="{{route('front.index')}}"> Homepage</a></p>

    </div>
  </div>
</div>

@endsection