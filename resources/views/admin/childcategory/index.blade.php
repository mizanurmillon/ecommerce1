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
             <button type="submit" class="btn btn-success btn-sm float-right"  data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa fa-plus"></i> Add New Childcategory</button>
            <h3 class="card-title">Childcategory List</h3>
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
                          <th >Category Name</th>
                          <th >Subcategory Name</th>
                          <th >Childcategory Name</th>
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
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New Childcategory</h1>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('childcategory.store') }}" method="post" id="add_form">
            @csrf
              <div class="mb-3">
                <label for="type" class="form-label">Select Category / Subcategory</label>
                <select class="form-select" aria-label="Default select example" name="subcategory_id" required>
                  <option disabled="" selected="" class="text-danger">Select Category / Subcategory</option>
                  @foreach($category as $row)
                  @php
                  $subcategory=DB::table('subcategories')->where('category_id',$row->id)->get();
                  @endphp
                  <option disabled="">{{ $row->category_name }}</option>
                    @foreach($subcategory as $row)
                    <option value="{{ $row->id }}">---{{ $row->subcategory_name }}</option>
                    @endforeach
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label for="childcategory_name" class="form-label">Childcategory Name</label>
                <input type="text" class="form-control" id="childcategory_name" aria-describedby="emailHelp" name="childcategory_name" required>
              </div>
            <button type="submit" class="btn btn-success" style="float: right;">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  {{-- Edit Modal --}}
  <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Childcategory Update</h1>
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
    $(function childcategory(){
       table=$('.dataTable').dataTable({
        processing:true,
        serverSide:true,
        search:true,
        ajax:"{{ route('childcategory') }}",
        columns:[
          {data:'DT_RowIndex' , name:'DT_RowIndex'},
          {data:'category_name' , name:'category_name'},
          {data:'subcategory_name' , name:'subcategory_name'},
          {data:'childcategory_name' , name:'childcategory_name'},
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
      var url="{{ url('admin/childcategory/edit') }}/"+id;
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
