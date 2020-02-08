<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Report Payment</title>
  <style>
    .title {
      text-align: center;
      border-bottom: .5px solid #000;
      font-weight: bold;
    }

    * {
      font-family: Arial, Helvetica, sans-serif;
      font-weight: normal;
    }

    .order-detail>.order-payment {
      float: right;
    }

    h6,
    .price {
      position: relative;
      color: #333333;
    }

    h6>.value {
      position: absolute;
      left: 8em;
    }

    .info>h6>.value::before {
      content: ":";
      margin: 0 1em;
    }

    .order-detail>.count {
      position: absolute;
      left: 15em;
    }

    .price {
      float: right;
      margin-right: 4em;
    }

    .order-price {
      position: absolute;
      left: 2em;
    }

    .content {
      border-bottom: .5px solid #333;
    }

    .total-payment {
      text-align: right;
    }

    .info>h6 {
      font-size: 12px;
      margin: .5em 0;
    }

    .struck-body {
      width: 100%;
      padding: 0;
      margin: 0;
    }

    .info {
      margin-bottom: 1em;
    }

    .content>.order-detail {
      margin: .5em 0;
    }
  </style>

</head>

<body>

  @php
  $number = rand(100000, 10000000);
  $string = \Str::random(10);
  $orderCode = $number . $string;
  @endphp

  <div class="struck-body">
    <h5 class="title">Welcome To FoodTime</h5>
    <div class="info">
      <h6>Customer Name<span class="value">{{ $order->user->name }}</span></h6>
      <h6>Order Date<span class="value">20-10-2001</span></h6>
      <h6>Payment Code<span class="value">{{ $orderCode }}</span></h6>
      <h6>Cashier<span class="value">{{ auth()->user()->name }}</span></h6>
    </div>

    @foreach( $orderDetails as $orderDetail )
    <div class="content">
      <h6 class="order-detail">{{ $orderDetail->menu->menu_name }}<span class="count">x {{ $orderDetail->order_amount }}</span><span class="price">Rp.<span class="order-price">{{ number_format($orderDetail->payment_amount_detail) }}</span></span></h6>
    </div>
    @endforeach
    <h6 class="total-payment">Total Payment : Rp.{{ number_format($order->payment_amount) }}</h6>
  </div>

</body>

</html>