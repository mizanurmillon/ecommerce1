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
             <a href="{{ route('create.product') }}" class="btn btn-success btn-sm float-right"><i class="fa fa-plus"></i> Add New Product</a>
            <h3 class="card-title">Digital Products List</h3>
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
                          <th >Sl</th>
                          <th >Image</th>
                          <th >Title</th>
                          <th>Type</th>
                          <th >Featured</th>
                          <th >Today Deal</th>
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
  @push('js')
  <script type="text/javascript">
    //index data showing
    $(function product(){
       table=$('.dataTable').dataTable({
        "processing":true,
        "serverSide":true,
        "search":true,
        "ajax":{
          "url":"{{ route('product') }}",
          "data":function(e){
            e.title=$("#title").val();
            e.category_id=$("#category_id").val();
            e.subcategory_id=$("#subcategory_id").val();
            e.brand_id=$("#brand_id").val();
          }
        },
        columns:[
          {data:'DT_RowIndex' , name:'DT_RowIndex'},
          {data:'thumbnail' , name:'thumbnail'},
          {data:'title' , name:'title'},
          {data:'type' , name:'type'},
          {data:'featured' , name:'featured'},
          {data:'today_deal' , name:'today_deal'},
          {data:'status' , name:'status'},
          {data:'action' , name:'action'},
        ]
      });
    });
    //delete specific Product
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
        var url="{{ url('admin/product/status-active') }}/"+id;
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
          var url="{{ url('admin/product/status-deactive') }}/"+id;
          $.ajax({
            url:url,
            type:'get',
            success:function(data){
              toastr.success(data);
              $('.dataTable').DataTable().ajax.reload();
            }
          });
        });
      //Active product featured ----
       $('body').on('click','#featured_active',function(){
          var id=$(this).data('id');
          var url="{{ url('admin/product/featured-active') }}/"+id;
          $.ajax({
            url:url,
            type:'get',
            success:function(data){
              toastr.warning(data);
              $('.dataTable').DataTable().ajax.reload();
            }
          });
       });
      
       //Deactive product featured---
       $('body').on('click','#featured_deactive',function(){
            var id=$(this).data('id');
            var url="{{ url('admin/product/featured-deactive') }}/"+id;
            $.ajax({
              url:url,
              type:'get',
              success:function(data){
                toastr.success(data);
                $('.dataTable').DataTable().ajax.reload();
              }
            });
          });
       //Active product today deal ----
       $('body').on('click','#today_deal_active',function(){
          var id=$(this).data('id');
          var url="{{ url('admin/product/today-deal-active') }}/"+id;
          $.ajax({
            url:url,
            type:'get',
            success:function(data){
              toastr.success(data);
              $('.dataTable').DataTable().ajax.reload();
            }
          });
       });
      
       //Deactive product featured---
       $('body').on('click','#today_deal_deactive',function(){
            var id=$(this).data('id');
            var url="{{ url('admin/product/today-deal-deactive') }}/"+id;
            $.ajax({
              url:url,
              type:'get',
              success:function(data){
                toastr.warning(data);
                $('.dataTable').DataTable().ajax.reload();
              }
            });
          });
  </script>
  @endpush
@endsection
