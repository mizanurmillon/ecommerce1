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
             <button type="submit" class="btn btn-success btn-sm float-right"  data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa fa-plus"></i> Add New Post</button>
            <h3 class="card-title">Blog Category List</h3>
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
                          <th >Titie</th>
                          <th >Category</th>
                          <th >Short Description</th>
                          <th >Status</th>
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
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New Post</h1>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('blog.post.store') }}" method="post" id="add_form" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="blog_title" class="form-label">Blog Title</label>
                <input type="text" class="form-control" id="blog_title" aria-describedby="emailHelp" name="blog_title" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="type" class="form-label">Select Blog Category</label>
                <select class="form-select" aria-label="Default select example" name="blogcategory_id">
                  <option disabled="" selected="" class="text-danger">--</option>
                  @foreach($blogcategory as $row)
                  <option value="{{ $row->id }}">{{ $row->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="mb-3">
              <label for="formFileSm" class="form-label">Banner Image<small>(1300x650)</small></label>
              <input class="form-control form-control-sm" id="formFileSm" type="file" name="banner_image">
            </div>
            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="formFileSm" class="form-label">Short Description</label>
                <textarea class="form-control" name="short_description" rows="10"></textarea>
              </div>
              <div class="col-md-8 mb-3">
                <label for="formFileSm" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="summernote"></textarea>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="meta_title" class="form-label">Meta Title</label>
                <input type="text" class="form-control" id="meta_title" aria-describedby="emailHelp" name="meta_title">
              </div>
              <div class="col-md-6 mb-3">
                <label for="meta_image" class="form-label">Meta Image<small>(200x200)</small></label>
                <input class="form-control form-control-sm" id="meta_image" type="file" name="meta_image">
              </div>
            </div>
            <div class="mb-3">
              <label for="formFileSm" class="form-label">Meta Description</label>
              <textarea class="form-control" name="meta_description" rows="3"></textarea>
            </div>
            <div class="row">
              <div class="col-md-9 mb-3">
                <label for="meta_keyword" class="form-label">Meta Keywords</label>
                <input type="text" name="meta_keyword" placeholder="meta keyword" id="meta_keyword" class="form-control">
              </div>
              <div class="col-md-3">
                 <button type="submit" class="btn btn-success mt-5" style="float: right;">Submit</button>
              </div>
            </div>
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
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Post Update</h1>
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
    $(function blogpost(){
       table=$('.dataTable').dataTable({
        processing:true,
        serverSide:true,
        search:true,
        ajax:"{{ route('blog.post') }}",
        columns:[
          {data:'DT_RowIndex' , name:'DT_RowIndex'},
          {data:'blog_title' , name:'blog_title'},
          {data:'name' , name:'name'},
          {data:'short_description' , name:'short_description'},
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
      var url="{{ url('admin/blog-post/edit') }}/"+id;
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
