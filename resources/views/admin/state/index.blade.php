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
             <button type="submit" class="btn btn-success btn-sm float-right"  data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa fa-plus"></i> Add New State</button>
            <h3 class="card-title">States All</h3>
          </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="row">
                      <div class="col-md-4 mb-3">
                        <input type="text" class="form-control submitable_input" id="state" aria-describedby="emailHelp" name="state" placeholder="Type state name">
                      </div>
                      <div class="col-md-4 mb-3">
                      <select class="form-select submitable" aria-label="Default select example" id="country_id" name="country_id">
                        <option value="" selected="selected">select country</option>
                        @foreach($country as $row)
                        <option value="{{ $row->id }}">{{ $row->country_name }}</option>
                        @endforeach
                      </select>
                    </div>
                    </div>
                    <table id="" class="table table-sm table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                      <thead>
                        <tr role="row">
                          <th >Sl</th>
                          <th >Name</th>
                          <th >Country</th>
                          <th >Show / Hide</th>
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
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New State</h1>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('shipping.state.store') }}" method="post" id="add_form">
            @csrf
              <div class="mb-3">
                <label for="state" class="form-label">State Name</label>
                <input type="text" class="form-control" id="state" aria-describedby="emailHelp" name="state" required="required">
              </div>
              <div class="mb-3">
                <label for="country_code" class="form-label">Country</label>
                <select class="form-select" aria-label="Default select example" name="country_id">
                  @foreach($country as $row)
                  <option value="{{ $row->id }}">{{ $row->country_name }}</option>
                  @endforeach
                </select>
              </div>
            <button type="submit" class="btn btn-success">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  {{-- Edit Modal --}}
  <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">State Edit</h1>
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
    $(function state(){
       table=$('.dataTable').dataTable({
        "processing":true,
        "serverSide":true,
        "search":true,
        "ajax":{
          "url":"{{ route('shipping.state') }}",
          "data":function(e){
            e.state=$("#state").val();
            e.country_id=$("#country_id").val();
          }
        },
        columns:[
          {data:'DT_RowIndex' , name:'DT_RowIndex'},
          {data:'state' , name:'state'},
          {data:'country_name' , name:'country_name'},
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
      var url="{{ url('admin/shipping-state/edit') }}/"+id;
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

    //Hide status ----
       $('body').on('click','#state_show',function(){
          var id=$(this).data('id');
          var url="{{ url('admin/shipping-state/hide') }}/"+id;
          $.ajax({
            url:url,
            type:'get',
            success:function(data){
              toastr.warning(data);
              $('.dataTable').DataTable().ajax.reload();
            }
          });
       });
      
       //Show Counter status---
       $('body').on('click','#state_hide',function(){
            var id=$(this).data('id');
            var url="{{ url('admin/shipping-state/show') }}/"+id;
            $.ajax({
              url:url,
              type:'get',
              success:function(data){
                toastr.success(data);
                $('.dataTable').DataTable().ajax.reload();
              }
            });
        });

       //submitable class call for every change
       $(document).on('change','.submitable',function(){
          $('.dataTable').DataTable().ajax.reload();
       });
       $(document).on('blur','.submitable_input',function(){
          $('.dataTable').DataTable().ajax.reload();
       });
  </script>
  @endpush
@endsection
