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
            <h1 class="m-0 text-dark">Website Footer</h1>
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
            <h3 class="card-title">Footer Widget</h3>
          </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="card bg-light">
                <div class="card-header">
                  <h3 class="card-title">Footer Info Widget</h3>
                </div>
                <div class="card-body">
                  <form action="{{ route('footer.widget.update',$footer->id) }}" method="post">
                    @csrf
                    <div class="mb-3">
                      <label for="title" class="form-label">Title (Translatable)</label>
                      <input type="text" class="form-control" id="title" name="title" value="{{ $footer->title }}">
                    </div>
                    <div class="mb-3">
                      <label for="description" class="form-label">Footer description (Translatable)</label>
                      <textarea class="form-control" id="description" rows="6" name="description">{{ $footer->description }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-success" style="float: right;">Update</button>
                  </form>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="card bg-light">
                    <div class="card-header">
                      <h3 class="card-title">About Widget</h3>
                    </div>
                    <div class="card-body">
                      <form action="{{ route('about.widget.update',$about->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                          <label for="formFile" class="form-label">Footer Logo</label>
                          <input class="form-control" type="file" id="formFile" name="footer_logo">
                          <input type="hidden" name="old_footer_logo" value="{{ $about->footer_logo }}">
                          <img src="{{ asset('public/files/footer/'.$about->footer_logo) }}" width="244" height="40" class="mt-1"><br>
                          <small class="text-muted" style="font-size: 10px;">Minimum dimensions required: 275px width X 44px height. </small>
                        </div>
                        <div class="mb-3">
                          <label for="summernote" class="form-label">About description (Translatable)</label>
                          <textarea class="form-control summernote" id="description" rows="6" name="about_description">{{ $about->about_description }}</textarea>
                        </div>
                        <div class="mb-3">
                          <label for="play_store" class="form-label">Play Store Link</label>
                          <input type="text" class="form-control" id="play_store" name="play_store_link" value="{{ $about->play_store_link }}">
                        </div>
                        <div class="mb-3">
                          <label for="app_store" class="form-label">App Store Link</label>
                          <input type="text" class="form-control" id="app_store" name="app_store_link" value="{{ $about->app_store_link }}">
                        </div>
                        <button type="submit" class="btn btn-success" style="float: right;">Update</button>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card bg-light">
                    <div class="card-header">
                      <h3 class="card-title">Contact Info Widget</h3>
                    </div>
                    <div class="card-body">
                      <form action="{{ route('contact.widget.update',$contact->id) }}" method="post">
                        @csrf
                        <div class="mb-3">
                          <label for="address" class="form-label">Contact address (Translatable)</label>
                          <input type="text" class="form-control" id="address" name="contact_address" value="{{ $contact->contact_address }}">
                        </div>
                        <div class="mb-3">
                          <label for="phone" class="form-label">Contact phone</label>
                          <input type="text" class="form-control" id="phone" name="contact_phone" value="{{ $contact->contact_phone }}">
                        </div>
                        <div class="mb-3">
                          <label for="title" class="form-label">Contact email</label>
                          <input type="email" class="form-control" id="title" name="contact_email" value="{{ $contact->contact_email }}">
                        </div>
                        <button type="submit" class="btn btn-success" style="float: right;">Update</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header">
                  <h3>Footer Bottom</h3>
                </div>
                <div class="card-body">
                  <form action="{{ route('footer.bottom.update',$social_link->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card bg-light">
                      <div class="card-header">
                        <h3 class="card-title">Copyright Widget</h3>
                      </div>
                      <div class="card-body">
                        <div class="mb-3">
                          <label for="summernote" class="form-label">Copyright Text (Translatable)</label>
                          <textarea class="form-control summernote" id="description" rows="6" name="copyright_text">{{ $social_link->copyright_text }}</textarea>
                        </div>
                      </div>
                    </div>
                    <div class="card bg-light">
                      <div class="card-header">
                        <h3 class="card-title">Social Link Widget</h3>
                      </div>
                      <div class="card-body">
                        <div class="mb-3">
                          <b style="display:inline-block; margin-right: 50px;">Show Social Links?</b>
                          <label class="switch">
                            <input type="checkbox" name="status" value="1" @if($social_link->status==1) checked @endif>
                            <span class="slider round"></span>
                          </label>
                        </div>
                        <h6>Social Links:</h6>
                        <div class="mb-3">
                          <label for="facebook" class="form-label">Facebook</label>
                          <input type="text" class="form-control" id="facebook" name="facebook" value="{{ $social_link->facebook }}">
                        </div>
                        <div class="mb-3">
                          <label for="twitter" class="form-label">Twitter</label>
                          <input type="text" class="form-control" id="twitter" name="twitter" value="{{ $social_link->twitter }}">
                        </div>
                        <div class="mb-3">
                          <label for="instagram" class="form-label">Instagram</label>
                          <input type="text" class="form-control" id="instagram" name="instagram" value="{{ $social_link->instagram }}">
                        </div>
                        <div class="mb-3">
                          <label for="youtube" class="form-label">Youtube</label>
                          <input type="text" class="form-control" id="youtube" name="youtube" value="{{ $social_link->youtube }}">
                        </div>
                        <div class="mb-3">
                          <label for="linkedin" class="form-label">Linkedin</label>
                          <input type="text" class="form-control" id="linkedin" name="linkedin" value="{{ $social_link->linkedin }}">
                        </div>
                      </div>
                    </div>
                    <div class="card bg-light">
                      <div class="card-header">
                        <h3 class="card-title">Download App Link</h3>
                      </div>
                      <div class="card-body">
                        <div class="mb-3">
                          <label for="seller_app_link" class="form-label">Seller App Link</label>
                          <input type="text" class="form-control" id="seller_app_link" name="seller_app_link" value="{{ $social_link->seller_app_link }}">
                        </div>
                        <div class="mb-3">
                          <label for="delivery_boy_app_link" class="form-label">Delivery Boy App Link</label>
                          <input type="text" class="form-control" id="delivery_boy_app_link" name="delivery_boy_app_link" value="{{ $social_link->delivery_boy_app_link }}">
                        </div>
                      </div>
                    </div>
                    <div class="card bg-light">
                      <div class="card-header">
                        <h3 class="card-title">Payment Methods Widget</h3>
                      </div>
                      <div class="card-body">
                        <div class="mb-3">
                          <label for="File" class="form-label">Payment Methods</label>
                          <input class="form-control" type="file" id="File" name="payment_method_logo">
                          <input type="hidden" name="old_payment_method_logo" value="{{ $social_link->payment_method_logo }}">
                          <img src="{{ asset('public/files/footer/'.$social_link->payment_method_logo) }}" width="244" height="40" class="mt-1"><br>
                            <small class="text-muted" style="font-size: 10px;">Minimum dimensions required: 144px width X 20px height.</small>
                        </div>
                      </div>
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
