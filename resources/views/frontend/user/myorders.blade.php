@extends('frontend.layout')

@section('pageTitle')
{{ 'My Orders' }}
@endsection

@section('content')

<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="my-wishlist-page" style="margin-bottom: 30px !important;">
            <div class="row">
                <div class="col-md-12 my-wishlist">
                    @if ($orders->count()==0)
                        <div class="alert bg-info text-center">
                            <strong>You Don't have any orders placed in our system!</strong>
                        </div>

                    @else
                    <h4 class="heading-title">My Orders</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            
                            <tr>
                                <th>Date</th>
                                <th>TrxID</th>
                                <th>Method</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>

                            @foreach ($orders as $order)
                            <tr class="profile-tr">
                                <td>{{ date('d M y', strtotime($order->created_at)) }}</td>
                                <td>{{ $order->transaction_id }}</td>
                                <td>{{ $order->payment_method }}</td>
                                <td>৳{{ number_format($order->amount) }}</td>
                                <td>{{ $order->status }}</td>
                                <td>
                                    <a href="{{ route('account.order.items', ['orderId'=> base64_encode($order->id) ]) }}" class="btn btn-sm btn-success"><i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                    <a href="{{ route('account.order.invoice', ['orderId'=> base64_encode($order->id) ]) }}" class="btn btn-sm btn-danger"><i class="fa fa-file-text-o" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                    
                        </table>
                    </div>
                    <div class="text-right">
                        {{ $orders->links('vendor.pagination.custom') }}
                    </div>
                    @endif
                </div>			
            </div>
        </div>
    </div>
</div>

@endsection