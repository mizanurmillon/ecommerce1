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
            <h3 class="card-title">SMTP Setting</h3>
          </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="{{ route('smtp.setting.update',$data->id) }}" method="post">
                @csrf
                <div class="row">
                  <div class="col-md-8 m-auto">
                    <div class="mb-3">
                      <label for="meta_title" class="form-label">TYPE</label>
                      <select class="form-select" aria-label="Default select example" name="type" id="type">
                        <option disabled="" selected="">--</option>
                        <option value="SendMail" @if($data->type=="SendMail") selected="" @endif>SendMail</option>
                        <option value="SMTP" @if($data->type=="SMTP") selected="" @endif>SMTP</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-8 m-auto">
                    <div class="mb-3">
                      <label for="mail_host" class="form-label">MAIL HOST</label>
                      <input type="text" class="form-control" id="mail_host" aria-describedby="emailHelp" name="mail_host" value="{{ $data->mail_host }}">
                    </div>
                  </div>
                  <div class="col-md-8 m-auto">
                    <div class="mb-3">
                      <label for="mail_port" class="form-label">MAIL PORT</label>
                      <input type="text" class="form-control" id="mail_port" aria-describedby="emailHelp" name="mail_port" value="{{ $data->mail_port }}">
                    </div>
                  </div>
                  <div class="col-md-8 m-auto">
                    <div class="mb-3">
                      <label for="mail_username" class="form-label">MAIL USERNAME</label>
                      <input type="email" class="form-control" id="mail_username" aria-describedby="emailHelp" name="mail_username" value="{{ $data->mail_username }}">
                    </div>
                  </div>
                  <div class="col-md-8 m-auto">
                    <div class="mb-3">
                      <label for="mail_password" class="form-label">MAIL PASSWORD</label>
                      <input type="text" class="form-control" id="alexa_verification" aria-describedby="emailHelp" name="mail_password" value="{{ $data->mail_password }}">
                    </div>
                  </div>
                  <div class="col-md-8 m-auto">
                    <div class="mb-3">
                      <label for="mail_encryption" class="form-label"> MAIL ENCRYPTION</label>
                      <input type="text" class="form-control" id="mail_encryption" aria-describedby="emailHelp" name="mail_encryption" value="{{ $data->mail_encryption }}">
                    </div>
                  </div>
                  <div class="col-md-8 m-auto">
                    <div class="mb-3">
                      <label for="mail_from_address" class="form-label">MAIL FROM ADDRESS</label>
                      <input type="email" name="mail_from_address" id="mail_from_address" class="form-control" value="{{ $data->mail_from_address }}">
                    </div>
                  </div>
                  <div class="col-md-8 m-auto">
                    <div class="mb-3">
                      <label for="mail_from_name" class="form-label">MAIL FROM NAME</label>
                      <input type="text" name="mail_from_name" id="mail_from_name" class="form-control" value="{{ $data->mail_from_name }}">
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
