@extends('frontend.layout')

@section('pageTitle')
  {{ 'Details | '.$product->title }}
@endsection

@section('content')


<div class="col-md-9 single-product">
    <div class="detail-block">
        <div class="row  wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
        
                 <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
<div class="product-item-holder size-big single-product-gallery small-gallery">

<div id="owl-single-product" class="owl-carousel owl-theme" style="opacity: 1; display: block;">
    
    <div class="owl-wrapper-outer">
        <div class="owl-wrapper" style="width: 5742px; left: 0px; display: block; transition: all 0ms ease 0s; transform: translate3d(0px, 0px, 0px);">
            <div class="owl-item" style="width: 319px;">
                <div class="single-product-gallery-item" id="slide1">
                    <a data-lightbox="image-1" data-title="Gallery" href="{{ asset($product->image) }}">
                        <img class="img-responsive" alt="" src="{{ asset($product->image) }}" style="max-width: 100% !important; min-width: 100% !important;">
                    </a>
                </div>
            </div>

        </div>
    </div>
    <!-- /.single-product-gallery-item -->




</div><!-- /.single-product-slider -->




</div><!-- /.single-product-gallery -->
</div><!-- /.gallery-holder -->        			
            <div class="col-sm-6 col-md-7 product-info-block">
                <div class="product-info">
                    <h1 class="name">{{ $product->title }}</h1>

                    <div class="stock-container info-container m-t-10">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="stock-box">
                                    <span class="label">Availability :</span>
                                </div>	
                            </div>
                            <div class="col-sm-9">
                                <div class="stock-box">
                                    @if ($product->quantity>0)
                                    <span class="value" style="color: green !important;">In Stock
                                    </span>
                                    @else
                                    <span class="value">
                                        @if($product->status==2)
                                            {{ 'Discontinued' }}
                                        @else
                                        Out Of Stock    
                                        @endif
                                    </span>
                                    @endif
                                </div>	
                            </div>
                        </div><!-- /.row -->	
                    </div><!-- /.stock-container -->

                    <div class="description-container m-t-20">
                        {{ $product->short_description }}
                    </div><!-- /.description-container -->

                    <div class="price-container info-container m-t-20">
                        <div class="row">
                            

                            <div class="col-sm-12">
                                <div class="price-box">
                                    <span class="price">
                                        ৳{{ number_format($product->price) }}
                                    </span>
                                    &ensp;
                                    @if (!is_null($product->discount))
                                    <span class="price-strike">
                                      ৳ {{ number_format($product->price*($product->discount/100), 2) }}
                                    </span>
                                    &ensp;
                                    <small class="text-success">( {{ $product->discount }}% OFF )</small>
                                    @endif 
                                </div>
                            </div>

                            

                        </div><!-- /.row -->
                    </div><!-- /.price-container -->

                    <div class="quantity-container info-container">
                        <div class="row">
                            <form action="{{ route('frontend.product.cart.add', ['id'=>$product->id]) }}" method="POST">
                                @csrf
                            <div class="col-sm-2">
                                <span class="label">Qty :</span>
                            </div>
                            
                            <div class="col-sm-4">
                                <div class="cart-quantity">
                                    <div class="quant-input">
                                        <input type="number" min="1" max="10" value="1" class="form-control" name="qty">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</button>
                            </div>

                            </form>
                        </div><!-- /.row -->
                    </div><!-- /.quantity-container -->

                    

                    

                    
                </div><!-- /.product-info -->
            </div><!-- /.col-sm-7 -->
        </div><!-- /.row -->
        </div>
        
        <div class="product-tabs inner-bottom-xs  wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
            <div class="row">
                <div class="col-sm-3">
                    <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                        <li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
                        {{-- <li><a data-toggle="tab" href="#review">REVIEW</a></li> --}}
                    </ul><!-- /.nav-tabs #product-tabs -->
                </div>
                <div class="col-sm-9">

                    <div class="tab-content">
                        
                        <div id="description" class="tab-pane in active">
                            <div class="product-tab">
                                <p class="text">
                                    {{ $product->long_description }}
                                </p>
                            </div>	
                        </div><!-- /.tab-pane -->

                        

                    </div><!-- /.tab-content -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.product-tabs -->

    
    </div><!-- /.col -->
    <div class="clearfix"></div>

@endsection