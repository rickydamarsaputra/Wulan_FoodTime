@extends('master._admin_layout')

@section('title', 'FoodTime | Menu List')

@section('content')
<div class="container">
  <button type="button" class="btn btn-dark btn-sm mb-3" data-toggle="modal" data-target="#add_menu"><i class="fas fa-plus mr-2"></i>Add New Menu</button>
  @include('include._modal_add_menu')
  <div class="row justify-content-center">
    <div class="col-lg">
      <!-- Data Tables -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">@yield('title')</h3>
        </div>
        <div class="card-body">
          <table id="menu" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Menu Name</th>
                <th>Menu Price</th>
                <th>Menu Image</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>

              @foreach( $menus as $menu )
              <tr class="text-center">
                <td class="align-middle">{{ $menu->menu_name }}</td>
                <td class="align-middle">Rp.{{ number_format($menu->menu_price) }}</td>
                <td><img src="{{ asset('storage/' . $menu->menu_image) }}" class="img-thumbnail" width="80"></td>
                <td class="align-middle">
                  <a href="{{ route('admin.delete_menu', $menu->id) }}" onclick="return confirm('Are You Sure To Delete This Menu?')"><i class="fas fa-trash-alt text-danger mx-1"></i></a>
                  <a href="{{ route('admin.update_menu', $menu->id) }}"><i class="fas fa-edit text-success mx-1"></i></a>
                </td>
              </tr>
              @endforeach

            </tbody>
            <tfoot>
              <tr>
                <th>Menu Name</th>
                <th>Menu Price</th>
                <th>Menu Image</th>
                <th>Action</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection