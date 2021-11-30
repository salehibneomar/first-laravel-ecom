@extends('frontend.layout')

@section('pageTitle')
{{ 'Order Items' }}
@endsection

@section('content')

<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="my-wishlist-page" style="margin-bottom: 30px !important;">
            <div class="row">
                <div class="col-md-12 my-wishlist">
                    
                    <h4 class="heading-title">My Orders</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Unit Price</th>
                                <th>Unit Discount</th>
                                <th>Qty</th>
                            </tr>

                            @foreach ($orderItems as $item)
                            <tr class="profile-tr">
                                <td>
                                    <img src="{{ asset($item->product->image) }}" class="image">
                                </td>
                                <td>{{ $item->product->title }}</td>
                                <td>৳{{ number_format($item->unit_price) }}</td>
                                <td>
                                    @if (is_null($item->unit_discount_amount) || $item->unit_discount_amount==0)
                                        {{ '0%' }}
                                    @else
                                        {{ $item->unit_discount_amount }}%
                                    @endif
                                </td>
                                <td>{{ $item->qty }}</td>
                            </tr>
                            @endforeach
                    
                        </table>
                    </div>
                    <div class="text-right">
                        {{ $orderItems->links('vendor.pagination.custom') }}
                    </div>
                    
                </div>			
            </div>
        </div>
    </div>
</div>

@endsection