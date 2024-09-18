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
             <a href="{{ route('banner.create') }}" class="btn btn-success btn-sm float-right"><i class="fa fa-plus"></i> Add New Banner</a>
            <h3 class="card-title">Banners List</h3>
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
                          <th>Image</th>
                          <th>Type</th>
                          <th>Link</th>
                          <th>Title</th>
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
  @push('js')
  <script type="text/javascript">
  	
    //index data showing
    $(function banner(){
       table=$('.dataTable').dataTable({
        processing:true,
        serverSide:true,
        search:true,
        ajax:"{{ route('banner') }}",
        columns:[
          {data:'DT_RowIndex' , name:'DT_RowIndex'},
          {data:'image' , name:'image'},
          {data:'type' , name:'type'},
          {data:'link' , name:'link'},
          {data:'title' , name:'title'},
          {data:'status' , name:'status'},
          {data:'action' , name:'action'},
        ]
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

    //Active product status ----
     $('body').on('click','#status_active',function(){
        var id=$(this).data('id');
        var url="{{ url('admin/banner/active') }}/"+id;
        $.ajax({
          url:url,
          type:'get',
          success:function(data){
            toastr.warning(data);
            $('.dataTable').DataTable().ajax.reload();
          }
        });
     });
    //Deactive product status---
     $('body').on('click','#status_deactive',function(){
        var id=$(this).data('id');
        var url="{{ url('admin/banner/deactive') }}/"+id;
        $.ajax({
          url:url,
          type:'get',
          success:function(data){
            toastr.success(data);
            $('.dataTable').DataTable().ajax.reload();
          }
        });
      });
    
  </script>
  @endpush
@endsection
