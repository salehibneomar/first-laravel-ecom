<!doctype html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
<title>Invoice</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    html{
        margin: 0;
        padding: 0;
    }
    body{
        padding: 10px;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
    .font{
      font-size: 15px;
    }
    .authority {
        float: right
    }
    .authority h5 {
        margin-top: -10px;
        color: black;
        margin-left: 35px;
    }
    .page-break {
    page-break-after: always;
    }
</style>

</head>
<body>

  <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
    <tr>
        <td valign="top">
          <h2 style="color: black; font-size: 26px; text-align:center;">
            <strong>Shop Name</strong>
          </h2>
        </td>
    </tr>

  </table>

  <table width="100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
    <tr>
        <td>
            <p><strong>Name:</strong>&emsp;{{ $order->name }}</p>
            <p><strong>Email:</strong>&emsp;{{ $order->email }}</p>
            <p><strong>Phone:</strong>&emsp;{{ $order->phone }}</p>
            <p><strong>City:</strong>&emsp;{{ $order->city }}</p>
            <p><strong>Address:</strong>&emsp;{{ $order->address }}</p>
        </td>
        <td style="float:right; text-align: left;">
            <p><strong>TrxID:</strong>&emsp;{{ $order->transaction_id }}</p>
            <p><strong>Order Date:</strong>&emsp;
                {{ date('d M Y, Hi A', strtotime($order->created_at)) }}</p>
            <p><strong>Currency:</strong>&emsp;{{ strtoupper($order->currency) }}</p>
            <p><strong>Payment Method:</strong>&emsp;{{ strtoupper($order->payment_method) }}</p>
            <p><strong>Delivery Date:</strong>&emsp;
                @if (is_null($order->delivered_at))
                    {{ strtoupper($order->status) }}
                @else
                {{ date('d M Y, h:i A', strtotime($order->delivered_at)) }}  
                @endif
            </p>
        </td>
    </tr>
  </table>


  <br/>
<h3>Products</h3>


  <table width="100%" border="1" cellspacing="0" cellpadding="5">
    <thead >
      <tr class="font">
        <th>Image</th>
        <th>Name</th>
        <th>Unit Price</th>
        <th>Unit Discount</th>
        <th>Qty</th>
        <th>Code</th>
        <th>Total </th>
      </tr>
    </thead>
    <tbody>

     
      @foreach ($order->orderItems as $item)
      <tr class="font">
        <td align="center">
            <img src="{{ public_path($item->product->image) }}" height="65" width="50">
        </td>
        <td align="center">{{ $item->product->title }}</td>
        <td align="center">{{ number_format($item->unit_price) }}</td>
        <td align="center">
            @if (!is_null($item->unit_discount_amount))
            {{ $item->unit_discount_amount }}%
            @else
            0%
            @endif
        </td>
        <td align="center">{{ $item->qty }}</td>
        <td align="center">{{ $item->product->code }}</td>
        <td align="center">{{ number_format(doubleval($item->unit_price) - (round($item->unit_price)*(intval($item->unit_discount_amount)/100))) }}</td>
      </tr>
      @endforeach
      
    </tbody>
  </table>
  <br>
  <table width="100%" style=" padding:0 10px 0 10px;">
    <tr>
        <td align="right" >
            <h2><strong>Initial Amount: </strong>&emsp;{{ number_format($order->initial_amount) }}</h2>
            <h2><strong>Discount Amount: </strong>&emsp;{{ number_format($order->discount_amount) }}</h2>
            <h2><strong>Final Amount: </strong>&emsp;{{ number_format($order->amount) }}</h2>
        </td>
    </tr>
  </table>

  <div class="authority float-right mt-5" style="text-align: center; margin-top: 30px;">
      <p>-----------------------------------</p>
      <h5>Authority Signature:</h5>
    </div>
</body>
</html>