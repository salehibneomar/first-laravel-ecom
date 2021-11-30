<header class="header-style-1"> 
  
    <!-- ============================================== TOP MENU ============================================== -->
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
    <!-- /.header-top --> 
    <!-- ============================================== TOP MENU : END ============================================== -->
    <div class="main-header">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-3 logo-holder"> 
            <!-- ============================================================= LOGO ============================================================= -->
            <div class="logo"> <a href="{{ url('/') }}"> <img src="{{ asset($siteSettings->logo) }}" alt="logo"> </a> </div>
            <!-- /.logo --> 
            <!-- ============================================================= LOGO : END ============================================================= --> </div>
          <!-- /.logo-holder -->
          
          <div class="col-xs-12 col-sm-12 col-md-6 top-search-holder"> 
            <!-- /.contact-row --> 
            <!-- ============================================================= SEARCH AREA ============================================================= -->
            <div class="search-area">
              <form action="{{ route('frontend.product.search') }}" method="GET">
                <div class="control-group">
                  <input name="q" class="search-field" placeholder="Product name..." required>
                  <button class="search-button" type="submit" ></button> 
                </div>
              </form>
            </div>
            <!-- /.search-area --> 
            <!-- ============================================================= SEARCH AREA : END ============================================================= --> </div>
          <!-- /.top-search-holder -->
          
          <div class="col-xs-12 col-sm-12 col-md-3 animate-dropdown top-cart-row"> 
            <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
            
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
            <!-- /.dropdown-cart --> 
            
            <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= --> 
          </div>
          <!-- /.top-cart-row --> 
        </div>
        <!-- /.row --> 
        
      </div>
      <!-- /.container --> 
      
    </div>
    <!-- /.main-header --> 
    
    <!-- ============================================== NAVBAR ============================================== -->
    @if (!Request::is('login', 'register', 'account*'))
    <div class="header-nav animate-dropdown">
      <div class="container">
        <div class="yamm navbar navbar-default" role="navigation">
          <div class="navbar-header">
         <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> 
         <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
          </div>
          <div class="nav-bg-class">
            <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
              <div class="nav-outer">
                <ul class="nav navbar-nav">
                  <li class="@if (Request::routeIs('page.landing')) {{ 'active' }} @endif dropdown yamm-fw">
                    <a href="{{ route('page.landing') }}" >Home
                    </a> 
                  </li>

                  @foreach ($menuCategories as $main)
                  <li class="dropdown yamm mega-menu"> 
                    <a href="javascript:void(0)" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">
                      {{ $main->name }}
                    </a>

                    <ul class="dropdown-menu container">
                      <li>
                        <div class="yamm-content ">
                          <div class="row">
                            @foreach ($main->subcategories as $sub)
                            <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                              <a href="{{ route('frontend.product.category', ['id'=>$sub->id, 'slug'=>$sub->slug]) }}" style="text-decoration: none !important; text-align:left !important; color:black !important; padding: 0 !important; margin: 0 0 10px 0 !important; font-weight: 700 !important;">{{ $sub->name }}</a>
                              
                              <ul class="links">
                                @foreach($sub->subcategories as $subsub)
                                <li><a href="{{ route('frontend.product.category', ['id'=>$subsub->id, 'slug'=>$subsub->slug]) }}">{{ $subsub->name }}</a></li>
                                @endforeach
                              </ul>
                              
                            </div>
                            <!-- /.col -->
                            @endforeach
                            <!-- /.yamm-content --> 
                          </div>
                        </div>
                      </li>
                    </ul>

                  </li>
                  @endforeach


                  
                  
                  {{-- <li class="dropdown  navbar-right special-menu"> <a href="#">Todays offer</a> </li> --}}
                </ul>
                <!-- /.navbar-nav -->
                <div class="clearfix"></div>
              </div>
              <!-- /.nav-outer --> 
            </div>
            <!-- /.navbar-collapse --> 
            
          </div>
          <!-- /.nav-bg-class --> 
        </div>
        <!-- /.navbar-default --> 
      </div>
      <!-- /.container-class --> 
      
    </div>
    @endif

    <!-- /.header-nav --> 
    <!-- ============================================== NAVBAR : END ============================================== --> 
    
  </header>