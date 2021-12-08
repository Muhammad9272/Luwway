<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
   <title>{{$gs->title}}</title>
   <!-- Font-->

   <link rel="stylesheet" type="text/css" href="{{asset('assets/front/login_form/bootstrap/bootstrap.css')}}">

   <!-- Jquery -->
   <link rel="stylesheet" href="{{asset('assets/admin/login_form/style.css')}}" />



</head>

<body class="form-v4">

   <div class="login-box">
      <h2>Login</h2>
      @include('includes.admin.form-login')
      <form id="loginform" action="{{ route('admin.login.submit') }}" method="POST">
         {{ csrf_field() }}
         <div class="user-box">
            <input type="text" name="email" required="">
            <label>Email </label>
         </div>
         <div class="user-box">
            <input type="password" name="password" required>
            <label for="">Password</label>
         </div>
         <input id="authdata" type="hidden" value="{{ __('Authenticating...') }}">
         <button class="logbtn" id="submitform">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Login
            </a>
         </button>
   </div>


   <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
   <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
   <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

   <script type="text/javascript">
      // LOGIN FORM

      $("#loginform").on('submit', function(e) {
         e.preventDefault();
         $('button.submit-btn').prop('disabled', true);
         $('.alert-info').show();
         $('.alert-info p').html($('#authdata').val());
         $.ajax({
            method: "POST",
            url: $(this).prop('action'),
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
               if ((data.errors)) {
                  $('.alert-success').hide();
                  $('.alert-info').hide();
                  $('.alert-danger').show();
                  $('.alert-danger ul').html('');
                  for (var error in data.errors) {
                     $('.alert-danger p').html(data.errors[error]);
                  }
               } else {
                  $('.alert-info').hide();
                  $('.alert-danger').hide();
                  $('.alert-success').show();
                  $('.alert-success p').html('Success !');
                  window.location = data;
               }
               $('button.submit-btn').prop('disabled', false);
            }

         });

      });
   </script>

</body>

</html>