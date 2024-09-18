<form action="{{ route('currency.update') }}" method="post" id="edit_form">
  @csrf
  <input type="hidden" name="id" value="{{ $data->id }}">
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name" value="{{ $data->name }}">
  </div>
  <div class="mb-3">
    <label for="symbol" class="form-label">Symbol</label>
    <input type="text" class="form-control" id="symbol" aria-describedby="emailHelp" name="symbol" value="{{ $data->symbol }}">
  </div>
  <div class="mb-3">
    <label for="code" class="form-label">Code</label>
    <input type="text" class="form-control" id="code" aria-describedby="emailHelp" name="code" value="{{ $data->code }}">
  </div>
   <div class="mb-3">
    <label for="exchange_rate" class="form-label">Exchange rate</label>
    <input type="text" class="form-control" id="exchange_rate" aria-describedby="emailHelp" name="exchange_rate" value="{{ $data->exchange_rate }}">
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