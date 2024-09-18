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
          	<a href="{{ route('campaing') }}" class="btn btn-danger btn-sm" style="float:right;">Campaing</a>
            <h3 class="card-title">Campaing Edit Form</h3>
          </div>
            <!-- /.card-header -->
            <div class="card-body">
              	<form action="{{ route('campaing.update') }}" method="post" id="edit_form" enctype="multipart/form-data">
		            @csrf
		            <input type="hidden" name="id" value="{{ $data->id }}">
		            <div class="row">
		            	<div class="col-md-6 mb-3">
			                <label for="campaing_title" class="form-label">Campaing Title</label>
			                <input type="text" class="form-control" id="campaing_title" aria-describedby="emailHelp" name="campaing_title" placeholder="Campaing Title" value="{{ $data->campaing_title }}">
		                  <p></p>
			            </div>
			            <div class="col-md-6 mb-3">
		                  <label for="discount_amount" class="form-label">Discount Amount</label>
		                  <input type="text" class="form-control" id="discount_amount" aria-describedby="emailHelp" name="discount_amount" placeholder="Discount Amount" value="{{ $data->discount_amount }}">
		                  <p></p>
		              </div>
		            </div>
		            <div class="row">
			            <div class="col-md-6 mb-3">
			                <label for="coupon_code" class="form-label">Type</label>
			                <select class="form-select" aria-label="Default select example" name="type" id="type"> 
			                  <option disabled="" selected="">--</option>
			                  <option value="percent" @if($data->type=='percent') selected="" @endif>Percent</option>
			                  <option value="fixed" @if($data->type=='fixed') selected="" @endif>Fixed</option>
			                </select>
		                  <p></p>
			            </div>
		              <div class="col-md-6 mb-3">
		                  <label for="coupon_code" class="form-label">Status</label>
		                  <select class="form-select" aria-label="Default select example" name="status" id="status">
		                    <option disabled="" selected="">--</option>
		                    <option value="1" @if($data->status==1) selected="" @endif>Active</option>
		                    <option value="0" @if($data->status==0) selected="" @endif>Block</option>
		                  </select>
		                  <p></p>
		              </div>
		            </div>
		            <div class="row">
			            <div class="col-md-6 mb-3">
			                <label for="starts_date" class="form-label">Starts Date</label>
			                <input type="text" class="form-control" id="starts_date" aria-describedby="emailHelp" name="starts_at" autocomplete="off" value="{{ $data->starts_at }}">
		                  <p></p>
			            </div>
		              <div class="col-md-6 mb-3">
		                  <label for="ends_date" class="form-label">Ends Date</label>
		                  <input type="text" class="form-control" id="ends_date" aria-describedby="emailHelp" name="ends_at" autocomplete="off" value="{{ $data->ends_at }}">
		                  <p></p>
		              </div>
		            </div>
		            <div class="mb-3">
		                <label for="image" class="form-label">Campaing Banner</label>
		                <input class="form-control form-control-sm dropify" id="image" type="file" name="image" data-default-file="{{ asset('public/files/campaing/'.$data->image) }}">
		                <input type="hidden" name="old_image" value="{{ $data->image }}">
		              </div>
		            <button type="submit" class="btn btn-success" style="float: right;">Update</button>
	          	</form>
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
      $('#starts_date').datetimepicker({
          format:'Y-m-d H:i:s',
      });

      $('#ends_date').datetimepicker({
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
          window.location.href="{{ route('campaing') }}";
          toastr.success(response);
          if(response["status"] == true){
            $('#campaing_title').removeClass('is-invalid')
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
            $('#ends_at').removeClass('is-invalid')
              .siblings('p')
              .removeClass('invalid-feedback').html("");

          }else{
            var errors=response['errors'];
            if(errors['campaing_title']){
              $('#campaing_title').addClass('is-invalid')
              .siblings('p')
              .addClass('invalid-feedback').html(errors['campaing_title']);
            }else{
              $('#campaing_title').removeClass('is-invalid')
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
            if(errors['ends_at']){
              $('#ends_at').addClass('is-invalid')
              .siblings('p')
              .addClass('invalid-feedback').html(errors['ends_at']);
            }else{
              $('#ends_at').removeClass('is-invalid')
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
