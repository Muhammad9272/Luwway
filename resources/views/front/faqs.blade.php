@extends('front.layouts.app')
@section('page_content')


      <div class="ps-breadcrumb">
        <div class="container">
          <ul class="breadcrumb">
            <li><a href="{{route('front.index')}}">Home</a></li>
            <li>Frequently Asked Questions</li>
          </ul>
        </div>
      </div>
      <div class="ps-faqs">
        <div class="container">
          <div class="ps-section__header">
            <h1>Frequently Asked Questions</h1>
          </div>
          <div class="ps-section__content">
            <div class="table-responsive">
              <table class="table ps-table--faqs">
                <tbody>
                  @foreach($faqs as $faq)
                    <tr>
                      <td class="question">{{$faq->title}}</td>
                      <td>{!! $faq->details !!}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="ps-call-to-action">
        <div class="container">
          <h3>We’re Here to Help !<a href="{{ route('front.contact') }}"> Contact us</a></h3>
        </div>
      </div>



@endsection      
