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
             <button type="submit" class="btn btn-success btn-sm float-right"  data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa fa-plus"></i> Add New Category</button>
            <h3 class="card-title">Category List</h3>
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
                          <th >Category</th>
                          <th >Type</th>
                          <th >Status</th>
                          <th >Category Icon</th>
                          <th >Cover Image</th>
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
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New Category</h1>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        {{-- @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif --}}
        <div class="modal-body">
          <form action="{{ route('category.store') }}" method="post" id="add_form" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="category_name" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="category_name" aria-describedby="emailHelp" name="category_name" required>
                <div id="emailHelp" class="form-text">This is your main category.</div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="type" class="form-label">Category Type</label>
                <select class="form-select" aria-label="Default select example" name="type">
                  <option value="Physical">Physical</option>
                  <option value="Digital">Digital</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="status" class="form-label">Category Status</label>
                <select class="form-select" aria-label="Default select example" name="status">
                  <option value="1">Active</option>
                  <option value="0">Deactive</option>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label for="banner" class="form-label">Banner <small>(200x200)</small></label>
                <input class="form-control form-control-sm" id="banner" type="file" name="banner">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="icon" class="form-label">Icon <small>(32x32)</small></label>
                <input class="form-control form-control-sm" id="icon" type="file" name="icon">
              </div>
              <div class="col-md-6 mb-3">
                <label for="formFileSm" class="form-label">Cover Image <small>(360x360)</small></label>
                <input class="form-control form-control-sm" id="formFileSm" type="file" name="cover_image">
              </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                <label for="meta_title" class="form-label">Mate Title</label>
                <input type="text" class="form-control" id="meta_title" aria-describedby="emailHelp" name="meta_title" placeholder="Mate Title">
              </div>
              <div class="col-md-6">
                <label for="meta_description" class="form-label">Mate Description</label>
                <textarea id="meta_description" name="meta_description" class="form-control" rows="3"></textarea>
              </div>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
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
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Category Update</h1>
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
    $(function category(){
       table=$('.dataTable').dataTable({
        processing:true,
        serverSide:true,
        search:true,
        ajax:"{{ route('category') }}",
        columns:[
          {data:'DT_RowIndex' , name:'DT_RowIndex'},
          {data:'category_name' , name:'category_name'},
          {data:'type' , name:'type'},
          {data:'status' , name:'status'},
          {data:'icon' , name:'icon'},
          {data:'cover_image' , name:'cover_image'},
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
      var url="{{ url('admin/category/edit') }}/"+id;
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
      $(document).on("click","#category_delete",function(e){
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
