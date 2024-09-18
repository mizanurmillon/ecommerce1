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
            <h1 class="m-0 text-dark text-uppercase">Add New product <a href="{{ route('product') }}" class="btn btn-danger float-right">Back</a></h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <form action="{{ route('product.store') }}" method="post" id="add_form" enctype="multipart/form-data">
        @csrf
          <div class="row">
            <div class="col-md-7">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title text-uppercase">Product Information</h3>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label" for="title">Product Title <span class="text-danger">*</span></label>
                      <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Product Title">
                      @error('title')
                         <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label" for="sku">SKU <span class="text-danger">*</span></label>
                      <input type="text" name="sku" id="sku" class="form-control @error('sku') is-invalid @enderror" placeholder="SKU">
                      @error('sku')
                         <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label" for="barcode">Barcode</label>
                      <input type="text" name="barcode" id="barcode" class="form-control" placeholder="Barcode">
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label" for="unit">Unit<span class="text-danger">*</span></label>
                      <input type="text" name="unit" id="unit" class="form-control @error('unit') is-invalid @enderror" placeholder="unit">
                      @error('unit')
                         <small class="text-danger">{{ $message }}</small><br>
                      @enderror
                      <small class="text-muted" style="font-size: 10px;">(pc,kg,liter,gb)</small>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label" for="subcategory_id">Select Category / Subcategory <span class="text-danger">*</span></label>
                      <select class="form-select @error('subcategory_id') is-invalid @enderror" aria-label="Default select example" name="subcategory_id" id="subcategory_id">
                        <option selected="selected" disabled="disabled">Select category/subcategory</option>
                        @foreach($category as $cat)
                          @php
                          $subcategory=DB::table('subcategories')->where('category_id',$cat->id)->get();
                          @endphp
                          <option disabled="disabled">{{ $cat->category_name }}</option>
                          @foreach($subcategory as $row)
                          <option value="{{ $row->id }}">----{{ $row->subcategory_name }}</option>
                          @endforeach
                        @endforeach
                      </select>
                      @error('subcategory_id')
                         <small class="text-danger">{{ $message }}</small><br>
                      @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label" for="childcategory">Child Category</label>
                      <select class="form-select" aria-label="Default select example" name="childcategory_id" id="childcategory_id">
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label" for="brand_id">Select Brand</label>
                      <select class="form-select" aria-label="Default select example" name="brand_id" id="brand_id">
                        <option selected="selected" disabled="disabled">Select Brand</option>
                        @foreach($brand as $row)
                          <option value="{{ $row->id }}">{{ $row->brand_name }}</option>
                        @endforeach
                      </select>
                      <p class="error"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label" for="pickuppoint_id">Pickuppoint</label>
                      <select class="form-select" aria-label="Default select example" name="pickuppoint_id" id="pickuppoint_id">
                        <option selected="selected" disabled="disabled">Select Pickuppoint</option>
                        @foreach($pickuppoint as $row)
                          <option value="{{ $row->id }}">{{ $row->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                   <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label" for="warehouse_id">Select Warehouse</label>
                      <select class="form-select" aria-label="Default select example" name="warehouse_id" id="warehouse_id">
                        <option selected="selected" disabled="disabled">Select Warehouse</option>
                        @foreach($warehouse as $row)
                          <option value="{{ $row->id }}">{{ $row->warehouse_name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label" for="tag">Tags</label>
                      <input type="text" name="tag" id="tag" class="form-control" placeholder="add tags">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label" for="stock_quantity">Stock Quantity <span class="text-danger">*</span></label>
                      <input type="number" min="1" name="stock_quantity" id="stock_quantity" class="form-control @error('stock_quantity') is-invalid @enderror">
                      @error('stock_quantity')
                         <small class="text-danger">{{ $message }}</small><br>
                      @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label" for="video">Video Embad Code</label>
                      <input type="text" name="video" id="video" class="form-control" placeholder="Only Embed Code After Embed Work">
                      <small class="text-muted" style="font-size: 10px;">Only Embed Code After Embed Work</small>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="purchase_price">Purchase Price</label>
                        <input type="text" name="purchase_price" id="purchase_price" class="form-control" placeholder="Purchase Price">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="price">Price <span class="text-danger">*</span></label>
                        <input type="text" name="price" id="price" class="form-control @error('price') is-invalid @enderror" placeholder="Price">
                        @error('price')
                         <small class="text-danger">{{ $message }}</small><br>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="discount_price">Discount Price</label>
                        <input type="text" name="discount_price" id="discount_price" class="form-control" placeholder="Discount Price">
                    </div>
                  </div>
                  <div class="mb-3">
                      <label class="form-label" for="short_description">Short Description</label>
                      <textarea class="form-control" name="short_description" id="short_description" rows="4"></textarea>
                  </div>
                  <div class="mb-3">
                      <label class="form-label" for="description">Description</label>
                      <textarea class="form-control summernote" name="description" id="description" rows="4"></textarea>
                  </div>
                  <div class="mb-3">
                      <label class="form-label" for="additional_information">Additional Information</label>
                      <textarea class="form-control summernote" name="additional_information" id="additional_information" rows="4"></textarea>
                  </div>
                  <div class="mb-3">
                      <label class="form-label" for="shipping_returns">Shipping Returns</label>
                      <textarea class="form-control summernote" name="shipping_returns" id="shipping_returns" rows="4"></textarea>
                  </div>
                  <button type="submit" class="btn btn-success">Save & Publish</button>
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title text-uppercase">Images Info</h3>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="thumbnail">Thumbnail<span class="text-danger">*</span></label>
                    <input type="file" name="thumbnail" id="thumbnail" accept="image/*" class="dropify @error('thumbnail') is-invalid @enderror">
                      @error('thumbnail')
                         <small class="text-danger">{{ $message }}</small><br>
                      @enderror
                  </div>
                  <div class="">
                    <table class="table table-bordered" id="dynamic_field">
                     <div class="card-header">
                        <h3 class="card-title" style="font-size:10px;">More Images (Click Add For More Image)</h3>
                      </div>
                      <tr>
                        <td><input type="file" accept="image/*" name="images[]" class="form-control form-control-sm" style="border:none; outline:0;" /></td>
                        <td><button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title text-uppercase">Color & Size Info</h3>
                </div>
                <div class="card-body">
                  <div class="card p-4 bg-light row">
                    <div class="mb-3">
                      <label class="form-label" for="Color">Color <span class="text-danger">*</span></label>
                     <input type="text" name="colors" id="color" class="form-control" placeholder="Enter Color">
                      <p class="error"></p>
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="size">Size</label>
                      <input type="text" name="size" id="size" class="form-control" placeholder="add size">
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title text-uppercase">Status</h3>
                </div>
                <div class="card-body">
                  <div class="card p-4 bg-light">
                      <h6>Featured Product</h6>
                        <div class="form-group">
                          <label class="switch">
                            <input type="checkbox" name="featured" checked="checked" id="featured" value="Yes">
                            <span class="slider round"></span>
                          </label><br>
                          <small class="text-muted" style="font-size: 10px;">If you enable this, this product will be granted as a featured product.</small>
                        </div>
                    </div>
                    <div class="card p-4 bg-light">
                      <h6>Today Deal</h6>
                        <div class="form-group">
                          <label class="switch">
                            <input type="checkbox" name="today_deal" value="Yes">
                            <span class="slider round"></span>
                          </label><br>
                          <small class="text-muted" style="font-size: 10px;">If you enable this, this product will be granted as a todays deal product.</small>
                        </div>
                    </div>
                    <div class="card p-4 bg-light">
                      <h6>Trendy Product</h6>
                        <div class="form-group">
                          <label class="switch">
                            <input type="checkbox" name="trendy" value="Yes">
                            <span class="slider round"></span>
                          </label><br>
                          <small class="text-muted" style="font-size: 10px;">If you enable this, this product will be granted as a trendy product.</small>
                        </div>
                    </div>
                    <div class="card p-4 bg-light">
                      <h6>Product Slider</h6>
                        <div class="form-group">
                          <label class="switch">
                            <input type="checkbox" name="product_slider" id="product_slider" value="Yes">
                            <span class="slider round"></span>
                          </label><br>
                          <small class="text-muted" style="font-size: 10px;">If you enable this, this product will be granted as a product slider.</small>
                        </div>
                    </div>
                    <div class="card p-4 bg-light">
                      <h6>Publish Product</h6>
                        <div class="form-group">
                          <label class="switch">
                            <input type="checkbox" name="status" checked="checked" value="1">
                            <span class="slider round"></span>
                          </label>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@push('js')
  <script>
     // tags input
    $("#tag").tagsinput()
    $("#size").tagsinput()
    $("#color").tagsinput()

    // add image fild 
    $(document).ready(function(){
      var postURL="<?php echo url('addmore'); ?>";
      var i=1;

      $('#add').click(function(){
        i++;
        $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="file" name="images[]" accept="image/*" class="form-control form-control-sm name_list"  style="border:none; outline:0;" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
      });
      $(document).on('click','.btn_remove',function(){
        var button_id=$(this).attr("id");
        $('#row'+button_id+'').remove();
      })
    });

    //ajax request send for collect childcategory
    $('#subcategory_id').change(function(){
      var id = $(this).val();
      $.ajax({
        url:"{{ url("/get-childcategory/") }}/"+id,
        type:'get',
        success:function(data) {
          $('select[name="childcategory_id"]').empty();;
          $.each(data,function(key,data){
            $('select[name="childcategory_id"]').append('<option value="'+data.id+'">'+data.childcategory_name+'</option>');
          });
        }

      });
    });
    //summernote
    $(document).ready(function() {
      $('.summernote').summernote({
        height: 150,
      });
    });
    // $('#add_form').submit(function(e){
    //   e.preventDefault();
    //   var url=$(this).attr('action');
    //   var request=$(this).serialize();
    //   $.ajax({
    //     url:url,
    //     type:'post',
    //     data:new FormData(this),
    //     contentType:false,
    //     cache:false,
    //     processData:false,
    //     success:function(response){
    //       toastr.success(response);
    //       window.location.href = "{{ route('product') }}"
    //       if(response["status"] == true){
    //         $(".error").removeClass('invalid-feedback').html('');
    //         $("input[type=text],select").removeClass('is-invalid');
    //       }else{
    //         var errors=response['errors'];
    //         $(".error").removeClass('invalid-feedback').html('');
    //         $("input[type=text],select").removeClass('is-invalid');
    //         $.each(errors,function(key,value){
    //           $(`#${key}`).addClass('is-invalid')
    //           .siblings('p')
    //           .addClass('invalid-feedback')
    //           .html(value);
    //         });
    //       }
    //     }
    //   });
    // });
    
  </script>
@endpush
@endsection
