@push('css')
@endpush
@extends('layouts.admin')
@section('admin_content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Website Setting</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content pt-4">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
          <div class="col-md-8 mx-auto">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Website Setting Info</h3>
              </div>
              <div class="card-body">
                <form action="{{ route('website.update',$website->id) }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="mb-3">
                    <label for="header_logo" class="form-label">Header Logo</label>
                    <input class="form-control" type="file" id="File" name="header_logo">
                    <input type="hidden" name="old_header_logo" value="{{ $website->header_logo }}">
                    <img src="{{ asset('public/files/website/'.$website->header_logo) }}" width="244" height="40" class="mt-1"><br>
                      <small class="text-muted" style="font-size: 10px;">Minimum dimensions required: 244px width X 40px height.</small>
                  </div>
                  <div class="mb-3">
                      <label for="language" class="form-label">Language</label>
                      <select class="form-select" aria-label="Default select example" name="language_id" id="language"> 
                        @foreach($language as $lang)
                        <option value="{{ $lang->id }}" @if($lang->id==$website->language_id) selected="" @endif>{{ $lang->name }}</option>
                        @endforeach
                      </select>
                  </div>
                  <div class="mb-3">
                      <label for="currency" class="form-label">Currency</label>
                      <select class="form-select" aria-label="Default select example" name="currency_id" id="currency"> 
                        @foreach($currency as $curr)
                        <option value="{{ $curr->id }}" @if($lang->id==$website->currency_id) selected="" @endif>{{ $curr->name }}</option>
                        @endforeach
                      </select>
                  </div>
                  <div class="mb-3">
                    <label for="banner" class="form-label">Topbar Banner Large</label>
                    <input class="form-control" type="file" id="File" name="banner_large">
                    <input type="hidden" name="old_banner_large" value="{{ $website->banner_large }}">
                    <img src="{{ asset('public/files/website/banner/'.$website->banner_large) }}" width="428" height="40" class="mt-1"><br>
                      <small class="text-muted" style="font-size: 10px;">Will be shown in large device. Minimum dimensions required: 1920px width X 60px height.</small>
                  </div>
                  <div class="mb-3">
                    <label for="banner" class="form-label">Topbar Banner Medium</label>
                    <input class="form-control" type="file" id="File" name="banner_medium">
                    <input type="hidden" name="old_banner_medium" value="{{ $website->banner_medium }}">
                    <img src="{{ asset('public/files/website/banner/'.$website->banner_medium) }}" width="428" height="40" class="mt-1"><br>
                      <small class="text-muted" style="font-size: 10px;">Will be shown in medium device. Minimum dimensions required: 810px width X 40px height.</small>
                  </div>
                  <div class="mb-3">
                    <label for="header_logo" class="form-label">Topbar Banner Small</label>
                    <input class="form-control" type="file" id="File" name="banner_small">
                    <input type="hidden" name="old_banner_small" value="{{ $website->banner_small }}">
                    <img src="{{ asset('public/files/website/banner/'.$website->banner_small) }}" width="428" height="40" class="mt-1"><br>
                      <small class="text-muted" style="font-size: 10px;">Will be shown in small device. Minimum dimensions required: 428px width X 40px height.</small>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="banner_link">Topbar Banner Link</label>
                    <input type="text" name="banner_link" id="banner_link" value="{{ $website->banner_link }}" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" value="{{ $website->phone }}" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="main_email">Main Email</label>
                    <input type="email" name="main_email" id="main_email" value="{{ $website->main_email }}" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="support_email">Support Email</label>
                    <input type="email" name="support_email" id="support_email" value="{{ $website->support_email }}" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="address">Address</label>
                    <input type="text" name="address" id="address" value="{{ $website->address }}" class="form-control">
                  </div>
                  <button type="submit" class="btn btn-success" style="float: right;">Update</button>
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
    //summernote
    $(document).ready(function() {
      $('.summernote').summernote({
        height: 200,
      });
    });
  </script>
  @endpush
@endsection
