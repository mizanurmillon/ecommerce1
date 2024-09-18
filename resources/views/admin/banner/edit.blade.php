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
            <h1 class="m-0 text-dark">Banner Edit<a href="{{ route('banner') }}" class="btn btn-danger float-right">Back</a></h1>
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
            <h3 class="card-title">Edit Banner</h3>
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
                  <form action="{{ route('banner.update',$data->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      <div class="col-lg-6 mb-3">
                        <label for="type" class="form-label">Banner Type <span class="text-danger">*</span></label>
                        <select class="form-select" aria-label="Default select example" id="type" name="type">
                          <option disabled="" selected="">Select Banner Type</option>
                          <option value="Slider" @if($data->type=="Slider") selected="" @endif>Slider</option>
                          <option value="Slider" @if($data->type=="Banner") selected="" @endif>Banner</option>
                          <option value="Today Deal" @if($data->type=="Today Deal") selected="" @endif>Today Deal</option>
                          <option value="Fix 1" @if($data->type=="Fix 1") selected="" @endif>Fix 1</option>
                          <option value="Fix 2" @if($data->type=="Fix 2") selected="" @endif>Fix 2</option>
                          <option value="Fix 3" @if($data->type=="Fix 3") selected="" @endif>Fix 3</option>
                          <option value="Fix 4" @if($data->type=="Fix 4") selected="" @endif>Fix 4</option>
                          <option value="Fix 5" @if($data->type=="Fix 5") selected="" @endif>Fix 5</option>
                        </select>
                      </div>
                       <div class="col-lg-6 mb-3">
                        <label for="title" class="form-label">Banner Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" id="title" value="{{ $data->title }}">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label class="form-label" for="image">Banner Image (Small) <span class="text-danger">*</span></label>
                        <input type="file" name="image" id="image" class="form-control dropify" data-default-file="{{ asset('public/files/banner/small/'.$data->image) }}">
                        <input type="hidden" name="old_image" value="{{ $data->image }}">
                        <div class="img mt-2">
                          <img src="{{ asset('public/files/banner/small/'.$data->image) }}" alt="" style="width:100px; height: 80px;">
                          <button type="button" class="remove-file btn btn-danger btn-sm" style="border: none; margin-left: 10px; margin-bottom: 5px;">X</button>
                          </div>
                          <small class="text-muted" style="font-size: 10px;">Minimum dimensions required: 436px width x 436px height.</small>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label class="form-label" for="max_image">Banner Image (Large)</label>
                        <input type="file" name="max_image" id="max_image" class="form-control dropify" data-default-file="{{ asset('public/files/banner/big/'.$data->max_image) }}">
                        <input type="hidden" name="old_max_image" value="{{ $data->max_image }}">
                        <div class="img mt-2">
                          <img src="{{ asset('public/files/banner/big/'.$data->max_image) }}" alt="" style="width:200px; height: 50px;">
                          <button type="button" class="remove-file btn btn-danger btn-sm" style="border: none; margin-left: 10px; margin-bottom: 5px;">X</button>
                        </div>
                        <small class="text-muted" style="font-size: 10px;">Minimum dimensions required: 1370px width x 420px height (If use a single banner).</small>
                      </div>
                    </div>
                    
                    <div class="row">
                     <div class="col-lg-4 mb-3">
                        <label for="type" class="form-label">Banner Link</label>
                        <input type="text" name="link" id="link" class="form-control" placeholder="https://" value="{{ $data->link }}">
                      </div>
                      <div class="col-lg-4 mb-3">
                        <label for="alt" class="form-label">Alt</label>
                        <input type="text" name="alt" class="form-control" id="alt" value="{{ $data->alt }}">
                      </div>
                       <div class="col-lg-4 mb-3">
                        <label for="sort" class="form-label">Srot <span class="text-danger">*</span></label>
                        <input type="number" name="sort" class="form-control" id="sort" value="{{ $data->sort }}">
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
  <script>
    // remove-file Image 
    $('.remove-file').on('click',function(){
      $(this).parents(".img").remove();
    });
  </script>
  @endpush
@endsection
