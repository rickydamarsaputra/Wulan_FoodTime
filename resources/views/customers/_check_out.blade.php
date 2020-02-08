@extends('master._customers_layout')

@section('title', 'FoodTime | Menu Order')

@section('content')
<div class="container mt-5">
  <div class="row justify-content-center">

    <div class="col-lg">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('customers.purchase') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Customers</li>
          <li class="breadcrumb-item active" aria-current="page">Check Out</li>
        </ol>
      </nav>
      <a href="{{ route('customers.purchase') }}" class="btn btn-dark mb-3 rounded-pill"><i class="fas fa-backspace mr-2"></i>Back</a>
      <div class="card">
        <div class="card-body">

          @if( !empty($orderCheckOuts) )
          <ul class="list-group">

            @foreach( $orderCheckOuts as $orderCheckOut )
            <li class="list-group-item mb-2 bg-light">
              <img src="{{ asset('storage/' . $orderCheckOut->menu->menu_image) }}" class="img-thumbnail check-out-image mb-2">
              <a href="{{ route('customers.menu_detail', $orderCheckOut->menu->id) }}" class="text-dark">
                <h6 class="font-weight-bold">{{ $orderCheckOut->menu->menu_name }}</h6>
              </a>
              <div class="text-muted">
                <h6>Order Amount : {{ $orderCheckOut->order_amount }}</h6>
                <h6>Payment Amount Detail : Rp.{{ number_format($orderCheckOut->payment_amount_detail) }}</h6>
                <form action="{{ route('customers.check_out_delete', $orderCheckOut->id) }}" method="post" class="d-inline-block">
                  @csrf
                  @method('delete')
                  <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are You Sure To Delete This Menu On Your Cart?')">
                    <i class="fas fa-trash mr-2"></i>Delete
                  </button>
                  <a href="{{ route('customers.check_out_update', $orderCheckOut->id) }}" class="btn btn-outline-success btn-sm"><i class="fas fa-edit mr-2"></i>Update</a>
                </form>
              </div>
            </li>
            @endforeach
            <div class="text-right">
              <h4 class="d-inline-block"><span class="badge badge-dark font-weight-normal">Total Payment : Rp.{{ number_format($order->payment_amount) }}</span></h4>
              @if( $order->is_order == 0 )
              <h4 class="d-inline-block"><span class="badge badge-info font-weight-normal">Status Is Not Ordered</span></h4>
              @else
              <h4 class="d-inline-block"><span class="badge badge-success font-weight-normal">Status Is Ordered</span></h4>
              @endif
            </div>
            <div class="form-confirm d-flex flex-row-reverse mt-3">
              <form action="{{ route('customers.order_confirm') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-outline-info btn-sm"><i class="fas fa-clipboard-check mr-2"></i>Order Confirmation</button>
              </form>
              <form action="{{ route('customers.order_cancel') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm mr-2"><i class="far fa-window-close mr-2"></i>Cancel Order</button>
              </form>
            </div>

          </ul>
          @else
          <div class="text-muted text-center">
            <h2>You Have Not Made The Income!</h2>
            <h5 class="font-weight-bold">Please Do The Reservation</h5>
            <a href="{{ route('customers.purchase') }}" class="btn btn-outline-info"><i class="fas fa-utensils mr-2"></i>Click Me To Order</a>
          </div>
          @endif

        </div>
      </div>
    </div>

  </div>
</div>
@endsection