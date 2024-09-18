<div class="products">
    <div class="row justify-content-center">
        @foreach($featured_product as $featured)
        <div class="col-12 @if(!empty($is_home)) col-md-3 col-lg-3 @else col-md-4 col-lg-4 @endif">
            <div class="product product-11 mt-v3 text-center">
                <figure class="product-media">
                    <span class="product-label label-new">NEW</span>
                    <a href="product.html">
                        @if(!empty($featured->thumbnail))
                        <img src="{{ asset('public/files/product/thumbnail/'.$featured->thumbnail) }}" alt="{{ $featured->title }}" class="product-image">
                        @endif
                    </a>

                    <div class="product-action-vertical">
                        <a href="javascript:void(0)" data-id="{{ $featured->id }}" class="btn-product-icon btn-wishlist wishlist"><span>add to wishlist</span></a>
                    </div><!-- End .product-action-vertical -->
                </figure><!-- End .product-media -->

                <div class="product-body">
                    <div class="product-cat">
                        <a href="{{ route('shop',[$featured->category_slug,$featured->subcategory_slug]) }}">{{ $featured->subcategory_name }}</a>
                    </div>
                    <h3 class="product-title"><a href="product.html">{{ $featured->title }}</a></h3><!-- End .product-title -->
                    <div class="product-price mt-3">
                        @if($featured->discount_price==NULL)
                            <span class="new-price">
                                {{ $website->symbol }} {{ $featured->price }}
                            </span>
                        @else
                            <span class="intro-old-price mr-3">
                                {{ $website->symbol }} {{ $featured->price }}
                            </span>
                            <span class="new-price">
                                {{ $website->symbol }} {{ $featured->discount_price }}
                            </span>
                        @endif
                    </div><!-- End .product-price -->
                </div><!-- End .product-body -->
                <div class="product-action">
                    <a href="#" data-toggle="modal" data-target="#cartModal" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                </div><!-- End .product-action -->
            </div><!-- End .product -->
        </div>
        @endforeach
    </div>
</div>
