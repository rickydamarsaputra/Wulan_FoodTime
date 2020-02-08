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
          <li class="breadcrumb-item active" aria-current="page">Update Menu</li>
        </ol>
      </nav>
      <a href="{{ route('customers.check_out') }}" class="btn btn-dark mb-3 rounded-pill"><i class="fas fa-backspace mr-2"></i>Back</a>
      <div class="card">
        <div class="card-body">

          <ul class="list-group">
            <li class="list-group-item mb-2 bg-light">
              <img src="{{ asset('storage/' . $orderMenuUpdate->menu->menu_image) }}" class="img-thumbnail check-out-image-update mt-2 mb-2">
              <a href="{{ route('customers.menu_detail', $orderMenuUpdate->menu->id) }}" class="text-dark">
                <h5 class="font-weight-bold text-muted">{{ $orderMenuUpdate->menu->menu_name }}</h5>
              </a>
              <small>{{ str_limit($orderMenuUpdate->menu->menu_description, 300) }}</small>

              <form action="{{ route('customers.check_out_update_action', $orderMenuUpdate->id) }}" method="post" autocomplete="off">
                @csrf
                @method('put')
                <div class="form-group">
                  <label for="order_amount">Order Amount</label>
                  <input type="text" class="form-control @error('order_amount') is-invalid @enderror" id="order_amount" name="order_amount" placeholder="Enter Your Order Amount" value="{{ $orderMenuUpdate->order_amount }}">
                  @error('order_amount')<smalll class="text-danger">{{ $message }}</smalll>@enderror
                </div>
                <button type="submit" class="btn btn-outline-success btn-sm"><i class="fas fa-edit mr-2"></i>Update Menu Amount</button>
              </form>

            </li>
          </ul>

        </div>
      </div>
    </div>

  </div>
</div>
@endsection