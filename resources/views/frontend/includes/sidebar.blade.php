<div class="col-md-3 sidebar"> 
        
    <!-- ================================== TOP NAVIGATION ================================== -->
    <div class="side-menu animate-dropdown outer-bottom-xs">
      <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
      <nav class="yamm megamenu-horizontal">
        <ul class="nav">
          @foreach($menuCategories as $main)
          <li class="dropdown menu-item"> 
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              {{ $main->name }}
            </a>
            
              <ul class="dropdown-menu mega-menu">
                <li>
                  <div class="yamm-content ">
                    <div class="row">
                      @foreach ($main->subcategories as $sub)
                      <div class="col-sm-12 col-md-3">
                        <a href="{{ route('frontend.product.category', ['id'=>$sub->id, 'slug'=>$sub->slug]) }}" style="text-decoration: none !important; text-align:left !important; color:black !important; padding: 0 !important; margin: 0 0 10px 0 !important; font-weight: 700 !important;">{{ $sub->name }}</a>
                        
                        <ul class="links list-unstyled">
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
            
            <!-- /.dropdown-menu --> 
          </li>
          @endforeach
          <!-- /.menu-item -->
        </ul>
        <!-- /.nav --> 
      </nav>
      <!-- /.megamenu-horizontal --> 
    </div>
    <!-- /.side-menu --> 
    <!-- ================================== TOP NAVIGATION : END ================================== --> 
    
    <!-- ============================================== HOT DEALS ============================================== -->
    @if (!Request::is('product/category*', 'product/search*'))
    <div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
      <h3 class="section-title">Top Discounts</h3>
      <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">

        @foreach ($topDiscountProducts as $product)
        <div class="item">
          <div class="products">
            <div class="hot-deal-wrapper">
              <div class="image"> <img src="{{ asset($product->image) }}" alt=""></div>
              <div class="sale-offer-tag">
                <span>{{ $product->discount }}%<br>off</span>
              </div>
              
            </div>
            <!-- /.hot-deal-wrapper -->
            
            <div class="product-info text-left m-t-20">
              <h3 class="name"><a href="{{ route('frontend.product.details', ['id'=>$product->id, 'slug'=>$product->slug]) }}">{{ $product->title }}</a></h3>
              {{-- <div class="rating rateit-small"></div> --}}
              <div class="product-price"> 
                <span class="price">৳{{ number_format($product->price) }} </span> 
                @if (!is_null($product->discount))
                  <span class="price-before-discount">
                    ৳ {{ number_format($product->price*($product->discount/100), 2) }}
                  </span>
                @endif
              </div>
              <!-- /.product-price --> 
              
            </div>
            <!-- /.product-info -->
            
            <div class="cart clearfix animate-effect">
              <div class="action">
                <div class="btn-group">
                  <button class="btn btn-primary cart-btn" style="background: #fdd922; color:black;"> 
                    <i class="fa fa-shopping-cart"></i> 
                  </button>
                  <a href="{{ route('frontend.product.cart.add.fly', ['id'=>$product->id, 'slug'=>$product->slug]) }}" class="btn btn-primary cart-btn" type="button">Add to cart</a>
                </div>
              </div>
              <!-- /.action --> 
            </div>
            <!-- /.cart --> 
          </div>
        </div>
        @endforeach
        
      </div>
      <!-- /.sidebar-widget --> 
    </div>
    @endif
    <!-- ============================================== HOT DEALS: END ============================================== --> 
    
    @if (Request::is('product/category*'))
    <div class="sidebar-module-container" style="margin-bottom: 20px !important;">
      <div class="sidebar-filter">

        <div class="sidebar-widget wow fadeInUp">
          <h3 class="section-title">shop by</h3>
          <div class="widget-header">
            <h4 class="widget-title">Brand</h4>
          </div>
          <br>
          <div class="sidebar-widget-body">
            <div class="row">

              @foreach ($allBrandSidebar as $brand)
                  <div class="col-md-6">
                      <input type="checkbox" id="brand_{{ $brand->id }}" value="{{ $brand->id }}" name="brand[{{ $brand->id }}]" form="sort-and-filter" @if(!is_null($requestParam) && isset($requestParam['brand']) && array_key_exists($brand->id, $requestParam['brand'])) {{ 'checked' }} @endif >
                      <label for="brand_{{ $brand->id }}" >
                          {{ $brand->name }}
                      </label>
                  </div>
              @endforeach
            </div>
          </div>
        </div>

        <div class="sidebar-widget wow fadeInUp">
          <div class="widget-header">
            <h4 class="widget-title">Condition</h4>
          </div>
          <div class="sidebar-widget-body">
            <div class="form-group">
              <input type="radio" name="condition" id="all" value="" form="sort-and-filter" checked>
              <label for="all">All</label>&ensp;
                @foreach ($conditionValues as $key=> $value)
                  <input type="radio" name="condition" id="{{ $key }}" value="{{ $key }}" form="sort-and-filter" @if(!is_null($requestParam) && isset($requestParam['condition']) && $key==$requestParam['condition']) {{ 'checked' }} @endif >
                  <label for="{{ $key }}">{{ $value }}</label>&ensp;
                @endforeach
            </div>
            
          </div>
        </div>
      
        <div class="sidebar-widget wow fadeInUp">
          <div class="widget-header">
            <h4 class="widget-title">Price</h4>
          </div>
          <div class="sidebar-widget-body">
            <div class="form-group">
                <input type="text" name="price_from"  class="form-control" placeholder="From" form="sort-and-filter" value="@if(!is_null($requestParam) && isset($requestParam['price_from']) && is_numeric($requestParam['price_from'])){{$requestParam['price_from']}}@endif" min="1" placeholder="From">
            </div>
            <div class="form-group">
              <input type="text" name="price_to"  class="form-control" placeholder="To" form="sort-and-filter" min="1" value="@if(!is_null($requestParam) && isset($requestParam['price_to']) && is_numeric($requestParam['price_to'])){{$requestParam['price_to']}}@endif">
          </div>
          </div>
        </div>
      
        <div class="sidebar-widget wow fadeInUp">
          <div class="sidebar-widget-body">
            <div class="form-group">
                <button type="submit" class="btn btn-primary" form="sort-and-filter">Filter</button>
            </div>
          </div>
        </div>

      </div>

    </div>
    @endif

  </div>