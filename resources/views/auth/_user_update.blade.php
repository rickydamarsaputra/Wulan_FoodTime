@extends('master._admin_layout')

@section('title', 'FoodTime | Update User')

@section('content')
<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">

          <form action="{{ route('auth.user_update', $user->id) }}" method="post" autocomplete="off">
            @csrf
            @method('put')
            <div class="input-group mb-3">
              <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" name="name" value="{{ $user->name }}">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="text" class="form-control @error('is_admin') is-invalid @enderror" placeholder="Status Admin Enter Field 1 Or 0" name="is_admin" value="{{ $user->is_admin }}">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user-shield"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ $user->email }}" readonly>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <button type="submit" class="btn btn-success btn-block">Update Users</button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-block">Back</a>
              </div>
              <!-- /.col -->
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection