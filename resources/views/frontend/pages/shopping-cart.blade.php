@extends('frontend.layout')

@section('pageTitle')
  {{ 'Cart' }}
@endsection

@section('content')

<div class="shopping-cart" style="margin-bottom: 30px !important;">
  <div class="shopping-cart-table ">
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th class="cart-description item">Image</th>
        <th class="cart-product-name item">Product Name</th>
        <th class="cart-qty item">Qty</th>
        <th class="cart-total item">Total</th>
        <th class="cart-edit item">Edit</th>
        <th class="cart-romove last-item">Remove</th>
      </tr>
    </thead><!-- /thead -->
    
    <tbody>
      
      @foreach (Cart::content() as $cartItem)
      <tr>
        <td class="cart-image">
          <a class="entry-thumbnail" href="{{ route('frontend.product.details', ['id'=>$cartItem->id, 'slug'=>$cartItem->options->slug]) }}">
              <img src="{{ asset($cartItem->options->image) }}" >
          </a>
        </td>
        <td class="cart-product-name-info">
          <h4 class='cart-product-description'>
            <a href="{{ route('frontend.product.details', ['id'=>$cartItem->id, 'slug'=>$cartItem->options->slug]) }}">{{ $cartItem->name }}
            </a>
          </h4>

          <div class="cart-product-info">
            <span class="product-color">
              Unit Price:
              <span>
                ৳ {{ number_format($cartItem->price) }}
                @if (!is_null($cartItem->options->discount))
                  <small class="text-danger">({{ $cartItem->options->discount }}% OFF)</small>
                @endif
              </span>
            </span>
          </div>
          <div class="cart-product-info">
            <span class="product-color">
              Quantity:<span>{{ $cartItem->qty }}</span>
            </span>
          </div>
          
        </td>
        
        <td class="cart-product-quantity">
          <span class="form-text">Insert Qty</span>
          <form action="{{ route('frontend.product.cart.update', ['rowId'=>$cartItem->rowId]) }}" method="post" id="form_{{ $cartItem->rowId }}" >
            @csrf
            <div class="quant-input">
              <input type="hidden" name="rowId" value="{{ $cartItem->rowId }}" readonly>
              <input type="number" name="qty" class="form-control" min="1" max="{{ 10-((int)$cartItem->qty) }}" @if($cartItem->qty>=10) {{ 'disabled' }} @endif >
           </div>
          </form>
        </td>
        <td class="cart-product-grand-total">
          <span class="cart-grand-total-price">
            ৳{{ number_format($cartItem->price*$cartItem->qty, 1) }}
          </span>
        </td>
        <td class="cart-product-edit">
          <button class="btn btn-primary" form="form_{{ $cartItem->rowId }}"  @if($cartItem->qty>=10) {{ 'disabled' }} @endif>
            <i class="fa fa-refresh"></i>
          </button>
        </td>
        <td class="romove-item text-danger">
          <a href="{{ route('frontend.product.cart.remove', ['rowId'=>$cartItem->rowId]) }}" title="cancel" class="icon"><i class="fa fa-trash-o"></i>
          </a>
        </td>
      </tr>
      @endforeach
      
    </tbody><!-- /tbody -->

  </table><!-- /table -->
  
</div>
</div><!-- /.shopping-cart-table -->

<div class="col-sm-12 col-md-12 cart-shopping-total">
  <table class="table">
    <thead>
      <tr>
        <th>
          <div class="cart-sub-total">
            Initial Price<span class="inner-left-md">৳{{ Cart::initial(2) }}</span>
          </div>
          <div class="cart-grand-total">
            Discount Amount<span class="inner-left-md">৳{{ Cart::discount(2) }}</span>
          </div>
          <div class="cart-sub-total" style="margin-top: 8px;">
            Sub Total<span class="inner-left-md">৳{{ Cart::total(2) }}</span>
          </div>
        </th>
      </tr>
    </thead><!-- /thead -->
    <tbody>
      <tr>
        <td>
          <div class="cart-checkout-btn pull-right" >
            <a href="{{ route('frontend.product.checkout.online') }}" type="submit" class="btn btn-primary checkout-btn"><i class="fa fa-credit-card-alt" aria-hidden="true"></i>&ensp;ONLINE PAYMENT</a>
          </div>
          <div class="cart-checkout-btn pull-right" style="margin-right: 20px !important;">
            <a href="{{ route('frontend.product.checkout.cod') }}" type="submit" class="btn btn-primary checkout-btn"><i class="fa fa-money" aria-hidden="true"></i>&ensp;CASH ON DELIVERY</a>
          </div>
        </td>
      </tr>
    </tbody><!-- /tbody -->
  </table><!-- /table -->
</div><!-- /.cart-shopping-total -->			






</div><!-- /.shopping-cart -->

@endsection
