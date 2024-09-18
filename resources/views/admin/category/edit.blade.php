<form action="{{ route('category.update') }}" method="post" id="edit_form">
  @csrf
  <input type="hidden" name="id" value="{{ $data->id }}">
  <div class="row">
    <div class="col-md-6 mb-3">
      <label for="category_name" class="form-label">Category Name</label>
      <input type="text" class="form-control" id="category_name" aria-describedby="emailHelp" name="category_name" value="{{ $data->category_name }}">
    </div>
    <div class="col-md-6 mb-3">
      <label for="type" class="form-label">Category Type</label>
      <select class="form-select" aria-label="Default select example" name="type">
        <option value="Physical" @if($data->type=='Physical') selected="" @endif>Physical</option>
        <option value="Digital" @if($data->type=='Digital') selected="" @endif>Digital</option>
      </select>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 mb-3">
      <label for="status" class="form-label">Category Status</label>
      <select class="form-select" aria-label="Default select example" name="status">
        <option value="1" @if($data->status==1) selected="" @endif>Active</option>
        <option value="0" @if($data->status==0) selected="" @endif>Deactive</option>
      </select>
    </div>
    <div class="col-md-6 mb-3">
      <label for="banner" class="form-label">Banner <small>(200x200)</small></label>
      <input class="form-control form-control-sm" id="banner" type="file" name="banner">
      <input type="hidden" name="old_banner" value="{{ $data->banner }}">
      <img src="{{ asset('public/files/category/'.$data->banner) }}" alt="" width="50" height="50" class="mt-1">
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 mb-3">
      <label for="icon" class="form-label">Icon <small>(32x32)</small></label>
      <input class="form-control form-control-sm" id="icon" type="file" name="icon">
      <input type="hidden" name="old_icon" value="{{ $data->icon }}">
      <img src="{{ asset('public/files/category/'.$data->icon) }}" alt="" width="30" height="30" class="mt-1">
    </div>
    <div class="col-md-6 mb-3">
      <label for="formFileSm" class="form-label">Cover Image <small>(360x360)</small></label>
      <input class="form-control form-control-sm" id="formFileSm" type="file" name="cover_image">
      <input type="hidden" name="old_cover_image" value="{{ $data->cover_image }}">
      <img src="{{ asset('public/files/category/'.$data->cover_image) }}" alt="" width="50" height="50" class="mt-1">
    </div>
  </div>
  <div class="row">
     <div class="col-md-6">
      <label for="meta_title" class="form-label">Mate Title</label>
      <input type="text" class="form-control" id="meta_title" aria-describedby="emailHelp" name="meta_title" placeholder="Mate Title" value="{{ $data->meta_title }}">
    </div>
    <div class="col-md-6 mb-3">
      <label for="category_slug" class="form-label">Category Slug</label>
      <input type="text" class="form-control" id="category_slug" aria-describedby="emailHelp" name="category_slug" placeholder="Mate Title" value="{{ $data->category_slug }}">
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 mb-3">
      <label for="meta_description" class="form-label">Mate Description</label>
      <textarea id="meta_description" name="meta_description" class="form-control" rows="3">{{ $data->meta_description }}</textarea>
    </div>
  </div>
  <button type="submit" class="btn btn-success">Update</button>
</form>

<script type="text/javascript">
  //Update Form Submit
    $('#edit_form').submit(function(e){
      e.preventDefault();
      var url=$(this).attr('action');
      var request=$(this).serialize();
      $('.submit_button').prop('type','button');
      $.ajax({
        url:url,
        type:'post',
        data:new FormData(this),
        contentType:false,
        cache:false,
        processData:false,
        success:function(data){
          toastr.success(data);
          $('#edit_form')[0].reset();
          $('.submit_button').prop('type','submit');
          $('.dataTable').DataTable().ajax.reload();
          $('#editModal').modal('hide');
        }
      });
    });
</script>