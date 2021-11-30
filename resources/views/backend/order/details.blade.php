@extends('backend.layout')

@section('content')

<div class="col-12">

    <div class="box">
        <div class="box-header with-border">
            <div class="col-12 mb-3">
                <h3 class="box-title">Order Information</h3>
            </div>
        @if ($order->status!='Canceled')
            <div class="col-12">
                <p>
                    <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Action&ensp;<i class="fas fa-chevron-circle-down"></i>
                    </button>
                </p>
                <div class="collapse" id="collapseExample">
                    <div class="row">
                        
                        <div class="col-lg-4 col-md-4 col-sm-12 m-2">
                          <div class="btn-group " role="group" aria-label="Basic example">
                            <a href="{{ route('orders.invoice', ['id'=>$order->id]) }}" class="btn btn-outline btn-success text-bold"><i class="fas fa-file-download"></i>&ensp;Invoice</a>

                            @if ($order->status!='Confirmed' && $order->status!='Delivered')
                                <a href="{{ route('orders.confirm', ['id'=>$order->id]) }}" class="confirm-btn btn btn-outline btn-primary" id="CONFIRM"><i class="fas fa-check-square"></i>&ensp;Confirm</a>

                                <a href="{{ route('orders.delete', ['id'=>$order->id]) }}" class="confirm-btn btn-outline btn btn-danger" id="DELETE"><i class="fas fa-trash-alt"></i>&emsp;Delete</a>
                            @endif

                          </div>
                        </div>

                        @if($order->status!='Delivered')
                        <div class="col-lg-4 col-md-6 col-sm-12 ml-auto m-2">
                            <form action="{{ route('orders.change.status', ['id'=>$order->id]) }}" method="post">
                                @csrf
                                <div class="input-group ">
                                    <select  name="status" class="form-control " id="inputGroupSelect04" aria-label="Example select with button addon" required>
                                      <option selected disabled value="">Status..</option>
                                      @if ($order->status!='Confirmed')
                                        @foreach ($STATUS as $value)
                                            @if ($value=='Delivered' && $order->status!='Confirmed' || $order->status==$value)
                                            @continue
                                            @else
                                            <option value="{{ $value }}">{{ $value }}</option>    
                                            @endif
                                        @endforeach
                                      @else
                                         <option value="Delivered">Delivered</option>
                                         @if ($order->payment_method=='cash on delivery')
                                         <option value="Canceled">Canceled</option>
                                         @endif
                                      @endif
                                    </select>
                                    <div class="input-group-append">
                                      <button class="btn btn-info" type="submit">Change</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="box-body">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>TrxID: </strong>{{ $order->transaction_id }}</li>
                        <li class="list-group-item"><strong>Order Time: </strong>{{ date("d M Y, h:i A", strtotime($order->created_at)) }}</li>
                        <li class="list-group-item"><strong>Name: </strong>{{ $order->name }}</li>
                        <li class="list-group-item"><strong>Phone: </strong>{{ $order->phone }}</li>
                        <li class="list-group-item"><strong>Email: </strong>{{ $order->email }}</li>
                        <li class="list-group-item"><strong>City: </strong>{{ $order->city }}</li>
                        <li class="list-group-item"><strong>Address: </strong>{{ $order->address }}</li>
                        <li class="list-group-item"><strong>Status: </strong>{{ $order->status }}</li>
                        
                      </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box-body">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Currency: </strong>{{ $order->currency }}</li>
                        <li class="list-group-item"><strong>Initial Amount: </strong>{{ number_format($order->initial_amount, 2) }}</li>
                        <li class="list-group-item"><strong>Discount Amount: </strong>{{ number_format($order->discount_amount, 2) }}</li>
                        <li class="list-group-item"><strong>Final Amount: </strong>{{ number_format($order->amount, 2) }}</li>
                        <li class="list-group-item"><strong>Payment Method: </strong>{{ $order->payment_method }}</li>
                        <li class="list-group-item"><strong>User Name: </strong>{{ $order->user->name }}</li>
                        <li class="list-group-item"><strong>User Email: </strong>{{ $order->user->email }}</li>
                        <li class="list-group-item"><strong>Delivery Date: </strong>
                            @if (is_null($order->delivered_at))
                                {{ $order->status }}
                            @else
                            {{ date("d M Y, h:i A", strtotime($order->delivered_at)) }}    
                            @endif
                        </li>
                      </ul>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="col-12">
    <div class="box">
        <div class="box-header with-border">
          <h4 class="box-title">Order Items</h4>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table id="order-table" class="table table-bordered table-striped dataTable" role="grid" >
                    <thead>
                        <tr>
                            <th style="width: 5%">#ID</th>
                            <th style="width: 10%">Image</th>
                            <th style="width: 10%">Code</th>
                            <th>Name</th>
                            <th style="width: 10%">Unit Price</th>
                            <th style="width: 10%">Qty</th>
                            <th style="width: 10%">Unit Discount</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($order->orderItems as $item)
                       <tr>
                           <td>#{{ $item->product->id }}</td>
                            <td>
                                <img src="{{ asset($item->product->image) }}" width="50" height="65">
                            </td>
                            <td>{{ $item->product->code }}</td>
                            <td>{{ $item->product->title }}</td>
                            <td>{{ number_format($item->unit_price) }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>
                                @if (is_null($item->unit_discount_amount))
                                    0%
                                @else
                                    {{ $item->unit_discount_amount }}%    
                                @endif
                            </td>
                        </tr>
                       @endforeach
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('extraScripts')

    <script>
        $(document).ready(function(){
            var table = $('#order-table').DataTable({
              "lengthMenu": ["5", "10", "50", "100"],
              "order": [[ 5, "desc" ]],
          });

          $('.confirm-btn').click(function(e){
              e.preventDefault();
              let link = $(this).attr('href');
              let MSG = $(this).attr('id');
              Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: MSG
              }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link;
                }
            });

          });

        });
    </script>

@endsection