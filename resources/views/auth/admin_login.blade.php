@extends('layouts.admin')
@section('admin_content')
<div class="hold-transition login-page">
	<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Admin</b>Panel</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Admin Login Panel</p>

      <form action="{{ route('login') }}" method="post">
      	@csrf
      	@if ($errors->any())
          	<div class="alert alert-danger">
               <ul>
               		@foreach ($errors->all() as $error)
                	   <li>{{ $error }}</li>
               		@endforeach
             	</ul>
            </div>
		    @endif
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Enter The Email address" name="email">
          <div class="input-group-append">
            <div class="input-group-text @error('email') is-invalid @enderror" autocomplete="email" autofocus>
              <span class="fas fa-envelope"></span>
            </div>
          </div>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append  @error('password') is-invalid @enderror" autocomplete="current-password">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
              <label class="form-check-label" for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-outline-success btn-block">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
</div>

@endsection