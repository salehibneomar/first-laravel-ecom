@include('auth.admin.includes.header')

<div class="d-flex align-items-center justify-content-center ht-100v">

    <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-br-primary rounded bd bd-white-1" style="background-color: #272E48 !important; border-radius: 15px !important;">
      <div class="signin-logo tx-center tx-28 tx-bold tx-white"><span class="tx-normal"></span> Admin <span class="tx-info" style="color: #845ae6 !important;">Login</span> <span class="tx-normal"></span></div>
      <div class="tx-center mg-b-35"></div>

        @yield('content')

    </div><!-- login-wrapper -->
  </div><!-- d-flex -->

@include('auth.admin.includes.footer')