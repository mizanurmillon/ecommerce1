@push('css')
@endpush
@extends('layouts.admin')
@section('admin_content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark text-uppercase">Product Edit <a href="{{ route('product') }}" class="btn btn-danger float-right">Back</a></h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <form action="{{ route('product.update') }}" method="post" id="edit_form" enctype="multipart/form-data">
        @csrf
          <div class="row">
            <div class="col-md-7">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title text-uppercase">Product Information</h3>
                </div>
                <div class="card-body">
                  <input type="hidden" name="id" value="{{ $product->id }}">
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label" for="title">Product Title <span class="text-danger">*</span></label>
                      <input type="text" name="title" id="title" class="form-control" value="{{ $product->title }}">
                      <p class="error"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label" for="sku">SKU <span class="text-danger">*</span></label>
                      <input type="text" name="sku" id="sku" class="form-control" value="{{ $product->sku }}">
                      <p class="error"></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label" for="barcode">Barcode</label>
                      <input type="text" name="barcode" id="barcode" class="form-control" value="{{ $product->barcode }}">
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label" for="unit">Unit<span class="text-danger">*</span></label>
                      <input type="text" name="unit" id="unit" class="form-control" value="{{ $product->unit }}">
                      <p style="margin: 0;" class="error"></p>
                      <small class="text-muted" style="font-size: 10px;">(pc,kg,liter,gb)</small>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label" for="subcategory_id">Select Category / Subcategory <span class="text-danger">*</span></label>
                      <select class="form-select" aria-label="Default select example" name="subcategory_id" id="subcategory_id">
                        <option selected="selected" disabled="disabled">Select category/subcategory</option>
                        @foreach($category as $cat)
                          @php
                          $subcategory=DB::table('subcategories')->where('category_id',$cat->id)->get();
                          @endphp
                          <option disabled="disabled">{{ $cat->category_name }}</option>
                          @foreach($subcategory as $row)
                          <option value="{{ $row->id }}" @if($row->id==$product->subcategory_id) selected="selected" @endif>----{{ $row->subcategory_name }}</option>
                          @endforeach
                        @endforeach
                      </select>
                      <p class="error"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label" for="childcategory">Child Category</label>
                      <select class="form-select" aria-label="Default select example" name="childcategory_id" id="childcategory_id">
                        @foreach($childcategory as $row)
                        <option value="{{ $row->id }}" @if($row->id==$product->childcategory_id) selected="selected" @endif>{{ $row->childcategory_name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label" for="brand_id">Select Brand <span class="text-danger">*</span></label>
                      <select class="form-select" aria-label="Default select example" name="brand_id" id="brand_id">
                        <option selected="selected" disabled="disabled">Select Brand</option>
                        @foreach($brand as $row)
                          <option value="{{ $row->id }}" @if($row->id==$product->brand_id) selected="selected" @endif>{{ $row->brand_name }}</option>
                        @endforeach
                      </select>
                      <p class="error"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label" for="pickuppoint_id">Pickuppoint</label>
                      <select class="form-select" aria-label="Default select example" name="pickuppoint_id" id="pickuppoint_id">
                        <option selected="selected" disabled="disabled">Select Pickuppoint</option>
                        @foreach($pickuppoint as $row)
                          <option value="{{ $row->id }}" @if($row->id==$product->pickuppoint_id) selected="selected" @endif>{{ $row->name }}</option>
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
                          <option value="{{ $row->id }}" @if($row->id==$product->warehouse_id) selected="selected" @endif>{{ $row->warehouse_name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label" for="tag">Tags</label>
                      <input type="text" name="tag" id="tag" class="form-control" value="{{ $product->tag }}">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label" for="stock_quantity">Stock Quantity <span class="text-danger">*</span></label>
                      <input type="number" min="1" name="stock_quantity" id="stock_quantity" class="form-control" value="{{ $product->stock_quantity }}">
                      <p class="error"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label" for="video">Video Embad Code</label>
                      <input type="text" name="video" id="video" class="form-control" placeholder="Only Embed Code After Embed Work" value="{{ $product->video }}">
                      <small class="text-muted" style="font-size: 10px;">Only Embed Code After Embed Work</small>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="purchase_price">Purchase Price</label>
                        <input type="text" name="purchase_price" id="purchase_price" class="form-control" value="{{ $product->purchase_price }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="price">Price <span class="text-danger">*</span></label>
                        <input type="text" name="price" id="price" class="form-control" value="{{ $product->price }}">
                        <p class="error"></p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="discount_price">Discount Price</label>
                        <input type="text" name="discount_price" id="discount_price" class="form-control" value="{{ $product->discount_price }}">
                    </div>
                  </div>
                  <div class="mb-3">
                      <label class="form-label" for="short_description">Short Description</label>
                      <textarea class="form-control" name="short_description" id="short_description" rows="4">{{  $product->short_description }}</textarea>
                  </div>
                  <div class="mb-3">
                      <label class="form-label" for="description">Description</label>
                      <textarea class="form-control summernote" name="description" id="description" rows="4">{{ $product->description }}</textarea>
                  </div>
                  <div class="mb-3">
                      <label class="form-label" for="additional_information">Additional Information</label>
                      <textarea class="form-control summernote" name="additional_information" id="additional_information" rows="4">{{ $product->additional_information }}</</textarea>
                  </div>
                  <div class="mb-3">
                      <label class="form-label" for="shipping_returns">Shipping Returns</label>
                      <textarea class="form-control summernote" name="shipping_returns" id="shipping_returns" rows="4">{{ $product->shipping_returns }}</</textarea>
                  </div>
                  <button type="submit" class="btn btn-success">Update & Publish</button>
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
                    <input type="file" name="thumbnail" id="thumbnail" accept="image/*" class="dropify" data-default-file="{{ asset('public/files/product/thumbnail/'.$product->thumbnail) }}">
                    <input type="hidden" name="old_thumbnail" value="{{ $product->thumbnail }}">
                    <p class="error"></p>
                  </div>
                  <img src="{{ asset('public/files/product/thumbnail/'.$product->thumbnail) }}" alt="" style="width:100px; height: 80px;">
                  <div class="">
                    <table class="table table-bordered" id="dynamic_field">
                     <div class="card-header">
                        <h3 class="card-title" style="font-size:10px;">More Images (Click Add For More Image)</h3>
                      </div>
                      <tr>
                        <td><input type="file" accept="image/*" name="images[]" class="form-control form-control-sm" style="border:none; outline:0;" /></td>
                        <td><button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                      </tr>
                       @php
                          $images=json_decode($product->images,true);
                        @endphp
                        @if(!$images)
                        @else
                          <div class="row">
                            @foreach($images as $key=>$image)

                              <div class="col-md-4">
                                <img src="{{ asset('public/files/product/images/'.$image) }}" alt="" style="width: 100px; height: 80px; padding: 10px;">
                                <input type="hidden" name="old_images[]" value="{{ $image }}">
                                <button type="button" class="remove-file btn btn-danger btn-sm" style="border: none; margin-left: 10px; margin-bottom: 5px;">X</button>
                              </div>
                            @endforeach
                          </div>
                        @endif
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
                  		<label class="form-label" for="color">Color <span class="text-danger">*</span></label>
	                  	<input type="text" name="colors" id="color" class="form-control" value="{{ $product->colors }}">
	                    <p class="error"></p>
	                </div>
                    <div class="mb-3">
                      <label class="form-label" for="size">Size <span class="text-danger">*</span></label>
                      <input type="text" name="size" id="size" class="form-control" value="{{ $product->size }}">
                      <p class="error"></p>
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
                            <input type="checkbox" name="featured" id="featured" value="Yes" @if($product->featured=="Yes") checked="checked" @endif>
                            <span class="slider round"></span>
                          </label><br>
                          <small class="text-muted" style="font-size: 10px;">If you enable this, this product will be granted as a featured product.</small>
                        </div>
                    </div>
                    <div class="card p-4 bg-light">
                      <h6>Today Deal</h6>
                        <div class="form-group">
                          <label class="switch">
                            <input type="checkbox" name="today_deal" value="Yes" @if($product->today_deal=="Yes") checked="checked" @endif>
                            <span class="slider round"></span>
                          </label><br>
                          <small class="text-muted" style="font-size: 10px;">If you enable this, this product will be granted as a todays deal product.</small>
                        </div>
                    </div>
                    <div class="card p-4 bg-light">
                      <h6>Trendy Product</h6>
                        <div class="form-group">
                          <label class="switch">
                            <input type="checkbox" name="trendy" value="Yes" @if($product->trendy=="Yes") checked="checked" @endif>
                            <span class="slider round"></span>
                          </label><br>
                          <small class="text-muted" style="font-size: 10px;">If you enable this, this product will be granted as a trendy product.</small>
                        </div>
                    </div>
                    <div class="card p-4 bg-light">
                      <h6>Product Slider</h6>
                        <div class="form-group">
                          <label class="switch">
                            <input type="checkbox" name="product_slider" id="product_slider" value="Yes" @if($product->product_slider=="Yes") checked="checked" @endif>
                            <span class="slider round"></span>
                          </label><br>
                          <small class="text-muted" style="font-size: 10px;">If you enable this, this product will be granted as a product slider.</small>
                        </div>
                    </div>
                    <div class="card p-4 bg-light">
                      <h6>Publish Product</h6>
                        <div class="form-group">
                          <label class="switch">
                            <input type="checkbox" name="status" value="1" @if($product->status==1) checked="checked" @endif>
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
        $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="file" name="images[]" accept="image/*" class="form-control name_list"  style="border:none; outline:0;" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
      });
      $(document).on('click','.btn_remove',function(){
        var button_id=$(this).attr("id");
        $('#row'+button_id+'').remove();
      })
    });
    // remove-file Image 
    $('.remove-file').on('click',function(){
      $(this).parents(".col-md-4").remove();
    });

    //ajax request send for collect childcategory
    $('#subcategory_id').change(function(){
      var id = $(this).val();
      $.ajax({
        url:"{{ url("/get-childcategory/") }}/"+id,
        type:'get',
        success:function(data) {
          $('select[name="childcategory_id"]').empty();
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
  </script>
@endpush
@endsection
