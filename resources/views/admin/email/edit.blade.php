
@extends('layouts.admin') 
<style type="text/css">
  .note-editor .note-toolbar .note-dropdown-menu{
    min-width: 180px !important;
  }
  .note-dropdown-item h1{
        font-size: 36px;
  }
  .note-dropdown-item h2{
        font-size: 30px;
  }
  .note-btn.dropdown-toggle::after{
      display: none;
  }
  .note-editor .note-toolbar .note-color-all.open .note-dropdown-menu{
    display: inline-flex;
  }
  
</style>

@section('content')  
          <input type="hidden" id="headerdata" value="{{ __('EMAIL TEMPLATES') }}">
          <div class="content-area">
            <div class="mr-breadcrumb">
              <div class="row">
                <div class="col-lg-12">
                    <h4 class="heading">{{ __('Email Templates') }} <a class="add-btn" href="{{ url()->previous() }}"><i class="fas fa-arrow-left"></i> {{ __("Back") }}</a></h4>
                    <ul class="links">
                      <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                      </li>
                      <li>
                        <a href="javascript:;">{{ __('Email Settings') }}</a>
                      </li>
                      <li>
                        <a href="{{ route('admin-mail-index') }}">{{ __('Email Templates') }}</a>
                      </li>
                    </ul>
                </div>
              </div>
            </div>
            <div class="content-area">
              <div class="add-product-content">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="product-description">
                      <div class="body-area">
                        @include('includes.admin.form-success')  

                                      <div class="row" >
                                        <div class="col-md-7 offset-md-3">
                                        <p>{{ __('Use the BB codes, it show the data dynamically in your emails.') }}</p>
                                        <br>
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>{{ __('Meaning') }}</th>
                                                <th>{{ __('BB Code') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>{{ __('Customer Name') }}</td>
                                                <td>{customer_name}</td>
                                            </tr>
                                            {{-- <tr>
                                                <td>{{ __('Order Amount') }}</td>
                                                <td>{order_amount}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ ('Admin Name') }}</td>
                                                <td>{admin_name}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Admin Email') }}</td>
                                                <td>{admin_email}</td>
                                            </tr> --}}
                                            <tr>
                                                <td>{{ __('Website Title') }}</td>
                                                <td>{website_title}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Order Number') }}</td>
                                                <td>{order_number}</td>
                                            </tr>
                                            
                                            

                                            </tbody>
                                        </table>
                                        </div>
                                        </div>

                      <form id="geniusform" action="{{route('admin-mail-update',$data->id)}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="row">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Email Type') }} *</h4>
                            </div>
                          </div>
                          <div class="col-lg-8">
                            <input type="text" class="input-field" placeholder="{{ __('Email Type') }}" required="" value="{{$data->email_type}}" disabled="">
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-3">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Email Subject') }} *</h4>
                                <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                            </div>
                            </div>

                          <div class="col-lg-8">
                            <input type="text" class="input-field" name="email_subject" placeholder="{{ __('Email Subject') }}" required="" value="{{$data->email_subject}}">
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-3">
                            <div class="left-area">
                              <h4 class="heading">{{ __('Email Body') }} *</h4>
                              <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-8">
                              <textarea class="detail_desc" id="detail_desc" name="email_body" placeholder="{{ __('Email Body') }}">{{ $data->email_body }}</textarea> 
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-3">
                            <div class="left-area">
                              
                            </div>
                          </div>
                          <div class="col-lg-8">
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

@section('scripts')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
 <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
$(document).ready(function() {

      $('.detail_desc').summernote({
          height: 400,
          //fontSizeUnits: ['px', 'pt'],
          //lineHeights: ['0.2', '0.3', '0.4', '0.5', '0.6', '0.8', '1.0', '1.2', '1.4', '1.5', '2.0', '3.0'],
            buttons: {
              simple: SimpleButton,
              verify:VerifyButton,
              forgot:ForgotButton,
              partner:PartnerPaswordButton,
            },
            toolbar: [
              ['style', ['style']],
              ['font', ['bold', 'underline', 'clear']],
              ['fontname', ['fontname']],
              ['color', ['color']],
              ['fontsize', ['fontsize']],
              
              ['para', ['ul', 'ol', 'paragraph','height']],
              ['table', ['table']],
              ['insert', ['link', 'picture', 'video']],
              ['view', ['fullscreen', 'codeview']],
              ['custom', ['simple','verify','forgot','partner']],
            ],
      });


      });

var SimpleButton = function (context) {
  var ui = $.summernote.ui;
  // create button
  var button = ui.button({
    contents: '<i class="fa fa-plus"/> Button',
    tooltip: 'hello',
    click: function () {
      // invoke insertText method with 'hello' on editor module.
      context.invoke('editor.pasteHTML', '<a href=""style="background:#0a507f;text-decoration:none !important; font-weight:500; margin:10px; color:#fff; font-size:14px;padding:5px 18px;display:inline-block;border-radius:50px;">Add Text</a>');
    }
  });

  return button.render();   // return button as jquery object
}


var VerifyButton = function (context) {
  var ui = $.summernote.ui;
  // create button
  var button = ui.button({
    contents: '<i class="fa fa-plus" style="margin-left:10px;"/> Verify Account Button',
    tooltip: 'hello',
    click: function () {
      // invoke insertText method with 'hello' on editor module.
      context.invoke('editor.pasteHTML', '<a href="{{url('user/register/verify/{token}')}}"  style="background:#0a507f;text-decoration:none !important; font-weight:500; margin:10px; color:#fff;text-transform:uppercase; font-size:14px;padding:5px 18px;display:inline-block;border-radius:50px;">Verify Account</a>');
    }
  });
  
  @if($data->id==1 || $data->id==2)
    return button.render();   // return button as jquery object
  @endif
}

var ForgotButton = function (context) {
  var ui = $.summernote.ui;

  // create button
  var button = ui.button({
    contents: '<i class="fa fa-plus" style="margin-left:10px;"/> Reset Password Button',
    tooltip: 'hello',
    click: function () {
      // invoke insertText method with 'hello' on editor module.
      context.invoke('editor.pasteHTML', '<a href="{{url('user/reset-password/{token}')}}"  style="background:#0a507f;text-decoration:none !important; font-weight:500; margin:10px; color:#fff;text-transform:uppercase; font-size:14px;padding:5px 18px;display:inline-block;border-radius:50px;">Reset Password</a>');
    }
  });
   @if($data->id==9)
  return button.render();   // return button as jquery object
  @endif
}

var PartnerPaswordButton = function (context) {
  var ui = $.summernote.ui;

  // create button
  var button = ui.button({
    contents: '<i class="fa fa-plus" style="margin-left:10px;"/> Partner Password Button',
    tooltip: 'hello',
    click: function () {
      // invoke insertText method with 'hello' on editor module.
      context.invoke('editor.pasteHTML', '<a href="{{url('/vendor/new-password/{token}')}}"  style="background:#860028;text-decoration:none !important; font-weight:500; margin:10px; color:#fff; font-size:14px;padding:5px 18px;display:inline-block;border-radius:50px;">Set Your Password</a>');
    }
  });
  @if($data->id==100)
  return button.render();   // return button as jquery object
  @endif
}




</script>


@endsection

