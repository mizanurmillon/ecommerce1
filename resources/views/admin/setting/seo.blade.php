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
            <h3 class="card-title">SEO Setting</h3>
          </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="{{ route('seo.setting.update',$data->id) }}" method="post">
                @csrf
                <div class="row">
                  <div class="col-md-8 m-auto">
                    <div class="mb-3">
                      <label for="meta_title" class="form-label">Meta Title</label>
                      <input type="text" class="form-control" id="meta_title" aria-describedby="emailHelp" name="meta_title" value="{{ $data->meta_title }}">
                    </div>
                  </div>
                  <div class="col-md-8 m-auto">
                    <div class="mb-3">
                      <label for="meta_author" class="form-label">Meta Author</label>
                      <input type="text" class="form-control" id="meta_author" aria-describedby="emailHelp" name="meta_author" value="{{ $data->meta_author }}">
                    </div>
                  </div>
                  <div class="col-md-8 m-auto">
                    <div class="mb-3">
                      <label for="meta_tag" class="form-label">Meta Tag</label>
                      <input type="text" class="form-control" id="meta_tag" aria-describedby="emailHelp" name="meta_tag" value="{{ $data->meta_tag }}">
                    </div>
                  </div>
                  <div class="col-md-8 m-auto">
                    <div class="mb-3">
                      <label for="meta_keyword" class="form-label">Meta Keyword</label>
                      <input type="text" class="form-control" id="meta_keyword" aria-describedby="emailHelp" name="meta_keyword" value="{{ $data->meta_keyword }}">
                    </div>
                  </div>
                  <div class="col-md-8 m-auto">
                    <div class="mb-3">
                      <label for="meta_description" class="form-label">Meta Description</label>
                      <textarea class="form-control " name="meta_description" id="summernote">{{ $data->meta_description }}</textarea>
                    </div>
                  </div>
                  <div class="col-md-8 m-auto">
                    <div class="mb-3">
                      <label for="google_verification" class="form-label">Google Verification</label>
                      <input type="text" class="form-control" id="google_verification" aria-describedby="emailHelp" name="google_verification" value="{{ $data->google_verification }}">
                    </div>
                  </div>
                  <div class="col-md-8 m-auto">
                    <div class="mb-3">
                      <label for="alexa_verification" class="form-label">Alexa Verification</label>
                      <input type="text" class="form-control" id="alexa_verification" aria-describedby="emailHelp" name="alexa_verification" value="{{ $data->alexa_verification }}">
                    </div>
                  </div>
                  <div class="col-md-8 m-auto">
                    <div class="mb-3">
                      <label for="google_analytics" class="form-label">Google Analytics</label>
                      <input type="text" class="form-control" id="google_analytics" aria-describedby="emailHelp" name="google_analytics" value="{{ $data->google_analytics }}">
                    </div>
                  </div>
                  <div class="col-md-8 m-auto">
                    <div class="mb-3">
                      <label for="google" class="form-label">Google Adsense</label>
                      <input type="text" name="google_adsense" id="google" class="form-control" value="{{ $data->google_adsense }}">
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                  </div>
                </div>
              </form>
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
