@extends('layouts.app')
@section('content')
@push('css')
@endpush
<div class="page-header text-center" style="background-image: url('{{ asset('public/frontend') }}/assets/images/page-header-bg.jpg')">
    <div class="container">
        <h1 class="page-title">Wishlist<span>Shop</span></h1>
    </div><!-- End .container -->
</div><!-- End .page-header -->
<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('shop.page') }}">Shop</a></li>
            <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
        </ol>
    </div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->

<div class="page-content">
    <div class="container">
        <table class="table table-wishlist table-mobile">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Stock Status</th>
                    <th>Action</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($wishlist as $row)
                <tr>
                    <td class="product-col">
                        <div class="product">
                            <figure class="product-media">
                                <a href="{{ route('single.product', $row->product->slug) }}">
                                    <img src="{{ asset('public/files/product/thumbnail/'.$row->product->thumbnail) }}" alt="{{ $row->product->title }}">
                                </a>
                            </figure>

                            <h3 class="product-title">
                                <a href="{{ route('single.product', $row->product->slug) }}">{{ $row->product->title }}</a>
                            </h3>
                        </div>
                    </td>
                    <td class="price-col">
                        @if($row->product->discount_price==NULL)
                            <span class="new-price">
                                {{ $website->symbol }} {{ $row->product->price }}
                            </span>
                        @else
                            <span class="old-price mr-3">
                                {{ $website->symbol }} {{ $row->product->price }}
                            </span>
                            <span class="new-price">
                                {{ $website->symbol }} {{ $row->product->discount_price }}
                            </span>
                        @endif
                    </td>
                    <td class="stock-col">
                        @if($row->product->stock_quantity < 1)
                        <span class="out-of-stock">Out of stock</span>
                        @else
                        <span class="in-stock">In Stock</span>
                        @endif

                    </td>
                    <td class="action-col">
                        @if($row->product->stock_quantity < 1)
                        <button class="btn btn-block btn-outline-primary-2 disabled">Out of Stock</button>
                        @else
                        <button class="btn btn-block btn-outline-primary-2">Add to Cart</button>
                        @endif
                    </td>
                    <td class="remove-col">
                        <a href="{{ route('wishlist.remove',$row->id) }}" class="btn-remove"><i class="icon-close"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table><!-- End .table table-wishlist -->
        <div class="wishlist-share row">
            <div class="social-icons social-icons-sm mb-2 col-lg-8">
                <label class="social-label">Share on:</label>
                <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                <a href="#" class="social-icon" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
                <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
            </div>
            <div class="col-lg-4">
                <a href="{{ route('wishlist.clear') }}" class="btn btn-block btn-outline-primary-2" id="wishlist">Clear all Wishlist</a>
            </div>

        </div><!-- End .wishlist-share -->
    </div><!-- End .container -->
</div><!-- End .page-content -->
@push('js')
@endpush

@endsection

