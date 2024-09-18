@push('css')
@endpush
@extends('layouts.admin')
@section('admin_content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-lg-12">
            <h1 class="m-0 text-dark">Add New Banner <a href="{{ route('banner') }}" class="btn btn-danger float-right">Back</a></h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content pt-4">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Add Banner</h3>
          </div>
            @if ($errors->any())
              <div class="alert alert-warning">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
            @endif
            <!-- /.card-header -->
            <div class="card-body">
              <div class="card bg-light">
                <div class="card-header">
                  <h3 class="card-title">Banner Info</h3>
                </div>
                <div class="card-body">
                  <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      <div class="col-lg-6 mb-3">
                        <label for="type" class="form-label">Banner Type <span class="text-danger">*</span></label>
                        <select class="form-select" aria-label="Default select example" id="type" name="type">
                          <option disabled="" selected="">Select Banner Type</option>
                          <option value="Slider">Slider</option>
                          <option value="Banner">Banner</option>
                          <option value="Today Deal">Today Deal</option>
                          <option value="Fix 1">Fix 1</option>
                          <option value="Fix 2">Fix 2</option>
                          <option value="Fix 3">Fix 3</option>
                          <option value="Fix 4">Fix 4</option>
                          <option value="Fix 5">Fix 5</option>
                        </select>
                      </div>
                       <div class="col-lg-6 mb-3">
                        <label for="title" class="form-label">Banner Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" id="title">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label class="form-label" for="image">Banner Image (Small) <span class="text-danger">*</span></label>
                        <input type="file" name="image" id="image" class="form-control dropify">
                        <small class="text-muted" style="font-size: 10px;">Minimum dimensions required: 436px width x 436px height.</small>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label class="form-label" for="max_image">Banner Image (Large)</label>
                        <input type="file" name="max_image" id="max_image" class="form-control dropify">
                        <small class="text-muted" style="font-size: 10px;">Minimum dimensions required: 1370px width x 420px height (If use a single banner).</small>
                      </div>
                    </div>
                    
                    <div class="row">
                     <div class="col-lg-4 mb-3">
                        <label for="type" class="form-label">Banner Link</label>
                        <input type="text" name="link" id="link" class="form-control" placeholder="https://">
                      </div>
                      <div class="col-lg-4 mb-3">
                        <label for="alt" class="form-label">Alt</label>
                        <input type="text" name="alt" class="form-control" id="alt">
                      </div>
                       <div class="col-lg-4 mb-3">
                        <label for="sort" class="form-label">Srot <span class="text-danger">*</span></label>
                        <input type="number" name="sort" class="form-control" id="sort">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success" style="float: right;">Save</button>
                  </form>
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
 
  @endpush
@endsection
