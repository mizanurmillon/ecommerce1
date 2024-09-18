<form action="{{ route('shipping.state.update') }}" method="post" id="edit_form">
  @csrf
  <input type="hidden" name="id" value="{{ $data->id }}">
  <div class="mb-3">
    <label for="state" class="form-label">State Name</label>
    <input type="text" class="form-control" id="state" aria-describedby="emailHelp" name="state" value="{{ $data->state }}">
  </div>
  <div class="mb-3">
    <label for="country_code" class="form-label">Country</label>
    <select class="form-select" aria-label="Default select example" name="country_id">
      @foreach($country as $row)
      <option value="{{ $row->id }}" @if($row->id==$data->country_id) selected="" @endif>{{ $row->country_name }}</option>
      @endforeach
    </select>
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