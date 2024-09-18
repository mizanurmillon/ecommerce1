@if(Session::has('error'))
<div class="alert alert-warning alert-dismissible" role="alert">
  <strong>Error!</strong>{{ Session::get('error') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(Session::has('success'))
<div class="alert alert-success alert-dismissible" role="alert">
  <strong>Success!</strong>{{ Session::get('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
