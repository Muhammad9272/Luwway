<option selected="" disabled="" value="">Select State</option>
@foreach($country->states as $state)
<option  value="{{ $state->id }}">{{ $state->name }}</option>
@endforeach
