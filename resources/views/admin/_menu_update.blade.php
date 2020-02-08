@extends('master._admin_layout')

@section('title', 'FoodTime | Update Menu')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg">
      <div class="card">
        <div class="card-body">

          <form action="{{ route('admin.update_menu', $menu->id) }}" method="post" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('put')
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-utensils"></i></span>
              </div>
              <input type="text" class="form-control @error('menu_name') is-invalid @enderror" placeholder="Menu Name" name="menu_name" value="{{ $menu->menu_name }}">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
              </div>
              <input type="text" class="form-control @error('menu_price') is-invalid @enderror" placeholder="Menu Price" name="menu_price" value="{{ $menu->menu_price }}">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-clock"></i></span>
              </div>
              <input type="text" class="form-control @error('time_ready') is-invalid @enderror" placeholder="Time Ready" name="time_ready" value="{{ $menu->time_ready }}">
            </div>
            <div class="form-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input @error('menu_image') is-invalid @enderror" id="customFile" name="menu_image" value="{{ $menu->menu_image }}">
                <label class="custom-file-label" for="customFile">Menu Image</label>
              </div>
              <img src="{{ asset('storage/' . $menu->menu_image) }}" width="150" class="img-thumbnail mt-3">
            </div>
            <div class="form-group">
              <textarea class="form-control @error('menu_description') is-invalid @enderror" rows="3" placeholder="Menu Description" name="menu_description">{{ $menu->menu_description }}</textarea>
            </div>
            <button type="submit" class="btn btn-block btn-success btn-sm">Update Menu</button>
            <a href="{{ route('admin.menus') }}" class="btn btn-block btn-info btn-sm">Back</a>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection