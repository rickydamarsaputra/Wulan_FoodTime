@extends('master._admin_layout')

@section('title', 'FoodTime | Admin Page')

@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-lg-3">
      <div class="info-box">
        <span class="info-box-icon bg-warning"><i class="far fa-user"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Registered users</span>
          <span class="info-box-number">{{ $registeredUsers }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div>
    <div class="col-lg-3">
      <div class="info-box">
        <span class="info-box-icon bg-info"><i class="fas fa-utensils"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Registered Menus</span>
          <span class="info-box-number">{{ $registeredMenus }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">@yield('title')</h3>
        </div>
        <div class="card-body">
          <table id="menu" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>

              @foreach( $users as $user )
              <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td class="text-center">
                  @if( $user->is_admin == 1 )
                  <span class="badge badge-info">Admin</span>
                  @else
                  <span class="badge badge-info">Customers</span>
                  @endif
                </td>
                <td class="align-middle text-center">
                  <a href="{{ route('auth.user_update', $user->id) }}"><i class="fas fa-users-cog text-success" style="font-size: 25px;"></i></a>
                </td>
              </tr>
              @endforeach

            </tbody>
            <tfoot>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
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
