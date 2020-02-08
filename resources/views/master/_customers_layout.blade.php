<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>@yield('title')</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Mycss -->
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
  <!-- Aos -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
</head>

<body class="hold-transition sidebar-mini bg-light">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
      <a class="navbar-brand" href="{{ route('customers.purchase') }}"><i class="fas fa-utensils mr-2 text-muted"></i>FoodTime | Customers Purchase</a>
      <!-- <div class="collapse navbar-collapse" id="navbarNavAltMarkup"> -->
      <div class="navbar-nav ml-auto d-inline-block text-center">

        @php
        $user = \App\User::find(auth()->user()->id);
        $orderUser = \App\Order::whereUserId($user->id)->first();
        if (empty($orderUser)) {
        $orderCount = 0;
        } else {
        $orderCount = \App\OrderDetail::whereOrderId($orderUser->id)->count();
        }
        @endphp

        <a class="nav-item nav-link d-inline-block cart-menu" href="{{ route('customers.check_out') }}"><i class="fas fa-shopping-cart mx-1"></i>{{ $orderCount }}</a>
        <div class="dropdown d-inline-block">
          <button class="btn dropdown-toggle" type="button" id="customers_menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ auth()->user()->name }}
          </button>
          <div class="dropdown-menu" aria-labelledby="customers_menu">
            <a class="dropdown-item text-danger" href="{{ route('auth.logout') }}"><i class="fas fa-sign-out-alt mx-2"></i>Logout</a>
          </div>
        </div>
      </div>
      <!-- </div> -->
    </div>
  </nav>
  <!-- Navbar -->

  <!-- Content -->
  @yield('content')
  <!-- Content -->

  <!-- REQUIRED SCRIPTS -->
  @include('sweetalert::alert')
  <!-- jQuery -->
  <script src="{{ asset('/plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('/dist/js/adminlte.min.js') }}"></script>
  <!-- bs-custom-file-input -->
  <script src="{{ asset('/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('/dist/js/demo.js') }}"></script>
  <!-- Aos -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
  <script>
    $(document).ready(function() {
      AOS.init();
      $(".menu-lightbox").fancybox();
    })
  </script>
  @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
</body>

</html>