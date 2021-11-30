<!DOCTYPE html>
<html lang="en">
  @php
  $siteSettings = siteSettings();
@endphp
    <head>
        <!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="">
<meta name="author" content="">
<meta name="keywords" content="MediaCenter, Template, eCommerce">
<meta name="robots" content="all">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>Flipmart | 404</title>

<!-- Bootstrap Core CSS -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
<!-- Toastr -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

<!-- Customizable CSS -->
<link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/blue.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.transitions.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/rateit.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap-select.min.css') }}">
<link href="{{ asset('frontend/assets/css/lightbox.css') }}" rel="stylesheet">

<!-- Icons/Glyphs -->
<link rel="stylesheet" href="{{ asset('frontend/assets/css/font-awesome.css') }}">

<!-- Fonts -->
<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    </head>

    <body class="cnt-home">

<header class="header-style-1">

    <div class="top-bar animate-dropdown">
        <div class="container">
          <div class="header-top-inner">
            <div class="cnt-account">
              <ul class="list-unstyled">
                @auth('web')
                <li>
                  <a href="{{ route('account.show') }}"><i class="icon fa fa-user"></i>Account</a>
                </li>
                @else
                <li>
                  <a href="{{ route('login') }}">
                    <i class="icon fa fa-lock"></i>Login
                  </a>
                  &ensp;<span style="color: white !important;">/</span>&ensp;
                  <a href="{{ route('register') }}">
                    Register
                  </a>
                </li>  
                @endauth
  
              </ul>
            </div>
            <!-- /.cnt-account -->
            
            
            <!-- /.cnt-cart -->
            <div class="clearfix"></div>
          </div>
          <!-- /.header-top-inner --> 
        </div>
        <!-- /.container --> 
      </div>

	<div class="main-header">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-3 logo-holder">

<div class="logo">
	<a href="{{ url('/') }}">
		
		<img src="{{ asset('frontend/assets/images/logo.png')}} " alt="">

	</a>
</div><!-- /.logo -->
			</div><!-- /.logo-holder -->

				<div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
					<!-- /.contact-row -->

<div class="search-area">
    <form>
        <div class="control-group">

            <input class="search-field" placeholder="Search here..." />

            <a class="search-button" href="#" ></a>    

        </div>
    </form>
</div><!-- /.search-area -->
			</div><!-- /.top-search-holder -->

    <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">

        <div class="dropdown dropdown-cart"> <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
            <div class="items-cart-inner">
              <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> 
              </div>
              <div class="basket-item-count"><span class="count">{{ Cart::count() }}</span></div>
              <div class="total-price-basket"> <span class="lbl"></span> <span class="total-price"> <span class="sign">৳ </span><span class="value">{{ Cart::total(1) }}</span> </span> </div>
            </div>
            </a>
            <ul class="dropdown-menu">
              @if (Cart::count()>0)
              <li>
                @foreach (Cart::content() as $cartItem)
                  <div class="cart-item product-summary">
                    <div class="row">
                      <div class="col-xs-4">
                        <div class="image"> <a href="{{ route('frontend.product.details', ['id'=>$cartItem->id, 'slug'=>$cartItem->options->slug]) }}"><img src="{{ asset($cartItem->options->image) }}"></a> </div>
                      </div>
                      <div class="col-xs-7">
                        <h3 class="name"><a href="{{ route('frontend.product.details', ['id'=>$cartItem->id, 'slug'=>$cartItem->options->slug]) }}">{{ $cartItem->name }}</a></h3>
                        <div class="price">৳{{ number_format($cartItem->price) }}
                          <small> {{ "(x".$cartItem->qty.")" }}</small>
                        </div>
                      </div>
                      <div class="col-xs-1 action"> <a href="{{ route('frontend.product.cart.remove', ['rowId'=>$cartItem->rowId]) }}"><i class="fa fa-trash"></i></a> </div>
                    </div>
                  </div>
                  <!-- /.cart-item -->
                @endforeach
                
                <div class="clearfix"></div>
                <hr>
                <div class="clearfix cart-total">
                  <div class="pull-right"> <span class="text">Sub Total :</span><span class='price'>৳{{ Cart::total(1) }}</span> </div>
                  <div class="clearfix"></div>
                  <a href="{{ route('frontend.product.cart.all') }}" class="btn btn-upper btn-primary btn-block m-t-20">View Cart</a> 
                </div>
                <!-- /.cart-total--> 
                
              </li>
              @else
              <li class="text-center">Cart is empty!</li>
              @endif
            </ul>
            <!-- /.dropdown-menu--> 
          </div>

	
			</div><!-- /.top-cart-row -->
			</div><!-- /.row -->

		</div><!-- /.container -->

	</div><!-- /.main-header -->



</header>

<div class="body-content outer-top-bd">
	<div class="container">
		<div class="x-page inner-bottom-sm">
			<div class="row">
				<div class="col-md-12 x-text text-center">
					<h1>404</h1>
					<p>We are sorry, the page you've requested is not available. </p>
				</div>
			</div><!-- /.row -->
		</div><!-- /.sigin-in-->
	</div><!-- /.container -->
</div><!-- /.body-content -->


    @include('frontend.includes.footer')


	@include('frontend.includes.script')
	
</body>
</html>
