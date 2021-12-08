@extends('front.layouts.app')
@section('page_content')

<section class="user-dashbord">
    <div class="container">
      <div class="row">
        @include('includes.user-dashboard-sidebar')
        <div class="col-lg-9">
          @include('includes.form-success')
          <div class="user-profile-details">
            <div class="account-info">
              <div class="header-area">
                <h4 class="title">
                  {{ $langg->lang208 }}
                </h4>
              </div>
              <div class="edit-info-area">
              </div>
              <div class="main-info">
                
                <ul class="list">
                  <li>
                    <p><span class="user-title">Name:</span> {{ $user->name }}</p>
                  </li>
                   
                  <li>
                    <p><span class="user-title">{{ $langg->lang209 }}:</span> {{ $user->email }}</p>
                  </li>
                  @if($user->phone != null)
                  <li>
                    <p><span class="user-title">{{ $langg->lang210 }}:</span> {{ $user->phone }}</p>
                  </li>
                  @endif
                  @if($user->fax != null)
                  <li>
                    <p><span class="user-title">{{ $langg->lang211 }}:</span> {{ $user->fax }}</p>
                  </li>
                  @endif
                  @if($user->city != null)
                  <li>
                    <p><span class="user-title">{{ $langg->lang212 }}:</span> {{ $user->city }}</p>
                  </li>
                  @endif
                  @if($user->zip != null)
                  <li>
                    <p><span class="user-title">{{ $langg->lang213 }}:</span> {{ $user->zip }}</p>
                  </li>
                  @endif
                  @if($user->address != null)
                  <li>
                    <p><span class="user-title">{{ $langg->lang214 }}:</span> {{ $user->address }}</p>
                  </li>
                  @endif                
                </ul>
                <div class="card">
                  <div class="progress1">
                    <p>Ordered items</p>
                    <h1>{{$user->orders->count()}}</h1>
                    
                  </div>

                  <div class="progress2">
                    <p>Favorite items</p>
                    <h1>{{$user->wishlists->count()}}</h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>



@endsection