<form action="{{ route('shipping.country.update') }}" method="post" id="edit_form">
  @csrf
  <input type="hidden" name="id" value="{{ $data->id }}">
  <div class="mb-3">
    <label for="country_name" class="form-label">Country Name</label>
    <input type="text" class="form-control" id="country_name" aria-describedby="emailHelp" name="country_name" value="{{ $data->country_name }}">
  </div>
  <div class="mb-3">
    <label for="country_code" class="form-label">Country Code</label>
    <input type="text" class="form-control" id="country_code" aria-describedby="emailHelp" name="country_code" placeholder="Country code" value="{{ $data->country_code }}">
    <small class="text-muted">(Country Code Use BN,IND,US,UK)</small>
  </div>
  <div class="mb-3">
    <label for="type" class="form-label">Status</label>
    <select class="form-select" aria-label="Default select example" name="status">
      <option value="1" @if($data->status==1) selected="" @endif>Show</option>
      <option value="0" @if($data->status==0) selected="" @endif>Hide</option>
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