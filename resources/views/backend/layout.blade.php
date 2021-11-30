<!DOCTYPE html>
<html lang="en">
  @php
    $siteSettings = siteSettings();
  @endphp
  <head>
    @include('backend.includes.head')
  </head>

<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">
	
<div class="wrapper">

	<!--Navbar-->
    @include('backend.includes.navbar')
	<!--/Navbar-->
  
  <!-- Left side column. contains the logo and sidebar -->
    @include('backend.includes.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">

		<!-- Main content -->
		<section class="content">
			<div class="row">
				@yield('content')
			</div>
		</section>
		<!-- /.content -->
	  </div>
  </div>
  <!-- /.content-wrapper -->

  <!-- mainfooter-->
    @include('backend.includes.footer')
  <!-- mainfooter-->



</div>
<!-- ./wrapper -->
  	
	<!--Scripts-->	 
    @include('backend.includes.script')
    @yield('extraScripts')

</body>
</html>
