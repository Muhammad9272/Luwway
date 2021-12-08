      <div class="alert alert-info validation" style="display: none;">
            <p class="text-left"></p> 
      </div>
      <div class="alert alert-success validation" style="display: none;">
      <button type="button" class="close alert-close"><span>×</span></button>
            <p class="text-left"></p> 
      </div>
      <div class="alert alert-danger validation" style="display: none;">
      <button type="button" class="close alert-close"><span>×</span></button>
      	<p class="text-left"></p> 
      </div>


      @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
                  {{ Session::get('success') }}
            </div>
      @endif