<form action="{{ route('language.update') }}" method="post" id="edit_form">
  @csrf
  <input type="hidden" name="id" value="{{ $data->id }}">
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name" required="required" value="{{ $data->name }}">
  </div>
  <div class="mb-3">
    <label for="code" class="form-label">Code</label>
    <input type="text" class="form-control" id="code" aria-describedby="emailHelp" name="code" value="{{ $data->code }}">
  </div>
   <div class="mb-3">
    <label for="app_lang_code" class="form-label">Flutter App Lang Code</label>
    <input type="text" class="form-control" id="app_lang_code" aria-describedby="emailHelp" name="app_lang_code" value="{{ $data->app_lang_code }}">
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