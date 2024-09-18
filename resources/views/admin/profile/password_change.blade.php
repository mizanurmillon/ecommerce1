@extends('layouts.admin')
@push('css')
@endpush
@section('admin_content')
<div class="content-wrapper">
    <!-- Main content -->
   <section class="content pt-4">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
        	<div class="col-12 col-sm-6 col-md-3 col-lg-8">
        		<div class="card card-success">
        			<div class="card-header">
		                <h3 class="card-title">Change Your Password</h3>
		            </div>
	              	<!-- /.card-header -->
        			<div class="card-body">
        				@if ($errors->any())
						    <div class="alert alert-danger">
						        <ul>
						            @foreach ($errors->all() as $error)
						                <li>{{ $error }}</li>
						            @endforeach
						        </ul>
						    </div>
						@endif
        				{{-- Psaaword change form --}}
        				<form role="form" action="{{ route('password.update') }}" method="post">
        					@csrf
						  <div class="mb-3">
						    <label for="old_password" class="form-label">Old Password</label>
						    <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Old Password">
						  </div>
						  <div class="mb-3">
						    <label for="password" class="form-label">New Password</label>
						    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="New Password" >
							    @error('password')
			                        <span class="invalid-feedback" role="alert">
			                            <strong>{{ $message }}</strong>
			                        </span>
			                    @enderror
						  </div>
						  <div class="mb-3">
						    <label for="password_confirmation" class="form-label">Confirm Password</label>
						    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
						  </div>
						  <button type="submit" class="btn btn-success btn-sm">Password Update</button>
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
