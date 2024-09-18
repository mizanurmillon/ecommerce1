@php
$images=json_decode($product->images,true);
$colors=explode(',',$product->colors);
$sizes=explode(',',$product->size);
@endphp

@extends('layouts.app')
@section('content')
@push('css')
@endpush
<nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
    <div class="container d-flex align-items-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('shop.page') }}">Products</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->title }}</li>
        </ol>
    </div>
</nav>

<div class="page-content">
    <div class="container">
        <div class="product-details-top mb-2">
            <div class="row">
                <div class="col-md-6">
                    <div class="product-gallery">
                        <figure class="product-main-image">
                            <img id="product-zoom" src="{{ asset('public/files/product/thumbnail/'.$product->thumbnail) }}" data-zoom-image="{{ asset('public/files/product/thumbnail/'.$product->thumbnail) }}" alt="product image">

                            <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                <i class="icon-arrows"></i>
                            </a>
                        </figure><!-- End .product-main-image -->
                        @if(!empty($product->images))
                        <div id="product-zoom-gallery" class="product-image-gallery">
                            @foreach ($images as $image)
                                <a class="product-gallery-item" href="#" data-image="{{ asset('public/files/product/images/'.$image) }}" data-zoom-image="{{ asset('public/files/product/images/'.$image) }}">
                                    <img src="{{ asset('public/files/product/images/'.$image) }}" alt="product side">
                                </a>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="product-details">
                        <h1 class="product-title">{{ $product->title }}</h1>

                        <div class="ratings-container">
                            <div class="ratings">
                                @if($reviewAvg >=1 && $reviewAvg <=1)
                                <div class="ratings-val" style="width: 20%;"></div>
                                @elseif($reviewAvg >=1 && $reviewAvg <=2)
                                <div class="ratings-val" style="width: 40%;"></div>
                                @elseif($reviewAvg >=1 && $reviewAvg <=3)
                                <div class="ratings-val" style="width: 60%;"></div>
                                @elseif($reviewAvg >=1 && $reviewAvg <=4)
                                <div class="ratings-val" style="width: 80%;"></div>
                                @elseif($reviewAvg >=1 && $reviewAvg <=5)
                                <div class="ratings-val" style="width: 100%;"></div>
                                @else
                                <div class="ratings-val" style="width: 0%;"></div>
                                @endif
                            </div>
                            <a class="ratings-text" href="#product-review-link" id="review-link">( {{ $reviewCount }} Reviews )</a>
                        </div>

                        <div class="product-price">
                            @if($product->discount_price==NULL)
                                <span class="new-price">
                                    {{ $website->symbol }} {{ $product->price }}
                                </span>
                            @else
                                <span class="intro-old-price mr-3 text-dark">
                                    {{ $website->symbol }} {{ $product->price }}
                                </span>
                                <span class="new-price">
                                    {{ $website->symbol }} {{ $product->discount_price }}
                                </span>
                            @endif
                        </div><!-- End .product-price -->

                        <div class="product-content">
                            <p>{{ $product->short_description }} </p>
                        </div><!-- End .product-content -->
                        @if(!empty($product->colors))
                        <div class="details-filter-row details-row-size">
                            <label for="color">Color:</label>
                            <div class="select-custom">
                                <select name="color" id="color" class="form-control">
                                    <option value="#" selected="selected">Select a Color</option>
                                    @foreach($colors as $color)
                                    <option value="{{ $color }}">{{ $color }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif
                        @if(!@empty($product->size))
                        <div class="details-filter-row details-row-size">
                            <label for="size">Size:</label>
                            <div class="select-custom">
                                <select name="size" id="size" class="form-control">
                                    <option value="#" selected="selected">Select a size</option>
                                    @foreach($sizes as $size)
                                    <option value="{{ $size }}">{{ $size }}</option>
                                    @endforeach
                                </select>
                            </div><!-- End .select-custom -->

                            <a href="#" class="size-guide"><i class="icon-th-list"></i>size guide</a>
                        </div><!-- End .details-filter-row -->
                        @endif
                        <div class="details-filter-row details-row-size">
                            <label for="qty">Qty:</label>
                            <div class="product-details-quantity">
                                <input type="number" id="qty" class="form-control" value="1" min="1" max="10" step="1" data-decimals="0" required>
                            </div><!-- End .product-details-quantity -->
                        </div><!-- End .details-filter-row -->

                        <div class="product-details-action">
                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>

                            <div class="details-action-wrapper">
                                <a href="javascript:void(0)" data-id="{{ $product->id }}" class="btn-product btn-wishlist wishlist" title="Wishlist"><span class="text-uppercase">Add to Wishlist</span></a>
                            </div>
                            <div class="details-action-wrapper">
                                <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn-product border-0 bg-transparent" title="review"><span class="text-uppercase">Write A Review</span></button>
                            </div>

                        </div>

                        <div class="product-details-footer">
                            <div class="product-cat">
                                <span>Category:</span>
                                <a href="{{ route('shop', $product->category->category_slug) }}">{{ $product->category->category_name }}</a>
                                {{-- <a href="#">Shoes</a>,
                                <a href="#">Sandals</a>,
                                <a href="#">Yellow</a> --}}
                            </div><!-- End .product-cat -->

                            <div class="social-icons social-icons-sm">
                                <span class="social-label">Share:</span>
                                <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                            </div>
                        </div><!-- End .product-details-footer -->
                    </div><!-- End .product-details -->
                </div><!-- End .col-md-6 -->
            </div><!-- End .row -->
        </div><!-- End .product-details-top -->
    </div><!-- End .container -->

    <div class="product-details-tab product-details-extended">
        <div class="container">
            <ul class="nav nav-pills justify-content-center" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab" aria-controls="product-info-tab" aria-selected="false">Additional information</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab" aria-selected="false">Shipping & Returns</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews ({{ $reviewCount }})</a>
                </li>
            </ul>
        </div><!-- End .container -->

        <div class="tab-content">
            <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                <div class="product-desc-content">
                    <div class="container">
                        {!! $product->description !!}
                    </div>
                </div><
            </div>
            <div class="tab-pane fade" id="product-info-tab" role="tabpanel" aria-labelledby="product-info-link">
                <div class="product-desc-content">
                    <div class="container">
                        {!! $product->additional_information !!}

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel" aria-labelledby="product-shipping-link">
                <div class="product-desc-content">
                    <div class="container">
                        {!! $product->shipping_returns !!}
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
                <div class="reviews">
                    <div class="container">
                        <h3>Reviews ({{ $reviewCount }})</h3>
                        @foreach($productReview as $review)
                        <div class="review">
                            <div class="row no-gutters">
                                <div class="col-lg-2">
                                    <h4><a href="Javascript:;">{{ $review->user->name }}</a></h4>
                                    <div class="ratings-container">
                                        <div class="ratings">
                                            @if($review->rating == 1)
                                            <div class="ratings-val" style="width: 20%;"></div>
                                            @elseif ($review->rating == 2)
                                            <div class="ratings-val" style="width: 40%;"></div>
                                            @elseif ($review->rating == 3)
                                            <div class="ratings-val" style="width: 60%;"></div>
                                            @elseif ($review->rating == 4)
                                            <div class="ratings-val" style="width: 80%;"></div>
                                            @elseif ($review->rating == 5)
                                            <div class="ratings-val" style="width: 100%;"></div>
                                            @else
                                            <div class="ratings-val" style="width: 0%;"></div>
                                            @endif
                                        </div>
                                    </div>
                                    <span class="review-date">{{ Carbon\Carbon::parse( $review->created_at )->diffForHumans() }}</span>
                                </div>
                                <div class="col">
                                    <h4>{{ $review->date }}</h4>

                                    <div class="review-content">
                                        <p>{{ $review->review }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <nav aria-label="Page navigation">

                        <ul class="pagination justify-content-center">
                            {{ $productReview->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->
        <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
            data-owl-options='{
                "nav": false,
                "dots": true,
                "margin": 20,
                "loop": false,
                "responsive": {
                    "0": {
                        "items":1
                    },
                    "480": {
                        "items":2
                    },
                    "768": {
                        "items":3
                    },
                    "992": {
                        "items":4
                    },
                    "1200": {
                        "items":4,
                        "nav": true,
                        "dots": false
                    }
                }
            }'>
            @foreach ($related_product as $rel_product)
                <div class="product product-7">
                    <figure class="product-media">
                        @if($rel_product->stock_quantity < 1)
                        <span class="product-label label-new bg-danger">Stock Out</span>
                        @else
                        <span class="product-label label-new">Stock</span>
                        @endif
                        <a href="{{ route('single.product', $rel_product->slug) }}">
                            @if(!empty($rel_product->thumbnail))
                            <img src="{{ asset('public/files/product/thumbnail/'.$rel_product->thumbnail) }}" alt="{{ $rel_product->title }}" class="product-image">
                            @endif
                        </a>

                        <div class="product-action-vertical">
                            <a href="javascript:void(0)" data-id="{{ $rel_product->id }}" class="btn-product-icon btn-wishlist btn-expandable wishlist"><span>add to wishlist</span></a>
                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                        </div>

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                        </div>
                    </figure>

                    <div class="product-body">
                        <div class="product-cat">
                            <a href="{{ route('shop',[$rel_product->category->category_slug,$rel_product->subcategory->subcategory_slug]) }}">{{ $rel_product->subcategory->subcategory_name }}</a>
                        </div>
                        <h3 class="product-title"><a href="{{ route('single.product', $rel_product->slug) }}">{{ $rel_product->title }}</a></h3>
                        <div class="product-price">
                            @if($rel_product->discount_price==NULL)
                                <span class="new-price">
                                    {{ $website->symbol }} {{ $rel_product->price }}
                                </span>
                            @else
                                <span class="intro-old-price mr-3 text-dark">
                                    {{ $website->symbol }} {{ $rel_product->price }}
                                </span>
                                <span class="new-price">
                                    {{ $website->symbol }} {{ $rel_product->discount_price }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
<!--Review Modal -->
<div class="modal fade addModal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Write a Review</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('review.store') }}" method="post" id="review_form">
            @csrf
            <div class="modal-body" style="padding: 20px">
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="from-group">
                    <label for="rating" class="sr-only">Rating</label>
                    <select name="rating" class="form-control @error('rating') is-invalid @enderror" id="rating">
                        <option value="0" selected="selected">Select Reting *</option>
                        <option value="1">1 Star</option>
                        <option value="2">2 Star</option>
                        <option value="3">3 Star</option>
                        <option value="4">4 Star</option>
                        <option value="5">5 Star</option>
                    </select>
                    @error('rating')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="from-group">
                    <label for="review" class="sr-only">Review</label>
                    <textarea name="review" class="form-control @error('review') is-invalid @enderror" id="review" cols="30" rows="4" placeholder="Write a review"></textarea>
                    @error('review')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                @if (Auth::check())
                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                @else
                <p style="font-size: 10px; font-weight: bold" class="text-primary" >Please at first login your account for submit & review.</p>
                @endif
            </div>
        </form>
      </div>
    </div>
</div>
@endsection
@push('js')
<script>
    //add Form Submit for review
    $('#review_form').submit(function(e){
      e.preventDefault();
      var url=$(this).attr('action');
      var request=$(this).serialize();
      $.ajax({
        url:url,
        type:'post',
        data:new FormData(this),
        contentType:false,
        cache:false,
        processData:false,
        success:function(data){
            if(data.error) {
                toastr.error(data.error);
            }else{
                toastr.success(data.success);
            }
            $('#review_form')[0].reset();
            $('.addModal').modal('hide');
        }
      });
    });
    //add wishlist
    $('body').on('click','.wishlist',function(){
      var id=$(this).attr('data-id');
      $.ajax({
        url: "{{ url('/add-to-wishlist/') }}/"+id,
        type:'get',
        success:function(data){
        wishlist();
         if(data.error) {
            toastr.error(data.error);
         }else{
            toastr.success(data.success);
         }
        }
      })
    });
</script>
@endpush
