<!-- Modal -->
<div class="modal fade" id="add_menu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('admin.add_menu') }}" method="post" enctype="multipart/form-data" autocomplete="off">
        <div class="modal-body">

          @csrf
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-utensils"></i></span>
            </div>
            <input type="text" class="form-control @error('menu_name') is-invalid @enderror" placeholder="Menu Name" name="menu_name" value="{{ old('menu_name') }}">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
            </div>
            <input type="text" class="form-control @error('menu_price') is-invalid @enderror" placeholder="Menu Price" name="menu_price" value="{{ old('menu_price') }}">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-clock"></i></span>
            </div>
            <input type="text" class="form-control @error('time_ready') is-invalid @enderror" placeholder="Time Ready" name="time_ready" value="{{ old('time_ready') }}">
          </div>
          <div class="form-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input @error('menu_image') is-invalid @enderror" id="customFile" name="menu_image">
              <label class="custom-file-label" for="customFile">Menu Image</label>
            </div>
          </div>
          <div class="form-group">
            <textarea class="form-control @error('menu_description') is-invalid @enderror" rows="3" placeholder="Menu Description" name="menu_description"></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-plus mr-2"></i>Add Menu</button>
        </div>
      </form>
    </div>
  </div>
</div>