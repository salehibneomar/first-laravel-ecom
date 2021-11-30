@extends('frontend.layout')

@section('pageTitle')
  {{ 'Home' }}
@endsection

@section('content')

      <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder"> 
        <!-- ========================================== SECTION – HERO ========================================= -->
        
        <div id="hero">
          <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
            @foreach ($bannerSlider as $slider)
            <div class="item" style="background-image: url( {{ asset($slider->image) }} );">
              <div class="container-fluid">
                <div class="caption bg-color vertical-center text-left">
                  @if (!is_null($slider->short_note))
                    <div class="slider-header fadeInDown-1">
                      {{ $slider->short_note }}
                    </div>
                  @endif
                  <div class="big-text fadeInDown-1"> 
                    {{ $slider->normal_title }} 
                    @if (!is_null($slider->colored_title))
                      <span class="highlight">{{ $slider->colored_title }}</span>
                    @endif
                  </div>
                  @if (!is_null($slider->short_description))
                    <div class="excerpt fadeInDown-2 hidden-xs"> 
                      <span>
                        {{ $slider->short_description }}
                      </span> 
                    </div>
                  @endif
                  {{-- <div class="button-holder fadeInDown-3"> 
                    <a href="index.php?page=single-product" class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop Now
                    </a> 
                  </div> --}}
                </div>
                <!-- /.caption --> 
              </div>
              <!-- /.container-fluid --> 
            </div>
            @endforeach
            <!-- /.item -->
          </div>
          <!-- /.owl-carousel --> 
        </div>
        
        <!-- ========================================= SECTION – HERO : END ========================================= --> 
        
        <!-- ============================================== INFO BOXES ============================================== -->
        <div class="info-boxes wow fadeInUp">
          <div class="info-boxes-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="info-box">
                  <div class="row">
                    <div class="col-xs-12">
                      <h4 class="info-box-heading green">Promos</h4>
                    </div>
                  </div>
                  <h6 class="text">Goes Here</h6>
                </div>
              </div>
            </div>
            <!-- /.row --> 
          </div>
          <!-- /.info-boxes-inner --> 
          
        </div>
        <!-- /.info-boxes --> 
        <!-- ============================================== INFO BOXES : END ============================================== --> 
        <!-- ============================================== SCROLL TABS ============================================== -->
        <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
          <div class="more-info-tab clearfix ">
            <h3 class="new-product-title pull-left">New Products</h3>
            <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">

              <li class="active">
                <a data-transition-type="backSlide" href="#all" data-toggle="tab">
                  All
                </a>
              </li>

              
              @foreach ($menuCategories as $category)
              <li>
                <a data-transition-type="backSlide" href="#{{ $category->name }}" data-toggle="tab">
                  {{ $category->name }}
                </a>
              </li>
              @endforeach
            </ul>
            <!-- /.nav-tabs --> 
          </div>
          <div class="tab-content outer-top-xs">
            <div class="tab-pane in active" id="all">
              <div class="product-slider">
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                  @foreach ($newProducts as $product)
                  <div class="item item-carousel">
                    <div class="products">
                      <div class="product">
                        <div class="product-image">
                          <div class="image"> 
                            <a href="{{ route('frontend.product.details', ['id'=>$product->id, 'slug'=>$product->slug]) }}">
                            <img  src="{{ asset($product->image) }}" alt=""></a> 
                          </div>
                          <!-- /.image -->
                          
                          @if ($product->condition!='normal')
                          <div class="tag {{ $product->condition }}">
                            <span>{{ $product->condition }}</span>
                          </div>
                          @endif
                        </div>
                        <!-- /.product-image -->
                        
                        <div class="product-info text-left">
                          <h3 class="name">
                            <a href="{{ route('frontend.product.details', ['id'=>$product->id, 'slug'=>$product->slug]) }}">
                              {{ $product->title }}
                            </a>
                          </h3>
                          {{-- <div class="rating rateit-small"></div> --}}
                          <div class="description"></div>
                          <div class="product-price"> 
                            <span class="price"> ৳{{ number_format($product->price) }} </span> 
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
                            <ul class="list-unstyled">
                              <li class="add-cart-button btn-group">
                                <a href="{{ route('frontend.product.cart.add.fly', ['id'=>$product->id, 'slug'=>$product->slug]) }}" data-toggle="tooltip" class="btn btn-primary icon"  title="Add Cart"> 
                                  <i class="fa fa-shopping-cart"></i> 
                                </a>
                              </li>
                              <li class="lnk wishlist"> <a data-toggle="tooltip" class="add-to-cart" href="#" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> 
                              </li>
                              <li class="lnk"> <a data-toggle="tooltip" class="add-to-cart" href="#" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> 
                              </li>
                            </ul>
                          </div>
                          <!-- /.action --> 
                        </div>
                        <!-- /.cart --> 
                      </div>
                      <!-- /.product --> 
                      
                    </div>
                    <!-- /.products --> 
                  </div>
                  <!-- /.item -->
                  @endforeach
                </div>
                <!-- /.home-owl-carousel --> 
              </div>
              <!-- /.product-slider --> 
            </div>
            <!-- /.tab-pane -->
            
            @foreach ($menuCategories as $category)
            <div class="tab-pane" id="{{$category->name}}">
              <div class="product-slider">
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">

                  @foreach ($newProducts as $product)

                    @php
                      $topCategoryId = $product->category_id;
                      if(!is_null($product->category->parent)){
                        $topCategoryId = $product->category->parent->id;
                        if(!is_null($product->category->parent->parent)){
                          $topCategoryId = $product->category->parent->parent->id;
                        }
                      }
                    @endphp

                    @if ($topCategoryId==$category->id)
                      <div class="item item-carousel">
                        <div class="products">
                          <div class="product">
                            <div class="product-image">
                              <div class="image"> 
                                <a href="{{ route('frontend.product.details', ['id'=>$product->id, 'slug'=>$product->slug]) }}">
                                <img  src="{{ asset($product->image) }}" alt=""></a> 
                              </div>
                              <!-- /.image -->
                              
                              @if ($product->condition!='normal')
                              <div class="tag {{ $product->condition }}">
                                <span>{{ $product->condition }}</span>
                              </div>
                              @endif
                            </div>
                            <!-- /.product-image -->
                            
                            <div class="product-info text-left">
                              <h3 class="name">
                                <a href="{{ route('frontend.product.details', ['id'=>$product->id, 'slug'=>$product->slug]) }}">
                                  {{ $product->title }}
                                </a>
                              </h3>
                              {{-- <div class="rating rateit-small"></div> --}}
                              <div class="description"></div>
                              <div class="product-price"> 
                                <span class="price"> ৳{{ number_format($product->price) }} </span> 
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
                                <ul class="list-unstyled">
                                  <li class="add-cart-button btn-group">
                                    <a href="{{ route('frontend.product.cart.add.fly', ['id'=>$product->id, 'slug'=>$product->slug]) }}" data-toggle="tooltip" class="btn btn-primary icon"  title="Add Cart"> 
                                      <i class="fa fa-shopping-cart"></i> 
                                    </a>
                                  </li>
                                  <li class="lnk wishlist"> 
                                    <a data-toggle="tooltip" class="add-to-cart" href="#" title="Wishlist"> <i class="icon fa fa-heart"></i> 
                                    </a> 
                                  </li>
                                  <li class="lnk"> 
                                    <a data-toggle="tooltip" class="add-to-cart" href="#" title="Compare"> 
                                      <i class="fa fa-signal" aria-hidden="true"></i>
                                    </a> 
                                  </li>
                                </ul>
                              </div>
                              <!-- /.action --> 
                            </div>
                            <!-- /.cart --> 
                          </div>
                          <!-- /.product --> 
                          
                        </div>
                        <!-- /.products --> 
                      </div>
                    @endif
                    
                  @endforeach
                  
                  <!-- /.item -->

                </div>
                <!-- /.home-owl-carousel --> 
              </div>
              <!-- /.product-slider --> 
            </div>
            @endforeach
            

            <!-- /.tab-pane --> 
            
          </div>
          <!-- /.tab-content --> 
        </div>
        <!-- /.scroll-tabs --> 
        <!-- ============================================== SCROLL TABS : END ============================================== --> 

        
        <!-- ============================================== WIDE PRODUCTS : END ============================================== --> 
        <!-- ============================================== FEATURED PRODUCTS ============================================== -->
        <section class="section featured-product wow fadeInUp">
          <h3 class="section-title">Featured products</h3>
          <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
            
            @foreach ($featuredProducts as $product)
            <div class="item item-carousel">
              <div class="products">
                <div class="product">
                  <div class="product-image">
                    <div class="image"> 
                      <a href="{{ route('frontend.product.details', ['id'=>$product->id, 'slug'=>$product->slug]) }}">
                      <img  src="{{ asset($product->image) }}" alt=""></a> 
                    </div>
                    <!-- /.image -->
                    
                    @if ($product->condition!='normal')
                    <div class="tag {{ $product->condition }}">
                      <span>{{ $product->condition }}</span>
                    </div>
                    @endif
                  </div>
                  <!-- /.product-image -->
                  
                  <div class="product-info text-left">
                    <h3 class="name">
                      <a href="{{ route('frontend.product.details', ['id'=>$product->id, 'slug'=>$product->slug]) }}">
                        {{ $product->title }}
                      </a>
                    </h3>
                    {{-- <div class="rating rateit-small"></div> --}}
                    <div class="description"></div>
                    <div class="product-price"> 
                      <span class="price"> ৳{{ number_format($product->price) }} </span> 
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
                      <ul class="list-unstyled">
                        <li class="add-cart-button btn-group">
                          <a href="{{ route('frontend.product.cart.add.fly', ['id'=>$product->id, 'slug'=>$product->slug]) }}" data-toggle="tooltip" class="btn btn-primary icon"  title="Add Cart"> 
                            <i class="fa fa-shopping-cart"></i> 
                          </a>
                        </li>
                        <li class="lnk wishlist"> 
                          <a data-toggle="tooltip" class="add-to-cart" href="#" title="Wishlist"> <i class="icon fa fa-heart"></i> 
                          </a> 
                        </li>
                        <li class="lnk"> 
                          <a data-toggle="tooltip" class="add-to-cart" href="#" title="Compare"> 
                            <i class="fa fa-signal" aria-hidden="true"></i> 
                          </a> 
                        </li>
                      </ul>
                    </div>
                    <!-- /.action --> 
                  </div>
                  <!-- /.cart --> 
                </div>
                <!-- /.product --> 
                
              </div>
              <!-- /.products --> 
            </div>
            @endforeach

          </div>
          <!-- /.home-owl-carousel --> 
        </section>
        <!-- /.section --> 
        <!-- ============================================== FEATURED PRODUCTS : END ============================================== --> 

        <!-- ============================================== BEST SELLER ============================================== -->
        
        <div class="best-deal wow fadeInUp outer-bottom-xs">
          <h3 class="section-title">Best seller</h3>
          <div class="sidebar-widget-body outer-top-xs">
            <div class="owl-carousel best-seller custom-carousel owl-theme outer-top-xs">
              @foreach ($bestSellers as $item)
              <div class="item">
                <div class="products best-product">
                  <div class="product">
                    <div class="product-image">
                      <div class="image"> 
                        <a href="{{ route('frontend.product.details', ['id'=>$item->product->id, 'slug'=>$item->product->slug]) }}">
                        <img  src="{{ asset($item->product->image) }}" alt=""></a> 
                      </div>
                      <!-- /.image -->
                      
                      @if ($item->product->condition!='normal')
                      <div class="tag {{ $item->product->condition }}">
                        <span>{{ $item->product->condition }}</span>
                      </div>
                      @endif
                    </div>
                    <!-- /.product-image -->
                    
                    <div class="product-info text-left">
                      <h3 class="name">
                        <a href="{{ route('frontend.product.details', ['id'=>$item->product->id, 'slug'=>$item->product->slug]) }}">
                          {{ $item->product->title }}
                        </a>
                      </h3>
                      {{-- <div class="rating rateit-small"></div> --}}
                      <div class="description"></div>
                      <div class="product-price"> 
                        <span class="price"> ৳{{ number_format($item->product->price) }} </span> 
                        @if (!is_null($item->product->discount))
                        <span class="price-before-discount">
                          ৳ {{ number_format($item->product->price*($item->product->discount/100), 2) }}
                        </span>
                        @endif 
                      </div>
                      <!-- /.product-price --> 
                      
                    </div>
                    <!-- /.product-info -->
                    <div class="cart clearfix animate-effect">
                      <div class="action">
                        <ul class="list-unstyled">
                          <li class="add-cart-button btn-group">
                            <a href="{{ route('frontend.product.cart.add.fly', ['id'=>$item->product->id, 'slug'=>$item->product->slug]) }}" data-toggle="tooltip" class="btn btn-primary icon"  title="Add Cart"> 
                              <i class="fa fa-shopping-cart"></i> 
                            </a>
                          </li>
                          <li class="lnk wishlist"> 
                            <a data-toggle="tooltip" class="add-to-cart" href="#" title="Wishlist"> <i class="icon fa fa-heart"></i> 
                            </a> 
                          </li>
                          <li class="lnk"> 
                            <a data-toggle="tooltip" class="add-to-cart" href="#" title="Compare"> 
                              <i class="fa fa-signal" aria-hidden="true"></i> 
                            </a> 
                          </li>
                        </ul>
                      </div>
                      <!-- /.action --> 
                    </div>
                    <!-- /.cart --> 
                  </div>
                  <!-- /.product --> 
                  
                </div>
                <!-- /.products --> 
              </div>
              @endforeach
              
            </div>
          </div>
          <!-- /.sidebar-widget-body --> 
        </div>
        <!-- /.sidebar-widget --> 
        <!-- ============================================== BEST SELLER : END ============================================== --> 
        
        <!-- ============================================== BLOG SLIDER ============================================== -->

        <!-- ============================================== BLOG SLIDER : END ============================================== --> 
        
      </div>

@endsection