<form action="{{ route('pickuppoint.update') }}" method="post" id="edit_form">
  @csrf
  <input type="hidden" name="id" value="{{ $data->id }}">
  <div class="row">
    <div class="col-md-6 mb-3">
      <label for="name" class="form-label">Pickup Point</label>
      <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name" value="{{ $data->name }}">
    </div>
    <div class="col-md-6 mb-3">
      <label for="address" class="form-label">Address</label>
      <input type="text" class="form-control" id="address" aria-describedby="emailHelp" name="address" value="{{ $data->address }}">
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 mb-3">
      <label for="city" class="form-label">City</label>
      <input type="text" class="form-control" id="city" aria-describedby="emailHelp" name="city" value="{{ $data->city }}">
    </div>
    <div class="col-md-6 mb-3">
      <label for="state" class="form-label">State</label>
      <input type="text" class="form-control" id="state" aria-describedby="emailHelp" name="state" value="{{ $data->state }}">
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 mb-3">
      <label for="zip_code" class="form-label">ZipCode</label>
      <input type="text" class="form-control" id="zip_code" aria-describedby="emailHelp" name="zip_code" value="{{ $data->zip_code }}">
    </div>
    <div class="col-md-6 mb-3">
      <label for="phone" class="form-label">Phone</label>
      <input type="text" class="form-control" id="phone" aria-describedby="emailHelp" name="phone" value="{{ $data->phone }}">
    </div>
  </div>
  <button type="submit" class="btn btn-success" style="float:right;">Update</button>
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