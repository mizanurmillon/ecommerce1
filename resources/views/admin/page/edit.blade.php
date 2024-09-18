<form action="{{ route('page.update') }}" method="post" id="edit_form">
  @csrf
  <input type="hidden" name="id" value="{{ $data->id }}">
  <div class="row">
    <div class="col-md-6 mb-3">
      <label for="page_title" class="form-label">Page Title</label>
      <input type="text" class="form-control" id="page_title" aria-describedby="emailHelp" name="page_title" value="{{ $data->page_title }}">
    </div>
    <div class="col-md-6 mb-3">
      <label for="color_code" class="form-label">Page Position</label>
      <select class="form-select" aria-label="Default select example" name="page_position">
        <option value="1" @if($data->page_position==1) selected="" @endif>Right</option>
        <option value="0" @if($data->page_position==0) selected="" @endif>Left</option>
      </select>
    </div>
  </div>
   <div class="mb-3">
    <label for="content" class="form-label">Content</label>
    <textarea class="form-control summernote" name="content">{{ $data->content }}</textarea>
</div>
  <div class="mb-3">
    <label for="type" class="form-label">Status</label>
    <select class="form-select" aria-label="Default select example" name="status">
      <option value="1" @if($data->status==1) selected="" @endif>Active</option>
      <option value="0" @if($data->status==0) selected="" @endif>Deactive</option>
    </select>
  </div>
  <button type="submit" class="btn btn-success">Update</button>
</form>
<script type="text/javascript">
   //summernote
  $(document).ready(function() {
    $('.summernote').summernote({
      height: 150,
    });
  });
  //Update Form Submit
    $('#edit_form').submit(function(e){
      e.preventDefault();
      var url=$(this).attr('action');
      var request=$(this).serialize();
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
          $('.dataTable').DataTable().ajax.reload();
          $('#editModal').modal('hide');
        }
      });
    });
</script>