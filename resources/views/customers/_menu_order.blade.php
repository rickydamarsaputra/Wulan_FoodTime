@extends('master._customers_layout')

@section('title', 'FoodTime | Menu Order')

@section('content')
<div class="container mt-5">
  <div class="row justify-content-center">

    <div class="col-lg-10">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('customers.purchase') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Menu</li>
          <li class="breadcrumb-item active" aria-current="page">Order</li>
          <li class="breadcrumb-item active" aria-current="page">{{ $menu->menu_name }}</li>
        </ol>
      </nav>
      <a href="{{ route('customers.purchase') }}" class="btn btn-dark mb-3 rounded-pill"><i class="fas fa-backspace mr-2"></i>Back</a>
      <div class="card mb-3">
        <div class="row no-gutters">
          <div class="col-md-4">
            <img src="{{ asset('storage/' . $menu->menu_image) }}" class="card-img menu-order">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h3 class="text-dark">{{ $menu->menu_name }}</h3>
              <h6 class="card-text d-block text-muted">{{ str_limit($menu->menu_description, 300) }}</h6>
              <span class="badge badge-pill badge-dark"><i class="fas fa-clock mr-1"></i>Min.{{ $menu->time_ready }}</span>
              <span class="badge badge-pill badge-dark mb-3"><i class="fas fa-dollar-sign mr-1"></i>{{ number_format($menu->menu_price) }}</span>

              <form action="{{ route('customers.order_action', $menu->id) }}" method="post" autocomplete="off">
                @csrf
                <div class="form-group">
                  <label for="order_amount">Order Amount</label>
                  <input type="text" class="form-control @error('order_amount') is-invalid @enderror" id="order_amount" name="order_amount" placeholder="Enter Your Order Amount">
                  @error('order_amount')<smalll class="text-danger">{{ $message }}</smalll>@enderror
                </div>
                <button type="submit" class="btn btn-outline-dark"><i class="fas fa-shopping-cart mr-2"></i>Add To Cart</button>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection