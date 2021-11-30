
    <script src="{{ asset('backend/login/js/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/login/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
      toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "100",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1200",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }
      
      @if ($errors->any())
        @foreach ($errors->all() as $error)
          toastr.warning("{{$error}}");
        @endforeach
      @endif

      @if(session('failed'))
      toastr.error("{{session('failed')}}");
      @endif

    </script>

  </body>
</html>