<form action="{{ route('brand.update') }}" method="post" id="edit_form">
  @csrf
  <input type="hidden" name="id" value="{{ $data->id }}">
  <div class="row">
    <div class="col-md-6 mb-3">
      <label for="brand_name" class="form-label">Brand Name</label>
      <input type="text" class="form-control" id="brand_name" aria-describedby="emailHelp" name="brand_name" value="{{ $data->brand_name }}">
    </div>
    <div class="col-md-6 mb-3">
      <label for="type" class="form-label">Status</label>
      <select class="form-select" aria-label="Default select example" name="status">
        <option value="Active" @if($data->status=="Active") selected="" @endif>Active</option>
        <option value="Deactive" @if($data->status=="Deactive") selected="" @endif>Deactive</option>
      </select>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 mb-3">
      <label for="meta_title" class="form-label">Meta Title</label>
      <input type="text" class="form-control" id="meta_title" aria-describedby="emailHelp" name="meta_title" value="{{ $data->meta_title }}">
    </div>
    <div class="col-md-6 mb-3">
      <label for="meta_description" class="form-label">Meta Description</label>
      <textarea class="form-control" id="meta_description" name="meta_description">{{ $data->meta_description }} </textarea>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 mb-3">
      <label for="formFileSm" class="form-label">Brand Logo</label>
      <input class="form-control form-control-sm dropify" id="formFileSm" type="file" name="image" data-default-file="{{ asset('public/files/brand/'.$data->image) }}">
      <input type="hidden" name="old_image" value="{{ $data->image }}">
      <img src="{{ asset('public/files/brand/'.$data->image) }}" alt="" width="60px" height="60px">
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