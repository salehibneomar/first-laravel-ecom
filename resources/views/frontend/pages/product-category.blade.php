@extends('frontend.layout')

@section('pageTitle')
  {{ 'Category | '.$clickedCategoryName }}
@endsection

@section('content')

<div class="col-md-9" style="margin-bottom: 30px !important;"> 

    <div class="clearfix filters-container m-t-10">
      <div class="row">
        
        <!-- /.col -->
        <div class="col col-md-12">
          <form action="{{ url(URL::current()) }}" method="get" id="sort-and-filter">
            
          <div class="col col-sm-12 col-md-6 no-padding">
            <div class="lbl-cnt"> <span class="lbl">Sort by</span>
              <div class="fld inline">
                  <select name="orderBy" class="form-control unicase-form-control " id="orderBy">
                    <option value="" selected>Default</option>
                    @foreach ($orderValues as $key=> $value)
                      <option value="{{ $key }}" @if(!is_null($requestParam) && isset($requestParam['orderBy']) && $requestParam['orderBy']==$key) {{ 'selected' }} @endif >{{ $value }}</option>
                    @endforeach
                  </select>
              </div>
              <!-- /.fld --> 
            </div>
            <!-- /.lbl-cnt --> 
          </div>
          <!-- /.col -->
          <div class="col col-sm-12 col-md-6 no-padding">
            <div class="lbl-cnt"> <span class="lbl">Show</span>
              <div class="fld inline">
                <select name="limit" class="form-control unicase-form-control" id="limit">
                  <option value="" selected>Default</option>
                  @foreach ($limitValues as $key=> $values)
                    <option value="{{ $key }}" @if(!is_null($requestParam) && isset($requestParam['limit']) && $requestParam['limit']==$key ) {{ 'selected' }} @endif >{{ $values }}</option>
                  @endforeach
                </select>
              </div>
              <!-- /.fld --> 
            </div>
            <!-- /.lbl-cnt --> 
          </div>
          <!-- /.col --> 
          </form>
        </div>
        <!-- /.col -->
         
      </div>
      <!-- /.row --> 
    </div>

    <div class="search-result-container ">
      <div id="myTabContent" class="tab-content category-list">
        <div class="tab-pane active " id="grid-container">
          <div class="category-product">
            <div class="row">
            
                @foreach ($categoryProducts as $product)
                <div class="col-sm-6 col-md-4 wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="products">
                      <div class="product">
                        <div class="product-image">
                          <div class="image"> <a href="{{ route('frontend.product.details', ['id'=>$product->id, 'slug'=>$product->slug]) }}"><img src="{{ asset($product->image) }}" ></a> </div>
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
                                  {{ Str::limit($product->title, 25, '...') }}
                                </a>
                            </h3>
                          
                          <div class="description"></div>
                          <div class="product-price"> <span class="price"> ৳{{ number_format($product->price) }} </span> 
                            @if (!is_null($product->discount))
                            <span class="price-before-discount">
                              ৳ {{ number_format($product->price*($product->discount/100), 2) }}
                            </span>
                            &nbsp;
                            <sup class="text-success">( {{ $product->discount }}% OFF )</sup>
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
                              <li class="lnk wishlist"> <a class="add-to-cart" href="#" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                              <li class="lnk"> <a class="add-to-cart" href="#" title="Compare"> <i class="fa fa-signal"></i> </a> </li>
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
            <!-- /.row --> 
          </div>
          <!-- /.category-product --> 
          
        </div>
        <!-- /.tab-pane -->
        
        
      </div>
      <!-- /.tab-content -->
      <div class="clearfix filters-container">
        <div class="text-right">
          <div class="pagination-container">
            {{ $categoryProducts->links('vendor.pagination.custom') }}
            <!-- /.list-inline --> 
          </div>
          <!-- /.pagination-container --> </div>
        <!-- /.text-right --> 
        
      </div>
      <!-- /.filters-container --> 
      
    </div>
    <!-- /.search-result-container --> 
    
</div>

@endsection

@section('custom_scripts')
  <script>
    $('#orderBy').change(function(){
      $('#sort-and-filter').submit();
    });

    $('#limit').change(function(){
      $('#sort-and-filter').submit();
    });

  </script>
@endsection