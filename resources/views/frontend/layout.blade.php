<!DOCTYPE html>
<html lang="en">

@php
  $siteSettings = siteSettings();
@endphp

<head>
    @include('frontend.includes.head')
</head>

<body class="cnt-home">
<!--  HEADER  -->
    @include('frontend.includes.nav')
<!--  HEADER : END  -->

<div class="body-content outer-top-xs" id="top-banner-and-menu">
  <div class="container">
    <div class="row"> 
      <!-- ============================================== SIDEBAR ============================================== -->
      @if(!Request::is('login', 'register', 'account*', 'product/cart/all*', 'product/checkout*'))
      @include('frontend.includes.sidebar')
      @endif
      <!-- /.sidemenu-holder --> 
      <!-- ============================================== SIDEBAR : END ============================================== --> 
      
      <!-- ============================================== CONTENT ============================================== -->
      @yield('content')
      <!-- /.homebanner-holder --> 
      <!-- ============================================== CONTENT : END ============================================== --> 
    </div>
    <!-- /.row --> 

      @if(Request::routeIs('page.landing'))
          @include('frontend.includes.bottom-brands')
      @endif


  </div>
  <!-- /.container --> 
</div>
<!-- /#top-banner-and-menu --> 

<!--  FOOTER  -->
    @include('frontend.includes.footer')


<!-- JavaScripts placed at the end of the document so the pages load faster --> 
    @include('frontend.includes.script')
    @yield('custom_scripts')

</body>
</html>