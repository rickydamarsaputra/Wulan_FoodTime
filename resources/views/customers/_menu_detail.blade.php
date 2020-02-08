@extends('master._customers_layout')

@section('title', 'FoodTime | Menu Detail')

@section('content')
<div class="container mt-5">
  <div class="row justify-content-center">

    <div class="col-lg-10">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('customers.purchase') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Menu</li>
          <li class="breadcrumb-item active" aria-current="page">{{ $menu->menu_name }}</li>
        </ol>
      </nav>
      <a href="{{ route('customers.purchase') }}" class="btn btn-dark mb-3 rounded-pill"><i class="fas fa-backspace mr-2"></i>Back</a>
      <div class="card shadow-lg">
        <img src="{{ asset('storage/' . $menu->menu_image) }}" class="card-img-top on-detail">
        <div class="card-body">
          <h4 class="text-muted">{{ $menu->menu_name }}</h4>
          <span class="badge badge-pill badge-dark"><i class="fas fa-clock mr-1"></i>Min.{{ $menu->time_ready }}</span>
          <span class="badge badge-pill badge-dark"><i class="fas fa-dollar-sign mr-1"></i>{{ number_format($menu->menu_price) }}</span>
          <p>{{ $menu->menu_description }}</p>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection