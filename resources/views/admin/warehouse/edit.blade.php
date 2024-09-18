<form action="{{ route('warehouse.update') }}" method="post" id="edit_form">
  @csrf
  <input type="hidden" name="id" value="{{ $data->id }}">
  <div class="mb-3">
    <label for="warehouse_name" class="form-label">Warehouse Name</label>
    <input type="text" class="form-control" id="warehouse_name" aria-describedby="emailHelp" name="warehouse_name" value="{{ $data->warehouse_name }}">
  </div>
  <div class="mb-3">
    <label for="warehouse_address" class="form-label">Warehouse Address</label>
    <input type="text" class="form-control" id="warehouse_address" aria-describedby="emailHelp" name="warehouse_address" value="{{ $data->warehouse_address }}">
  </div>
  <div class="mb-3">
    <label for="warehouse_phone" class="form-label">Warehouse Phone</label>
    <input type="text" class="form-control" id="warehouse_phone" aria-describedby="emailHelp" name="warehouse_phone" value="{{ $data->warehouse_phone }}">
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
    //Dropify image
    $('.dropify').dropify();
</script>