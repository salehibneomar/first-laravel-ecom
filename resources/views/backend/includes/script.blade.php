	<!-- Vendor JS -->
	<script src="{{ asset('backend/theme/js/vendors.min.js') }}"></script>
    <script src="{{ asset('backend/assets/icons/feather-icons/feather.min.js') }}"></script>	
	<script src="{{ asset('backend/assets/vendor_components/easypiechart/dist/jquery.easypiechart.js') }}"></script>
	<script src="{{ asset('backend/assets/vendor_components/apexcharts-bundle/irregular-data-series.js') }}"></script>
	<script src="{{ asset('backend/assets/vendor_components/apexcharts-bundle/dist/apexcharts.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	<script src="{{ asset('backend/assets/vendor_components/datatable/datatables.min.js') }}"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- Sunny Admin App -->
	<script src="{{ asset('backend/theme/js/template.js') }}"></script>
	<script src="{{ asset('backend/theme/js/pages/dashboard.js') }}"></script>
	<script>
		toastr.options = {
			"closeButton": true,
			"debug": false,
			"newestOnTop": false,
			"progressBar": true,
			"positionClass": "toast-bottom-right",
			"preventDuplicates": true,
			"onclick": null,
			"showDuration": "500",
			"hideDuration": "1000",
			"timeOut": "15000",
			"extendedTimeOut": "1500",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		}

		@if($errors->any())
			@foreach ($errors->all() as $error)
				toastr.warning('{{ $error }}')
			@endforeach
		@endif

		@if(session('alertMsg'))
			@switch(session('alertType'))
				@case('info')
					toastr.info('{{ session('alertMsg') }}')
					@break
				@case('success')
					toastr.success('{{ session('alertMsg') }}')
					@break
				@default
					toastr.error('{{ session('alertMsg') }}')
			@endswitch
		@endif

	</script>