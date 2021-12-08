{{-- <option data-href="" value="">Select State</option> --}}
@if(isset($chk_buket))
@foreach($states as $data)
<option data-href="{{ route('checkout-states-load',['id1'=>$data->id,'id2'=>2]) }}"  value="{{ $data->name }}" {{ isset($checkout_state_id)?( $checkout_state_id== $data->id ? 'selected' : ''):'' }} >{{ $data->name }}</option>
@endforeach
@else
@foreach($states as $data)
<option data-href="{{ route('checkout-states-load',['id1'=>$data->id,'id2'=>2]) }}"  {{ isset($checkout_state_id)? ($checkout_state_id== $data->id ? 'selected' : '' ):(Auth::user()->state_id == $data->id ? 'selected' : '' ) }} value="{{ $data->name }}">{{ $data->name }}</option>
@endforeach
@endif
