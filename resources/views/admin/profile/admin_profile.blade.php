@extends('layouts.admin')
@section('admin_content')
@push('css')
@endpush
<div class="content-wrapper">
    <!-- Main content -->
   <section class="content pt-4">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
        	<div class="col-12 col-sm-6 col-md-3 col-lg-8">
        		<div class="card">
        			<div class="card-header">
		                <h3 class="card-title"><b>Profile</b></h3>
		            </div>
	              	<!-- /.card-header -->
        			<div class="card-body">
        				{{-- Admin Form --}}
        				<form role="form" action="{{ route('admin.profile.update') }}" method="post" enctype="multipart/form-data">
        					@csrf
        					<input type="hidden" name="id" value="{{ $data->id }}">
						  <div class="mb-3">
						    <label for="name" class="form-label">Name</label>
						    <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}">
						  </div>
						  <div class="mb-3">
						    <label for="email" class="form-label">Email</label>
						    <input type="email" class="form-control" id="email" name="email" value="{{ $data->email }}">
						  </div>
						  <div class="mb-3">
						    <label for="phone" class="form-label">Phone</label>
						    <input type="text" class="form-control" id="phone" name="phone" value="{{ $data->phone }}">
						  </div>
						  <div class="mb-3">
						    <label for="avatar" class="form-label">Avatar (90x90)</label>
						    <input type="file" class="form-control dropify" id="avatar" name="avatar" data-default-file="{{ asset('public/files/admin/profile/'.$data->avatar) }}">
						    <input type="hidden" name="old_avater" value="{{ $data->avatar }}">
						  </div>
						  <button type="submit" class="btn btn-success" style="float: right;">Save</button>
						</form>
        			</div>
        		</div>
        	</div>
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @push('js')
	@endpush
@endsection
