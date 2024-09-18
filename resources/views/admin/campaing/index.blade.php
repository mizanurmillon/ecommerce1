@extends('layouts.admin')
@push('css')
@endpush
@section('admin_content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content pt-4">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="card">
          <div class="card-header">
             <button type="submit" class="btn btn-success btn-sm float-right"  data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa fa-plus"></i> Add New Campaing</button>
            <h3 class="card-title">Campaing List</h3>
          </div>
          @include('admin.message')
            <!-- /.card-header -->
            <div class="card-body">
              <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                  <div class="col-lg-12">
                    <table id="" class="table table-sm table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                      <thead>
                        <tr role="row">
                          <th>Sl</th>
                          <th>Campaing Title</th>
                          <th>Discount Amount</th>
                          <th>Image</th>
                          <th>Start Date</th>
                          <th>Expires Date</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr role="row">
                          
                        </tr>
                      </tbody>
                    </table>
                    <form id="delete_form" action="" method="post">
                      @method('DELETE')
                      @csrf
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
  <!--Add Modal -->
  <div class="modal fade addModal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New Campaing</h1>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('campaing.store') }}" method="post" id="add_form" enctype="multipart/form-data">
            @csrf
            <div class="row">
            	<div class="col-md-6 mb-3">
	                <label for="campaing_title" class="form-label">Campaing Title</label>
	                <input type="text" class="form-control" id="campaing_title" aria-describedby="emailHelp" name="campaing_title" placeholder="Campaing Title">
                  <p></p>
	            </div>
	            <div class="col-md-6 mb-3">
                  <label for="discount_amount" class="form-label">Discount Amount</label>
                  <input type="text" class="form-control" id="discount_amount" aria-describedby="emailHelp" name="discount_amount" placeholder="Discount Amount">
                  <p></p>
              </div>
            </div>
            <div class="row">
	            <div class="col-md-6 mb-3">
	                <label for="coupon_code" class="form-label">Type</label>
	                <select class="form-select" aria-label="Default select example" name="type" id="type"> 
	                  <option disabled="" selected="">--</option>
	                  <option value="percent">Percent</option>
	                  <option value="fixed">Fixed</option>
	                </select>
                  <p></p>
	            </div>
              <div class="col-md-6 mb-3">
                  <label for="coupon_code" class="form-label">Status</label>
                  <select class="form-select" aria-label="Default select example" name="status" id="status">
                    <option disabled="" selected="">--</option>
                    <option value="1">Active</option>
                    <option value="0">Block</option>
                  </select>
                  <p></p>
              </div>
            </div>
            <div class="row">
	            <div class="col-md-6 mb-3">
	                <label for="starts_at" class="form-label">Starts Date</label>
	                <input type="text" class="form-control" id="starts_at" aria-describedby="emailHelp" name="starts_at" autocomplete="off">
                  <p></p>
	            </div>
              <div class="col-md-6 mb-3">
                  <label for="ends_at" class="form-label">Ends Date</label>
                  <input type="text" class="form-control" id="ends_at" aria-describedby="emailHelp" name="ends_at" autocomplete="off">
                  <p></p>
              </div>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Campaing Banner</label>
                <input class="form-control form-control-sm dropify" id="image" type="file" name="image">
              </div>
            <button type="submit" class="btn btn-success" style="float: right;">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  @push('js')
  <script type="text/javascript">
  	$(document).ready(function(){
      $('#starts_at').datetimepicker({
          format:'Y-m-d H:i:s',
      });

      $('#ends_at').datetimepicker({
          format:'Y-m-d H:i:s',
      });
  	});
    //index data showing
    $(function coupon(){
       table=$('.dataTable').dataTable({
        processing:true,
        serverSide:true,
        search:true,
        ajax:"{{ route('campaing') }}",
        columns:[
          {data:'DT_RowIndex' , name:'DT_RowIndex'},
          {data:'campaing_title' , name:'campaing_title'},
          {data:'discount_amount' , name:'discount_amount'},
          {data:'image' , name:'image'},
          {data:'starts_at' , name:'starts_at'},
          {data:'ends_at' , name:'ends_at'},
          {data:'status' , name:'status'},
          {data:'action' , name:'action'},
        ]
      });
    });
    //add Form Submit
    $('#add_form').submit(function(e){
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
          if(response["status"] == true){
            toastr.success(response);
            $('#add_form')[0].reset();
            $(".dropify-clear").trigger("click");
            $('.dataTable').DataTable().ajax.reload();
            $('.addModal').modal('hide');
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
            $('#starts_at').removeClass('is-invalid')
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
            if(errors['starts_at']){
              $('#starts_at').addClass('is-invalid')
              .siblings('p')
              .addClass('invalid-feedback').html(errors['starts_at']);
            }else{
              $('#starts_at').removeClass('is-invalid')
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
    //delete specific category
    $(document).ready(function(){
      $(document).on("click","#delete",function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        $("#delete_form").attr('action',url);
        swal({
          title: 'Are you went to Delete?',
          text: "Once deleted, you will not be able to recover this imaginary file!",
          icon: 'warning',
          buttons: true,
          dangerMode:true,
        })
        .then((willDelete)=>{
          if (willDelete){
             $("#delete_form").submit();
          }else{
            swal('Safe Data!')
          }
        });
      });
      //Data passed through here
      $("#delete_form").submit(function(e){
        e.preventDefault();
         var url = $(this).attr('action');
         var request = $(this).serialize();
         $.ajax({
            url:url,
            type:'post',
            async:false,
            data:request,
            success:function(data){
              toastr.error(data);
              $('#delete_form')[0].reset();
              $('.dataTable').DataTable().ajax.reload();
            }
         });
      });
    });
  </script>
  @endpush
@endsection
