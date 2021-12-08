<!-- Modal -->


<div id="myModal" class="modal fade">
  <div class="modal-dialog modal-login">
    <div class="modal-content">
      <form action="{{route('user.login.submit')}}" class="mloginform" method="post">
        @csrf
        <div class="modal-header">        
          <h4 class="modal-title">Login</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body signin-form">  
          @include('includes.vendor.form-login')      
          <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" class="form-control" required="required">
          </div>
          <div class="form-group">
            <div class="clearfix">
              <label>Password</label>
            </div>
            
            <input type="password" name="password" class="form-control" required="required">
            <input type="hidden" name="modal" value="1">
            <input class="mauthdata" type="hidden" value="{{ $langg->lang177 }}">
            <a href="#myModalRegister" data-toggle="modal" class="pull-right text-muted"><small style="font-size: 100%;
               text-decoration: underline" >Register Now!</small></a>
          </div>
        </div>
        <div class="modal-footer">
          <label class="checkbox-inline pull-left"><input type="checkbox" name="remember" id="mrp"> &nbsp; Remember me</label>
          <input type="submit" class="btn btn-primary pull-right submit-btn" value="Login">
        </div>
      </form>
    </div>
  </div>
</div> 


<div id="myModalRegister" class="modal fade">
  <div class="modal-dialog modal-login" id="modalReg">
    <div class="modal-content">
      <form action="{{route('user-register-submit')}}" id="userRegister" method="post">
        <div class="modal-header">      
         @csrf
          <h4 class="modal-title">Register</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        </div>
        <div class="modal-body signin-form"> 
         @include('includes.vendor.form-login')       
                  <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                             <input class="form-control" name="name" type="text" value="{{old('fname')}}" placeholder="First name" required="">
                        </div>
                      </div>
                      <div class="col-md-12">
                          <div class="form-group">
                            <input class="form-control" name="email" type="Email" placeholder="Email address" value="{{old('email')}}" required="">
                          </div>                        
                      </div>                      
                  </div>
                  <input class="mprocessdata" type="hidden" value="Processing...">

                    
                  <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                            <input class="form-control"  id="regex" name="password" type="password" placeholder="Password" required="">
                             <div id="error_password"></div>
                        </div>
                      </div>
                      <div class="col-md-12">
                          <div class="form-group" >
                            <input class="form-control" name="password_confirmation" type="password" placeholder="Confirm Pasword">
                          </div>                        
                      </div>
                  </div> 

                    <a href="#myModal" data-toggle="modal" class="pull-right text-muted"><small style="font-size: 100%;
                     text-decoration: underline" >Already Have Account!</small></a>

        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary pull-right submit-btn" id="regisreg" value="Register">
        </div>
      </form>
    </div>
  </div>
</div> 

<div id="exampleModalCenter" class="modal fade">
  <div class="modal-dialog modal-login">
    <div class="modal-content" style="border-radius: 15px">
      <form action="{{route('front.currency11')}}" class="currn" id="formcurr" method="post">
        @csrf
        <div class="modal-header" style="background: white;border-radius: 15px">        
          <h4 class="modal-title" style="color: #232323;font-size: 18px">Update Your Settings</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body signin-form">  
          @include('includes.vendor.form-login')      
          <div class="form-group">

                
          <label>Select Country</label><br>
          <div id="basic" class="btn-countr" data-input-name="country"></div>
          <input type="hidden" name="country_flag" id="country_flag">         
          


            <label>Select Language</label>
            <select class="form-control">
              
              <option>English</option>
            </select>
            <label style="margin-top:12px;">Select Currency</label>
            <select class="form-control" name="curr_id" id="currency9">
              @foreach(DB::table('currencies')->get() as $currency)
                      <option value="{{$currency->id}}">{{$currency->name}}</option>
                    @endforeach
            </select>
          </div>
        <input class="mauthdata" type="hidden" value="Processing...">
        </div>
        <div class="modal-footer">
          
          <input style="border-radius: 23px;background-color: #000 !important" type="submit" class="btn btn-primary pull-right submit-btn" value="Save">
        </div>
      </form>
    </div>
  </div>
</div> 