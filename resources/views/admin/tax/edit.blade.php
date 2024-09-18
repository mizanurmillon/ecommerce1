<form action="{{ route('tax.update') }}" method="post" id="edit_form">
  @csrf
  <input type="hidden" name="id" value="{{ $data->id }}">
  <div class="mb-3">
    <label for="tax_name" class="form-label">Tax Name</label>
    <input type="text" class="form-control" id="tax_name" aria-describedby="emailHelp" name="tax_name" value="{{ $data->tax_name }}">
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