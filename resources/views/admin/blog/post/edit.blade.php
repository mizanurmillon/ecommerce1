<link rel="stylesheet" type="text/css" href="{{ asset('public/backend') }}/plugins/summernote/summernote-bs4.min.css">
<form action="{{ route('blog.post.update') }}" method="post" id="edit_form">
  @csrf
  <input type="hidden" name="id" value="{{ $data->id }}">
  <div class="row">
    <div class="col-md-6 mb-3">
      <label for="blog_title" class="form-label">Blog Title</label>
      <input type="text" class="form-control" id="blog_title" aria-describedby="emailHelp" name="blog_title" value="{{ $data->blog_title }}">
    </div>
    <div class="col-md-6 mb-3">
      <label for="type" class="form-label">Select Blog Category</label>
      <select class="form-select" aria-label="Default select example" name="blogcategory_id">
        <option disabled="" selected="" class="text-danger">--</option>
        @foreach($blogcategory as $row)
        <option value="{{ $row->id }}" @if($row->id==$data->blogcategory_id) selected="" @endif>{{ $row->name }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="mb-3">
    <label for="formFileSm" class="form-label">Banner Image<small>(1300x650)</small></label>
    <input class="form-control form-control-sm" id="formFileSm" type="file" name="banner_image">
    <input type="hidden" name="old_image" value="{{ $data->banner_image }}">
    <img src="{{ asset('public/files/post/'.$data->banner_image) }}" alt="" width="50" height="50" class="mt-1">
  </div>
  <div class="row">
    <div class="col-md-4 mb-3">
      <label for="formFileSm" class="form-label">Short Description</label>
      <textarea class="form-control" name="short_description" rows="10">{{ $data->short_description }}</textarea>
    </div>
    <div class="col-md-8 mb-3">
      <label for="formFileSm" class="form-label">Description</label>
      <textarea class="form-control summernote" name="description">{{ $data->description }}</textarea>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 mb-3">
      <label for="meta_title" class="form-label">Meta Title</label>
      <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ $data->meta_title }}">
    </div>
    <div class="col-md-6 mb-3">
      <label for="meta_image" class="form-label">Meta Image<small>(200x200)</small></label>
      <input class="form-control form-control-sm" id="meta_image" type="file" name="meta_image">
      <input type="hidden" name="old_meta_image" value="{{ $data->meta_image }}">
      <img src="{{ asset('public/files/post/'.$data->meta_image) }}" alt="" width="50" height="50" class="mt-1">
    </div>
  </div>
  <div class="mb-3">
    <label for="formFileSm" class="form-label">Meta Description</label>
    <textarea class="form-control" name="meta_description" rows="3">{{ $data->meta_description }}</textarea>
  </div>
  <div class="row">
    <div class="col-md-7 mb-3">
      <label for="meta_keyword" class="form-label">Meta Keywords</label>
      <input type="text" name="meta_keyword" placeholder="meta keyword" id="meta_keyword" class="form-control" value="{{ $data->meta_keyword }}">
    </div>
    <div class="col-md-5">
       <label for="type" class="form-label">Status</label>
        <select class="form-select" aria-label="Default select example" name="status">
          <option disabled="" selected="" class="text-danger">--</option>
          <option value="1" @if($data->status==1) selected="" @endif>Publise</option>
          <option value="0" @if($data->status==0) selected="" @endif>Unpublise</option>
        </select>
    </div>
  </div>
  <button type="submit" class="btn btn-success" style="float: right;">Submit</button>
</form>
<script src="{{ asset('public/backend') }}/plugins/summernote/summernote-bs4.min.js"></script>
<script type="text/javascript">
  //summernote
  $(document).ready(function() {
    $('.summernote').summernote({
      height: 150,
    });
  });
  //Update Form Submit
    $('#edit_form').submit(function(e){
      e.preventDefault();
      var url=$(this).attr('action');
      var request=$(this).serialize();
      $('.submit_button').prop('type','button');
      $.ajax({
        url:url,
        type:'post',
        data:new FormData(this),
        contentType:false,
        cache:false,
        processData:false,
        success:function(data){
          toastr.success(data);
          $('#edit_form')[0].reset();
          $('.submit_button').prop('type','submit');
          $('.dataTable').DataTable().ajax.reload();
          $('#editModal').modal('hide');
        }
      });
    });
  
</script>