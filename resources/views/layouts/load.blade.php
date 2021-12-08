@yield('styles')
 <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
	$('.nic-edit-p,.nic-edit').summernote({
      height: 200,})
</script>
@yield('content')

<script src="{{asset('assets/admin/js/vendors/jquery-1.12.4.min.js')}}"></script>
		<script src="{{asset('assets/admin/js/jqueryui.min.js')}}"></script>
<script src="{{asset('assets/admin/js/vendors/vue.js')}}"></script>
<script src="{{asset('assets/admin/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{asset('assets/admin/js/plugin.js')}}"></script>
<script src="{{asset('assets/admin/js/tag-it.js')}}"></script>
<script src="{{asset('assets/admin/js/load.js')}}"></script>


@yield('scripts')
