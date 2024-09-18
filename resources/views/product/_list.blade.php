
<div class="products mb-3">
    <div class="row justify-content-center">
        @foreach($getProduct as $product)
        <div class="col-6 col-md-4 col-lg-4">
            <div class="product product-7 text-center">
                <figure class="product-media">
                    @if($product->stock_quantity < 1)
                        <span class="product-label label-new bg-danger">Stock Out</span>
                    @else
                        <span class="product-label label-new">Stock</span>
                    @endif
                    <a href="{{ route('single.product', $product->slug) }}">
                        @if(!empty($product->thumbnail))
                            <img src="{{ asset('public/files/product/thumbnail/'.$product->thumbnail) }}" alt="{{ $product->title }}" class="product-image">
                        @endif
                    </a>

                    <div class="product-action-vertical">
                        <a href="javascript:void(0)" data-id="{{ $product->id }}" class="btn-product-icon btn-wishlist btn-expandable wishlist"><span>add to wishlist</span></a>

                    </div>

                    <div class="product-action">
                        <a href="#" data-toggle="modal" data-target="#cartModal" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                    </div>
                </figure>

                <div class="product-body">
                    <div class="product-cat">
                        @if(!empty($product->subcategory->subcategory_slug))
                        <a href="#">{{ $product->subcategory->subcategory_name }}</a>
                        @else
                        <a href="#">{{ $product->category->category_name }}</a>
                        @endif
                    </div>
                    <h3 class="product-title"><a href="{{ route('single.product', $product->slug) }}">{{ $product->title }}</a></h3>
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
                    </div>
                    @php
                        $images=json_decode($product->images,true);
                    @endphp
                    @if(!empty($product->images))
                    <div class="product-nav product-nav-thumbs">
                        @foreach($images as $key => $image)
                        <a href="javascript:;" class="active">
                            <img src="{{ asset('public/files/product/images/'.$image) }}" alt="product desc">
                        </a>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        {{ $getProduct->links() }}
    </ul>
</nav>
