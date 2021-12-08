<option value="">{{ $langg->lang157 }}</option>
@if(Auth::check())
	@foreach (DB::table('countries')->get() as $data)
	<option data-href="{{ route('checkout-states-load',['id1'=>$data->id,'id2'=>1]) }}"  value="{{ $data->name }}" {{ isset($checkout_country_id)? ($checkout_country_id== $data->id ? 'selected' : '' ):(Auth::user()->country_id == $data->id ? 'selected' : '' ) }}>{{ $data->name }}</option>		
	@endforeach
@else
	@foreach (DB::table('countries')->get() as $data)
	<option data-href="{{ route('checkout-states-load',['id1'=>$data->id,'id2'=>1]) }}" value="{{ $data->name }}" 
		{{ isset($checkout_country_id)? ($checkout_country_id== $data->id ? 'selected' : '' ):'' }}>{{ $data->name }}</option>		
	@endforeach
@endif

