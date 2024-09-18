<form action="{{ route('shipping.city.update') }}" method="post" id="edit_form">
  @csrf
  <input type="hidden" name="id" value="{{ $data->id }}">
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name" value="{{ $data->name }}">
  </div>
  <div class="mb-3">
    <label for="country_code" class="form-label">Country / State</label>
    <select class="form-select" aria-label="Default select example" name="state_id">
      <option disabled="" selected="">--Select Country / State</option>
      @foreach($country as $row)
      @php
        $state=DB::table('states')->where('country_id',$row->id)->where('status',1)->get();
      @endphp
      <option disabled="">{{ $row->country_name }}</option>
        @foreach($state as $row)
        <option value="{{ $row->id }}" @if($row->id==$data->state_id) selected="" @endif>---{{ $row->state }}</option>
        @endforeach
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