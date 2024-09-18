@extends('layouts.admin')
@section('admin_content')
@push('css')
@endpush
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content pt-4">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="card">
          <div class="card-header">
            <a href="{{ route('coupon') }}" class="btn btn-danger btn-sm" style="float:right;">Coupon</a>
            <h3 class="card-title">Coupon Code Update Form</h3>
          </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                  <div class="col-lg-12">
                    <form action="{{ route('coupon.update') }}" method="post" id="edit_form">
                      @csrf
                      <input type="hidden" name="id" value="{{ $data->id }}">
                      <div class="row">
                      <div class="col-md-4 mb-3">
                          <label for="coupon_name" class="form-label">Coupon Name</label>
                          <input type="text" class="form-control" id="coupon_name" aria-describedby="emailHelp" name="coupon_name" placeholder="Coupon Name" value="{{ $data->coupon_name }}">
                          <p></p>
                      </div>
                      <div class="col-md-4 mb-3">
                          <label for="coupon_code" class="form-label">Coupon Code</label>
                          <input type="text" class="form-control" id="coupon_code" aria-describedby="emailHelp" name="coupon_code" placeholder="Coupon code" value="{{ $data->coupon_code }}">
                          <p></p>
                      </div>
                      <div class="col-md-4 mb-3">
                          <label for="max_uses" class="form-label">Max Uses</label>
                          <input type="number" class="form-control" id="max_uses" aria-describedby="emailHelp" name="max_uses" value="{{ $data->max_uses }}">
                          <p></p>
                      </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="max_uses_user" class="form-label">Max Uses User</label>
                            <input type="number" class="form-control" id="max_uses_user" aria-describedby="emailHelp" name="max_uses_user" value="{{ $data->max_uses_user }}">
                            <p></p>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="description" class="form-label">Description</label>
                          <textarea class="form-control" name="description" id="description" rows="2">{{ $data->description }}</textarea>
                          <p></p>
                      </div>
                      <div>
                      <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="coupon_code" class="form-label">Type</label>
                            <select class="form-select" aria-label="Default select example" name="type" id="type"> 
                              <option disabled="" selected="">--</option>
                              <option value="percent" @if($data->type=="percent") selected="" @endif>Percent</option>
                              <option value="fixed"  @if($data->type=="fixed") selected="" @endif>Fixed</option>
                            </select>
                            <p></p>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="discount_amount" class="form-label">Discount Amount</label>
                            <input type="text" class="form-control" id="discount_amount" aria-describedby="emailHelp" name="discount_amount" placeholder="Discount Amount" value="{{ $data->discount_amount }}">
                            <p></p>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="min_amount" class="form-label">Min Amount</label>
                            <input type="text" class="form-control" id="min_amount" aria-describedby="emailHelp" name="min_amount" value="{{ $data->min_amount }}">
                            <p></p>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="coupon_code" class="form-label">Status</label>
                            <select class="form-select" aria-label="Default select example" name="status" id="status">
                              <option disabled="" selected="">--</option>
                              <option value="1" @if($data->status==1) selected="" @endif>Active</option>
                              <option value="0" @if($data->status==0) selected="" @endif>Block</option>
                            </select>
                            <p></p>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="starts_at" class="form-label">Starts At</label>
                            <input type="text" class="form-control st_date" id="starts_at" aria-describedby="emailHelp" name="starts_at" autocomplete="off" value="{{ $data->starts_at }}">
                            <p></p>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="expires_at" class="form-label">Expires At</label>
                            <input type="text" class="form-control ex_date" id="expires_at" aria-describedby="emailHelp" name="expires_at" autocomplete="off" value="{{ $data->expires_at }}">
                            <p></p>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-success">Update</button>
                    </form>
                  </div>
                </div> 
              </div>
            </div>
          </div>
        </div> 
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @push('js')
  <script type="text/javascript">
    $(document).ready(function(){
      $('#starts_at').datetimepicker({
          format:'Y-m-d H:i:s',
      });

      $('#expires_at').datetimepicker({
          format:'Y-m-d H:i:s',
      });
    });
    //add Form Submit
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
        success:function(response){
          window.location.href="{{ route('coupon') }}";
          toastr.success(response);
          if(response["status"] == true){
            $('#coupon_name').removeClass('is-invalid')
              .siblings('p')
              .removeClass('invalid-feedback').html("");
            $('#coupon_code').removeClass('is-invalid')
              .siblings('p')
              .removeClass('invalid-feedback').html("");
            $('#discount_amount').removeClass('is-invalid')
              .siblings('p')
              .removeClass('invalid-feedback').html("");
            $('#type').removeClass('is-invalid')
              .siblings('p')
              .removeClass('invalid-feedback').html("");
            $('#status').removeClass('is-invalid')
              .siblings('p')
              .removeClass('invalid-feedback').html("");
            $('#starts_at').removeClass('is-invalid')
              .siblings('p')
              .removeClass('invalid-feedback').html("");
            $('#expires_at').removeClass('is-invalid')
              .siblings('p')
              .removeClass('invalid-feedback').html("");
          }else{
            var errors=response['errors'];
            if(errors['coupon_name']){
              $('#coupon_name').addClass('is-invalid')
              .siblings('p')
              .addClass('invalid-feedback').html(errors['coupon_name']);
            }else{
              $('#coupon_name').removeClass('is-invalid')
              .siblings('p')
              .removeClass('invalid-feedback').html("");
            }
            if(errors['coupon_code']){
              $('#coupon_code').addClass('is-invalid')
              .siblings('p')
              .addClass('invalid-feedback').html(errors['coupon_code']);
            }else{
              $('#coupon_code').removeClass('is-invalid')
              .siblings('p')
              .removeClass('invalid-feedback').html("");
            }
            if(errors['discount_amount']){
              $('#discount_amount').addClass('is-invalid')
              .siblings('p')
              .addClass('invalid-feedback').html(errors['discount_amount']);
            }else{
              $('#discount_amount').removeClass('is-invalid')
              .siblings('p')
              .removeClass('invalid-feedback').html("");
            }
            if(errors['type']){
              $('#type').addClass('is-invalid')
              .siblings('p')
              .addClass('invalid-feedback').html(errors['type']);
            }else{
              $('#type').removeClass('is-invalid')
              .siblings('p')
              .removeClass('invalid-feedback').html("");
            }
            if(errors['status']){
              $('#status').addClass('is-invalid')
              .siblings('p')
              .addClass('invalid-feedback').html(errors['status']);
            }else{
              $('#status').removeClass('is-invalid')
              .siblings('p')
              .removeClass('invalid-feedback').html("");
            }
            if(errors['expires_at']){
              $('#expires_at').addClass('is-invalid')
              .siblings('p')
              .addClass('invalid-feedback').html(errors['expires_at']);
            }else{
              $('#expires_at').removeClass('is-invalid')
              .siblings('p')
              .removeClass('invalid-feedback').html("");
            }
          }
        }
      });
    });
  </script>
  @endpush
@endsection
