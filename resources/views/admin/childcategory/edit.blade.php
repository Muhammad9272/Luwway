@extends('layouts.load')

@section('content')

            <div class="content-area">

              <div class="add-product-content">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="product-description">
                      <div class="body-area">
                        @include('includes.admin.form-error')  
                      <form id="geniusformdata" action="{{route('admin-childcat-update',$data->id)}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Category') }}*</h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                              <select id="cat" required="">
                                  <option value="">{{ __('Select Category') }}</option>
                                    @foreach($cats as $cat)
                                      <option data-href="{{ route('admin-subcat-load',$cat->id) }}" value="{{ $cat->id }}" {{ $cat->id == $data->subcategory->category->id ? "selected":"" }}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Sub Category') }} *</h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                              <select id="subcat"  name="subcategory_id" required="">
                                <option value="">{{ __('Select Sub Category') }}</option>
                                @foreach($data->subcategory->category->subs as $sub)
                                  <option value="{{$sub->id}}" {{$sub->id == $data->subcategory->id ? "selected":""}}>{{$sub->name}}</option>
                                @endforeach
                              </select>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Name') }} *</h4>
                                <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <input type="text" class="input-field" name="name" placeholder="{{ __('Enter Name') }}" required="" value="{{$data->name}}">
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Slug') }} *</h4>
                                <p class="sub-heading">{{ __('(In English)') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <input type="text" class="input-field" name="slug" placeholder="{{ __('Enter Slug') }}" required="" value="{{$data->slug}}">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Tag Name') }} *</h4>
                                <p class="sub-heading">{{ __('(Like New,Trending)') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <input type="text" class="input-field" name="tag" placeholder="{{ __('Enter Tag') }}"  value="{{$data->tag}}">
                          </div>
                        </div>                        

                        <div class="row justify-content-center">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Tag Color') }} *</h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                              <div class="form-group">
                                <div class="input-group colorpicker-component cp">
                                <input type="text" class="input-field color-field" name="tag_color" value="{{ $data->tag_color }}"  class="cp"  />
                                  <span class="input-group-addon"><i></i></span>
                                </div>
                              </div>

                          </div>
                        </div>




                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                            </div>
                          </div>
                          <div class="col-lg-7">
                                          <div class="checkbox-wrapper">
                                            <input type="checkbox" name="is_featured" class="checkclick" id="is_featured" value="1" {{ $data->is_featured != 0 ? "checked":"" }}>
                                            <label for="is_featured">{{ __('Allow Featured Child Category') }}</label>
                                          </div>

                          </div>
                        </div>


                        <div class="{{ $data->is_featured == 0 ? "showbox":"" }}">

                          <div class="row">
                            <div class="col-lg-4">
                              <div class="left-area">
                                  <h4 class="heading">{{ __('Current Featured Image') }}*</h4>
                              </div>
                            </div>
                            <div class="col-lg-7">
                              <div class="img-upload">
                                <div id="image-preview" class="img-preview" style="background: url({{ $data->image ? asset('assets/images/categories/'.$data->image):asset('assets/images/noimage.png') }});">
                                  <label for="image-upload" class="img-label"><i class="icofont-upload-alt"></i>{{ __('Upload Image') }}</label>
                                  <input type="file" name="image" class="img-upload">
                                </div>
                              </div>
                            </div>

                          </div>


                        </div>



                        <br>
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                              
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <button class="addProductSubmit-btn" type="submit">{{ __('Save') }}</button>
                          </div>
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

@endsection