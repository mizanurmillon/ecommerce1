<form action="{{ route('subcategory.update') }}" method="post" id="edit_form">
  @csrf
  <input type="hidden" name="id" value="{{ $data->id }}">
  <div class="row">
    <div class="col-md-4 mb-3">
      <label for="type" class="form-label">Select Category</label>
      <select class="form-select" aria-label="Default select example" name="category_id" required>
        <option disabled="" selected="" class="text-danger">Select Category</option>
        @foreach($category as $row)
        <option value="{{ $row->id }}" @if($row->id==$data->category_id) selected="" @endif>{{ $row->category_name }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-md-4 mb-3">
      <label for="subcategory_name" class="form-label">Subcategory Name</label>
      <input type="text" class="form-control" id="subcategory_name" aria-describedby="emailHelp" name="subcategory_name" value="{{ $data->subcategory_name }}">
    </div>
    <div class="col-md-4 mb-3">
      <label for="subcategory_slug" class="form-label">Subcategory Slug</label>
      <input type="text" class="form-control" id="subcategory_slug" aria-describedby="emailHelp" name="subcategory_slug" value="{{ $data->subcategory_slug }}" readonly="readonly">
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 mb-3">
      <label for="formFileSm" class="form-label">Subcategory Image</label>
      <input class="form-control form-control-sm dropify" id="formFileSm" type="file" name="image" data-default-file="{{ asset('public/files/subcategory/'.$data->image) }}">
      <input type="hidden" name="old_image" value="{{ $data->image }}">
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
    //Dropify image
    $('.dropify').dropify();
</script>