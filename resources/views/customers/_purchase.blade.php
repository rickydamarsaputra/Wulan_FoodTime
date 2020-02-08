@extends('master._customers_layout')

@section('title', 'FoodTime | Customers Purchase')

@section('content')
<h3 class="text-center mt-5 text-muted">Choose The Menu You Will Eat!</h3>

<div class="container mt-5">
  <div class="row">

    @php
    $aosCount = 200;
    @endphp

    @foreach( $menus as $menu )
    <div class="col-lg-3" data-aos="zoom-in" data-aos-duration="{{ $aosCount+=250 }}">
      <div class="card shadow">
        <a href="{{ asset('storage/' . $menu->menu_image) }}" class="menu-lightbox">
          <img src="{{ asset('storage/' . $menu->menu_image) }}" class="card-img-top menu-display">
        </a>
        <div class="card-body">
          <h5><a href="{{ route('customers.menu_detail', $menu->id) }}" class="text-dark">{{ $menu->menu_name }}</a></h5>
          <small class="card-text text-muted d-block">{{ str_limit($menu->menu_description, 100) }}</small>
          <i class="fas fa-clock mr-1"></i>Min.{{ $menu->time_ready }}
          <div class="float-right">
            <i class="fas fa-dollar-sign mr-1"></i>{{ number_format($menu->menu_price) }}
          </div>
          <a href="{{ route('customers.order', $menu->id) }}" class="btn btn-outline-dark d-block mt-3"><i class="fas fa-shopping-cart mr-2"></i>Add to cart</a>
        </div>
      </div>
    </div>
    @endforeach

  </div>
</div>
@endsection