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
             <button type="submit" class="btn btn-success btn-sm float-right"  data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa fa-plus"></i> Add New Coupon</button>
            <h3 class="card-title">Coupon Code List</h3>
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
                          <th>Coupon Code</th>
                          <th>Coupon Name</th>
                          <th>Discount Amount</th>
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
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New Coupon Code</h1>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('coupon.store') }}" method="post" id="add_form" enctype="multipart/form-data">
            @csrf
            <div class="row">
            	<div class="col-md-4 mb-3">
	                <label for="coupon_name" class="form-label">Coupon Name</label>
	                <input type="text" class="form-control" id="coupon_name" aria-describedby="emailHelp" name="coupon_name" placeholder="Coupon Name">
                  <p></p>
	            </div>
	            <div class="col-md-4 mb-3">
	                <label for="coupon_code" class="form-label">Coupon Code</label>
	                <input type="text" class="form-control" id="coupon_code" aria-describedby="emailHelp" name="coupon_code" placeholder="Coupon code">
                  <p></p>
	            </div>
	            <div class="col-md-4 mb-3">
	                <label for="max_uses" class="form-label">Max Uses</label>
	                <input type="number" class="form-control" id="max_uses" aria-describedby="emailHelp" name="max_uses">
                  <p></p>
	            </div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description"></textarea>
                <p></p>
            </div>
            <div class="row">
            	<div class="col-md-4 mb-3">
	                <label for="max_uses_user" class="form-label">Max Uses User</label>
	                <input type="number" class="form-control" id="max_uses_user" aria-describedby="emailHelp" name="max_uses_user">
                  <p></p>
	            </div>
	            <div class="col-md-4 mb-3">
	                <label for="coupon_code" class="form-label">Type</label>
	                <select class="form-select" aria-label="Default select example" name="type" id="type"> 
	                  <option disabled="" selected="">--</option>
	                  <option value="percent">Percent</option>
	                  <option value="fixed">Fixed</option>
	                </select>
                  <p></p>
	            </div>
	            <div class="col-md-4 mb-3">
	                <label for="discount_amount" class="form-label">Discount Amount</label>
	                <input type="text" class="form-control" id="discount_amount" aria-describedby="emailHelp" name="discount_amount" placeholder="Discount Amount">
                  <p></p>
	            </div>
            </div>
            <div class="row">
            	<div class="col-md-4 mb-3">
	                <label for="min_amount" class="form-label">Min Amount</label>
	                <input type="text" class="form-control" id="min_amount" aria-describedby="emailHelp" name="min_amount">
                  <p></p>
	            </div>
	            <div class="col-md-4 mb-3">
	                <label for="coupon_code" class="form-label">Status</label>
	                <select class="form-select" aria-label="Default select example" name="status" id="status">
	                  <option disabled="" selected="">--</option>
	                  <option value="1">Active</option>
	                  <option value="0">Block</option>
	                </select>
                  <p></p>
	            </div>
	            <div class="col-md-4 mb-3">
	                <label for="starts_at" class="form-label">Starts At</label>
	                <input type="text" class="form-control" id="starts_at" aria-describedby="emailHelp" name="starts_at" autocomplete="off">
                  <p></p>
	            </div>
            </div>
            <div class="row">
            	<div class="col-md-6 mb-3">
	                <label for="expires_at" class="form-label">Expires At</label>
	                <input type="text" class="form-control" id="expires_at" aria-describedby="emailHelp" name="expires_at" autocomplete="off">
                  <p></p>
	            </div>
            </div>
            <button type="submit" class="btn btn-success" style="float: right;">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  {{-- Edit Modal --}}
  <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Coupon Code Update</h1>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="edit_part">
          
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

      $('#expires_at').datetimepicker({
          format:'Y-m-d H:i:s',
      });
  	});
    //index data showing
    $(function coupon(){
       table=$('.dataTable').dataTable({
        processing:true,
        serverSide:true,
        search:true,
        ajax:"{{ route('coupon') }}",
        columns:[
          {data:'DT_RowIndex' , name:'DT_RowIndex'},
          {data:'coupon_code' , name:'coupon_code'},
          {data:'coupon_name' , name:'coupon_name'},
          {data:'discount_amount' , name:'discount_amount'},
          {data:'starts_at' , name:'starts_at'},
          {data:'expires_at' , name:'expires_at'},
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
            $('.dataTable').DataTable().ajax.reload();
            $('.addModal').modal('hide');
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
            if(errors['starts_at']){
              $('#starts_at').addClass('is-invalid')
              .siblings('p')
              .addClass('invalid-feedback').html(errors['starts_at']);
            }else{
              $('#starts_at').removeClass('is-invalid')
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
    //edit request send
    $('body').on('click','.edit',function(){
      var id=$(this).data('id');
      var url="{{ url('admin/coupon/edit') }}/"+id;
      $.ajax({
        url:url,
        type:'get',
        success:function(data){
          $('#edit_part').html(data);
        }
      })
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
