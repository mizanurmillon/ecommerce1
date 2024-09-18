<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
   <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>AdminLTE 3 | Dashboard 2</title>
  <!-- Bootstrap css -->
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Datetimepicker css -->
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/datetimepicker/css/datetimepicker.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Toastr style link -->
  <link rel="stylesheet" type="text/css" href="{{ asset('public/backend') }}/plugins/toastr/toastr.min.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/backend') }}/plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/backend') }}/plugins/dropify/dropify.css">
  <link href="{{ asset('public/backend') }}/plugins/bootstrap5/css/bootstrap.min.css" rel="stylesheet">
  {{-- tagsinput.css --}}
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/tagsinput/bootstrap-tagsinput.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('public/backend') }}/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style type="text/css">
   /* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 23px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #dc3545;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 17px;
  width: 17px;
  left: 3px;
  bottom: 3px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #28a745;
}

input:focus + .slider {
  box-shadow: 0 0 1px #28a745;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
} 
</style>
  @stack('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  @guest
  @else
  <!-- Navbar -->
  @include('layouts.admin_partial.navbar')
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  @include('layouts.admin_partial.sidebar')
  @endguest
  <!-- Content Wrapper. Contains page content -->
  @yield('admin_content')
  <!-- /.content-wrapper -->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('public/backend') }}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap Js-->
<script src="{{ asset('public/backend') }}/plugins/bootstrap5/js/bootstrap.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
{{-- tagsinput --}}
<script src="{{ asset('public/backend') }}/plugins/tagsinput/bootstrap-tagsinput.js"></script>
<!-- Datetimepicker css -->
<script src="{{ asset('public/backend') }}/plugins/datetimepicker/js/datetimepicker.js"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('public/backend') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- Toastr Js -->
<script src="{{ asset('public/backend') }}/plugins/toastr/toastr.min.js"></script>
<!-- Summernote Js -->
<script src="{{ asset('public/backend') }}/plugins/summernote/summernote-bs4.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/sweetalert2/sweetalert.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/dropify/dropify.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('public/backend') }}/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{ asset('public/backend') }}/dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ asset('public/backend') }}/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="{{ asset('public/backend') }}/plugins/raphael/raphael.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="{{ asset('public/backend') }}/plugins/chart.js/Chart.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="{{ asset('public/backend') }}/dist/js/pages/dashboard2.js"></script>
<!-- DataTables -->
<script src="{{ asset('public/backend') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script type="text/javascript">
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script type="text/javascript">
  // Drofiy js
  $(document).ready(function() 
  {
      $('.dropify').dropify();
  });
  {{-- /* Toastr script */ --}}
  @if(Session::has('message'))
  toastr.options ={
    "progressBar" : true,
    "closeButton" : true,
  }
    var type="{{Session::get('alert-type','info')}}"
    switch(type){
    case 'info':
      toastr.info("{{ Session::get('message') }}");
      break;
    case 'success':
      toastr.success("{{ Session::get('message') }}");
      break;
    case 'warning':
      toastr.warning("{{ Session::get('message') }}");
      break;
    case 'error':
      toastr.error("{{ Session::get('message') }}");
      break;
    }
  @endif
  //summernote
  $(document).ready(function() {
    $('#summernote').summernote({
      height: 150,
    });
  });
  {{-- /*Logout Sweetalert script */ --}}
  $(document).on("click","#logout",function(e){
    e.preventDefault();
    var link = $(this).attr("href");
        swal({
            title: 'Are you Want to logout?',
            text: "",
            icon: 'warning',
            buttons: true,
            dangerMode:true,
        })
        .then((willDelete) => {
            if(willDelete){
                window.location.href = link;
            }else{
                swal("Not logout!");
            }
        });
    });
   // delete sweetalert script
   $(document).on("click","#delete",function(e){
    e.preventDefault();
    var link = $(this).attr("href");
        swal({
            title: 'Are you went to Delete?',
            text: "Once Delete , This will be Permanently Delete!",
            icon: 'warning',
            buttons: true,
            dangerMode:true,
        })
        .then((willDelete) => {
            if(willDelete){
                window.location.href = link;
            }else{
                swal("Safe Data!");
            }
        });
    });
</script>
@stack('js')
</body>
</html>
