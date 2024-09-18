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
             <button type="submit" class="btn btn-success btn-sm float-right"  data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa fa-plus"></i> Add New Pickuppoint</button>
            <h3 class="card-title">Pickup Point List</h3>
          </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                  <div class="col-lg-12">
                    <table id="" class="table table-sm table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                      <thead>
                        <tr role="row">
                          <th >Sl</th>
                          <th >Pickuppoint Name</th>
                          <th >Address</th>
                          <th >City</th>
                          <th >State</th>
                          <th >ZipCode</th>
                          <th >Phone</th>
                          <th >Action</th>
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
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New Warehouse</h1>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('pickuppoint.store') }}" method="post" id="add_form">
            @csrf
              <div class="row">
              	<div class="col-md-6 mb-3">
	                <label for="name" class="form-label">Pickup Point</label>
	                <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name" required placeholder="pickup point">
	              </div>
	              <div class="col-md-6 mb-3">
	                <label for="address" class="form-label">Address</label>
	                <input type="text" class="form-control" id="address" aria-describedby="emailHelp" name="address" required placeholder="Enter The Address">
	              </div>
              </div>
              <div class="row">
              	<div class="col-md-6 mb-3">
	                <label for="city" class="form-label">City</label>
	                <input type="text" class="form-control" id="city" aria-describedby="emailHelp" name="city" required placeholder="city name">
	              </div>
	              <div class="col-md-6 mb-3">
	                <label for="state" class="form-label">State</label>
	                <input type="text" class="form-control" id="state" aria-describedby="emailHelp" name="state" required placeholder="state name">
	              </div>
              </div>
              <div class="row">
              	<div class="col-md-6 mb-3">
	                <label for="zip_code" class="form-label">ZipCode</label>
	                <input type="text" class="form-control" id="zip_code" aria-describedby="emailHelp" name="zip_code" placeholder="Zipcode">
	              </div>
	              <div class="col-md-6 mb-3">
	                <label for="phone" class="form-label">Phone</label>
	                <input type="text" class="form-control" id="phone" aria-describedby="emailHelp" name="phone" placeholder="Phone Namber">
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
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Pickup Point Update</h1>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="edit_part">
          
        </div>
      </div>
    </div>
  </div>
  @push('js')
  <script type="text/javascript">
    //index data showing
    $(function pickuppoint(){
       table=$('.dataTable').dataTable({
        processing:true,
        serverSide:true,
        search:true,
        ajax:"{{ route('pickuppoint') }}",
        columns:[
          {data:'DT_RowIndex' , name:'DT_RowIndex'},
          {data:'name' , name:'name'},
          {data:'address' , name:'address'},
          {data:'city' , name:'city'},
          {data:'state' , name:'state'},
          {data:'zip_code' , name:'zip_code'},
          {data:'phone' , name:'phone'},
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
        success:function(data){
          toastr.success(data);
          $('#add_form')[0].reset();
          $('.dataTable').DataTable().ajax.reload();
          $('.addModal').modal('hide');
        }
      });
    });
    //edit request send
    $('body').on('click','.edit',function(){
      var id=$(this).data('id');
      var url="{{ url('admin/pickuppoint/edit') }}/"+id;
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
