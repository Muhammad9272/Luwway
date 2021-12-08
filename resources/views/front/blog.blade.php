@extends('front.layouts.app')
@section('pagelevel_css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/front/css/datatable.css')}}">
@endsection
@section('page_content')


  <!-- Blog Page Area Start -->
{{--   <section class="blogpagearea">
    <div class="container">
      <div id="ajaxContent">

      <div class="row">
        @if(count($blogs)>0)
        @foreach($blogs as $blogg)
        <div class="col-md-6 col-lg-4">
              <div class="blog-box">
                <div class="blog-images">
                    <div class="img">
                    <img src="{{ $blogg->photo ? asset('assets/images/blogs/'.$blogg->photo):asset('assets/images/noimage.png') }}" class="img-fluid" alt="">
                    <div class="date d-flex justify-content-center">
                      <div class="box align-self-center">
                        <p>{{date('d', strtotime($blogg->created_at))}}</p>
                        <p>{{date('M', strtotime($blogg->created_at))}}</p>
                      </div>
                    </div>
                    </div>
                </div>
                <div class="details">
                    <a href='{{route('front.blogshow',$blogg->id)}}'>
                      <h4 class="blog-title">
                        {{strlen($blogg->title) > 50 ? substr($blogg->title,0,50)."...":$blogg->title}}
                      </h4>
                    </a>
                  <p class="blog-text">
                    {{substr(strip_tags($blogg->details),0,120)}}
                  </p>
                  <a class="read-more-btn" href="{{route('front.blogshow',$blogg->id)}}">{{ $langg->lang38 }}</a>
                </div>
            </div>
        </div>


        @endforeach
        
      </div>

        <div class="page-center">
          {!! $blogs->links() !!}               
        </div>
        @else
          <h4 style="margin: 0 auto;padding-bottom: 50px;margin-top: 60px;">
          Sory No Blogs</h4>
        @endif
      </div>
    </div>
  </section> --}}
  <div class="row">
    <div class="col-12">
      <img style="width: inherit;" src="{{asset('assets/front/images/blog.jpeg')}}">
    </div>
  </div>
  
      <div class="blogpagearea ps-page--blog" style="margin-top: 12px;">
      <div class="container">

        <div class="ps-blog" >
          <div class="ps-blog__header">

            <ul class="menu--mobile mob-blog">
              <li class="menu-item-has-children"><h4 class="widget-title">Blog Categories</h4><span class="sub-toggle" style="top:-9px"></span>
                <ul class="sub-menu" style="margin-bottom: 25px;">
                  <li class="current-menu-item" ><a href="{{route('front.blog')}}">All</a></li>
                  @foreach($bcats as $cat)
                  <li class="current-menu-item" >
                  <a  href="{{ route('front.blogcategory',$cat->slug) }}"  >
                    <span>{{ $cat->name }}</span>                    
                  </a>                    
                  </li>
                  @endforeach
                </ul>
              </li>
            </ul>

            <ul class="ps-list--blog-links pc-blog">
              <li class="{{Request::routeIs('front.blog')?'active':''}}" ><a href="{{route('front.blog')}}">All</a></li>
                @foreach($bcats as $cat)
                <li {!! $cat->slug === Request::segment(3) ? 'class="active"':'' !!}>
                  <a href="{{ route('front.blogcategory',$cat->slug) }}"  >
                    <span>{{ $cat->name }}</span>                    
                  </a>
                </li>
                @endforeach
            </ul>
          </div>
          <div id="ajaxContent" class="ps-blog__content">
            <div class="row">
              @if(count($blogs)>0)
              @foreach($blogs as $blogg)
              <div class="col-md-6 col-lg-4">
                    <div class="blog-box">
                      <div class="blog-images">
                          <div class="img">
                          <img src="{{ $blogg->photo ? asset('assets/images/blogs/'.$blogg->photo):asset('assets/images/noimage.png') }}" class="img-fluid" alt="">
                          <div class="date d-flex justify-content-center">
                            <div class="box align-self-center">
                              <p>{{date('d', strtotime($blogg->created_at))}}</p>
                              <p>{{date('M', strtotime($blogg->created_at))}}</p>
                            </div>
                          </div>
                          </div>
                      </div>
                      <div class="details">
                          <a href='{{route('front.blogshow',$blogg->id)}}'>
                            <h4 class="blog-title">
                              {{strlen($blogg->title) > 50 ? substr($blogg->title,0,50)."...":$blogg->title}}
                            </h4>
                          </a>
                        <p class="blog-text">
                          {{substr(strip_tags($blogg->details),0,120)}}
                        </p>
                        <a class="read-more-btn" href="{{route('front.blogshow',$blogg->id)}}">{{ $langg->lang38 }}</a>
                      </div>
                  </div>
              </div>


              @endforeach

            </div>
            <div class="ps-pagination">
                  {!! $blogs->links('vendor.pagination.default') !!} 
            </div>
              @else
                <h4 style="margin: 0 auto;padding-bottom: 50px;margin-top: 60px;">
                Sorry No Blogs</h4>
              @endif


          </div>
        </div>
      </div>
    </div>
  <!-- Blog Page Area Start -->




@endsection


@section('pagelevel_scripts')

<script type="text/javascript">
  

    // Pagination Starts

    $(document).on('click', '.pagination li', function (event) {
      event.preventDefault();
      if ($(this).find('a').attr('href') != '#' && $(this).find('a').attr('href')) {
        $('#preloader').show();
        $('#ajaxContent').load($(this).find('a').attr('href'), function (response, status, xhr) {
          if (status == "success") {
            $("html,body").animate({
              scrollTop: 0
            }, 1);
            $('#preloader').fadeOut();


          }

        });
      }
    });

    // Pagination Ends

</script>


@endsection