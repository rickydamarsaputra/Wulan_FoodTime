@extends('master._admin_layout')

@section('title', 'FoodTime | List Transaction')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg">

      <!-- Data Tables -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">@yield('title')</h3>
        </div>
        <div class="card-body">
          <table id="menu" class="table table-bordered table-striped text-center">
            <thead>
              <tr>
                <th>Customers Name</th>
                <th>Customers Email</th>
                <th>Customers Total Payment</th>
                <th>Status Payment</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>

              @foreach( $orders as $order )
              <tr>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->user->email }}</td>
                <td>Rp. {{ number_format($order->payment_amount) }}</td>
                <td>
                  @if( $order->is_order == 0 )
                  <span class="badge badge-danger">Is Not Ordered</span>
                  @else
                  <span class="badge badge-success">Ordered</span>
                  @endif
                </td>
                <td>
                  @if( $order->is_order == 0 )
                  <a href="#" class="btn btn-secondary btn-sm"><i class="fas fa-print"></i></a>
                  @else
                  <a href="{{ route('admin.report_payment', $order->id) }}" class="btn btn-danger btn-sm"><i class="fas fa-print"></i></a>
                  @endif
                </td>
              </tr>
              @endforeach

            </tbody>
            <tfoot>
              <tr>
                <th>Customers Name</th>
                <th>Customers Email</th>
                <th>Customers Total Payment</th>
                <th>Status Payment</th>
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