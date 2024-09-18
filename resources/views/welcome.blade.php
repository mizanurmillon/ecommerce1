@extends('layouts.app')
@section('content')
@push('css')
@endpush
    <div class="intro-section pt-3 pb-3 mb-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="intro-slider-container slider-container-ratio mb-2 mb-lg-0">
                        <div class="intro-slider owl-carousel owl-simple owl-dark owl-nav-inside" data-toggle="owl" data-owl-options='{
                                "nav": false,
                                "dots": true,
                                "responsive": {
                                    "768": {
                                        "nav": true,
                                        "dots": false
                                    }
                                }
                            }'>
                            @foreach($slider_product as $slider)
                            <div class="intro-slide">
                                <figure class="slide-image">
                                    <picture>
                                        @if(!empty($slider->thumbnail))
                                        <source media="(max-width: 480px)" srcset="{{ asset('public/files/product/thumbnail/'.$slider->thumbnail) }}">
                                        <img src="{{ asset('public/files/product/thumbnail/'.$slider->thumbnail) }}" alt="{{ $slider->title }}">
                                        @endif
                                    </picture>
                                </figure><!-- End .slide-image -->

                                <div class="intro-content">
                                    <h3 class="intro-subtitle text-primary">{{ $slider->category->category_name }}</h3><!-- End .h3 intro-subtitle -->
                                    <h1 class="intro-title text-dark">
                                        {{ $slider->title }}
                                    </h1><!-- End .intro-title -->

                                    <div class="intro-price">
                                        @if($slider->discount_price==NULL)
                                        <sup class="intro-old-price">{{ $website->symbol }} {{ $slider->price }}</sup>
                                        @else
                                        <sup class="intro-old-price">{{ $website->symbol }} {{ $slider->price }}</sup>
                                        <span class="text-primary">
                                            {{ $website->symbol }} {{ $slider->discount_price }}
                                        </span>
                                        @endif
                                    </div><!-- End .intro-price -->

                                    <a href="category.html" class="btn btn-primary btn-round">
                                        <span>Click Here</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </a>
                                </div><!-- End .intro-content -->
                            </div><!-- End .intro-slide -->
                            @endforeach

                        </div><!-- End .intro-slider owl-carousel owl-simple -->

                        <span class="slider-loader"></span><!-- End .slider-loader -->
                    </div><!-- End .intro-slider-container -->
                </div><!-- End .col-lg-8 -->

                <div class="col-lg-4">
                    <div class="intro-banners">
                        <div class="banner mb-lg-1 mb-xl-2">
                            <a href="#">
                                <img src="{{ asset('public/files/banner/small/'.$banner_1->image) }}" alt="Banner">
                            </a>

                            <div class="banner-content">
                                <h4 class="banner-subtitle d-lg-none d-xl-block"><a href="#">{{ $banner_1->alt }}</a></h4><!-- End .banner-subtitle -->
                                <h3 class="banner-title"><a href="#">{{ $banner_1->title }}</a></h3><!-- End .banner-title -->
                                <a href="#" class="banner-link">Shop Now<i class="icon-long-arrow-right"></i></a>
                            </div><!-- End .banner-content -->
                        </div><!-- End .banner -->

                        <div class="banner mb-lg-1 mb-xl-2">
                            <a href="#">
                                <img src="{{ asset('public/files/banner/small/'.$banner_2->image) }}" alt="Banner">
                            </a>

                            <div class="banner-content">
                                <h4 class="banner-subtitle d-lg-none d-xl-block"><a href="#">{{ $banner_2->alt }}</a></h4><!-- End .banner-subtitle -->
                                <h3 class="banner-title"><a href="#">{{ $banner_2->title }}</a></h3><!-- End .banner-title -->
                                <a href="#" class="banner-link">Shop Now<i class="icon-long-arrow-right"></i></a>
                            </div><!-- End .banner-content -->
                        </div><!-- End .banner -->

                        <div class="banner mb-0">
                            <a href="#">
                                <img src="{{ asset('public/files/banner/small/'.$banner_3->image) }}" alt="Banner">
                            </a>

                            <div class="banner-content">
                                <h4 class="banner-subtitle d-lg-none d-xl-block"><a href="#">{{ $banner_3->alt }}</a></h4><!-- End .banner-subtitle -->
                                <h3 class="banner-title"><a href="#">{{ $banner_3->title }}</a></h3><!-- End .banner-title -->
                                <a href="#" class="banner-link">Shop Now<i class="icon-long-arrow-right"></i></a>
                            </div><!-- End .banner-content -->
                        </div><!-- End .banner -->
                    </div><!-- End .intro-banners -->
                </div><!-- End .col-lg-4 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .intro-section -->

    <div class="container featured">
        <ul class="nav nav-pills nav-border-anim nav-big justify-content-center mb-3" role="tablist">
            <h2 class="title">Trending Products</h2>
        </ul>

        <div class="tab-content tab-content-carousel">
            <div class="tab-pane p-0 fade show active" id="products-featured-tab" role="tabpanel" aria-labelledby="products-featured-link">
                <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl"
                    data-owl-options='{
                        "nav": true,
                        "dots": true,
                        "margin": 20,
                        "loop": false,
                        "responsive": {
                            "0": {
                                "items":2
                            },
                            "600": {
                                "items":2
                            },
                            "992": {
                                "items":3
                            },
                            "1200": {
                                "items":4
                            }
                        }
                    }'>
                    @foreach($trendy_product as $trendy)
                    <div class="product product-2">
                        <figure class="product-media">
                            @if($trendy->stock_quantity < 1)
                            <span class="product-label label-new bg-danger">Stock Out</span>
                            @else
                            <span class="product-label label-new">Stock</span>
                            @endif
                            <a href="{{ route('single.product', $trendy->slug) }}">
                                @if(!empty($trendy->thumbnail))
                                <img src="{{ asset('public/files/product/thumbnail/'.$trendy->thumbnail) }}" alt="{{ $trendy->title }}" class="product-image">
                                @endif
                            </a>

                            <div class="product-action-vertical">
                                <a href="javascript:void(0)" data-id="{{ $trendy->id }}" class="btn-product-icon btn-wishlist btn-expandable wishlist"><span>add to wishlist</span></a>
                            </div><!-- End .product-action -->

                            <div class="product-action product-action-dark">
                                <a href="#" data-toggle="modal" data-target="#cartModal" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                                <a href="#" id="{{ $trendy->id }}" data-toggle="modal" data-target="#quickModal" class="btn-product quickview" title="Quick view"><span>quick view</span></a>
                            </div><!-- End .product-action -->
                        </figure><!-- End .product-media -->

                        <div class="product-body">
                            <div class="product-cat">
                                <a href="{{ route('shop',[$trendy->category->category_slug,$trendy->subcategory->subcategory_slug]) }}">{{ $trendy->subcategory->subcategory_name }}</a>
                            </div><!-- End .product-cat -->
                            <h3 class="product-title"><a href="{{ route('single.product', $trendy->slug) }}">{{ $trendy->title }}</a></h3><!-- End .product-title -->
                            <div class="product-price mt-1">
                                @if($trendy->discount_price==NULL)
                                    <span class="text-primary">
                                        {{ $website->symbol }} {{ $trendy->price }}
                                    </span>
                                @else
                                    <sup class="intro-old-price text-dark mr-2">
                                        {{ $website->symbol }} {{ $trendy->price }}
                                    </sup>
                                    <span class="text-primary">
                                        {{ $website->symbol }} {{ $trendy->discount_price }}
                                    </span>
                                @endif
                            </div>

                        </div>
                    </div>
                    @endforeach
                </div
            </div>
        </div>
    </div>

    <div class="mb-7 mb-lg-11"></div><!-- End .mb-7 -->

    <div class="container">
        <div class="cta cta-border cta-border-image mb-5 mb-lg-7" style="background-image: url({{ asset('public/frontend') }}/assets/images/demos/demo-3/bg-1.jpg);">
            <div class="cta-border-wrapper bg-white">
                <div class="row justify-content-center">
                    <div class="col-md-11 col-xl-11">
                        <div class="cta-content">
                            <div class="cta-heading">
                                <h3 class="cta-title text-right"><span class="text-primary">New Deals</span> <br>Start Daily at 12pm e.t.</h3><!-- End .cta-title -->
                            </div><!-- End .cta-heading -->

                            <div class="cta-text">
                                <p>Get <span class="text-dark font-weight-normal">FREE SHIPPING* & 5% rewards</span> on <br>every order with Molla Theme rewards program</p>
                            </div><!-- End .cta-text -->
                            <a href="#" class="btn btn-primary btn-round"><span>Add to Cart for $50.00/yr</span><i class="icon-long-arrow-right"></i></a>
                        </div><!-- End .cta-content -->
                    </div><!-- End .col-xl-7 -->
                </div><!-- End .row -->
            </div><!-- End .bg-white -->
        </div><!-- End .cta -->
    </div><!-- End .container -->

    <div class="bg-light deal-container pt-7 pb-7 mb-5">
        <div class="container">
            <div class="heading text-center mb-4">
                <h2 class="title">Deals & Outlet</h2><!-- End .title -->
                <p class="title-desc">Today’s deal and more</p><!-- End .title-desc -->
            </div><!-- End .heading -->

            <div class="row">
                <div class="col-lg-6 deal-col">
                    <div class="deal" style="background-image: url('{{ asset('public/files/product/thumbnail/'.$today_deal->thumbnail) }}');">
                        <div class="deal-top">
                            <h2>Deal of the Day.</h2>
                            <h4>Limited quantities. </h4>
                        </div><!-- End .deal-top -->

                        <div class="deal-content">
                            <h3 class="product-title"><a href="{{ route('single.product', $today_deal->slug) }}">{{ $today_deal->title }}</a></h3><!-- End .product-title -->

                            <div class="product-price">
                                @if($today_deal->discount_price==NULL)
                                    <span class="new-price">
                                        {{ $website->symbol }} {{ $today_deal->price }}
                                    </span>
                                @else
                                    <span class="old-price mr-3">
                                        {{ $website->symbol }} {{ $today_deal->price }}
                                    </span>
                                    <span class="new-price">
                                        {{ $website->symbol }} {{ $today_deal->discount_price }}
                                    </span>
                                @endif
                            </div><!-- End .product-price -->

                            <a href="product.html" class="btn btn-link"><span>Shop Now</span><i class="icon-long-arrow-right"></i></a>
                        </div><!-- End .deal-content -->

                        <div class="deal-bottom">
                            <div class="deal-countdown" data-until="+24h"></div><!-- End .deal-countdown -->
                        </div><!-- End .deal-bottom -->
                    </div><!-- End .deal -->
                </div><!-- End .col-lg-6 -->
                <div class="col-lg-6">
                    <div class="products">
                        <div class="row">
                            @foreach($random_product as $random)
                            <div class="col-6">
                                <div class="product product-2">
                                    <figure class="product-media">
                                        @if($random->stock_quantity < 1)
                                        <span class="product-label label-new bg-danger">Stock Out</span>
                                        @else
                                        <span class="product-label label-new">Stock</span>
                                        @endif
                                        <a href="{{ route('single.product', $random->slug) }}">
                                            @if(!empty($random->thumbnail))
                                            <img src="{{ asset('public/files/product/thumbnail/'.$random->thumbnail) }}" alt="Product image" class="product-image">
                                            @endif
                                        </a>

                                        <div class="product-action-vertical">
                                            <a href="javascript:void(0)" data-id="{{ $random->id }}" class="btn-product-icon btn-wishlist wishlist btn-expandable"><span>add to wishlist</span></a>
                                        </div><!-- End .product-action -->

                                        <div class="product-action product-action-dark">
                                            <a href="#" data-toggle="modal" data-target="#cartModal" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                                            <a href="#" id="{{ $random->id }}" data-toggle="modal" data-target="#quickModal" class="btn-product quickview" title="Quick view"><span>quick view</span></a>
                                        </div><!-- End .product-action -->
                                    </figure><!-- End .product-media -->

                                    <div class="product-body">
                                        <div class="product-cat">
                                            <a href="{{ route('shop',$random->category->category_slug) }}">{{ $random->category->category_name }}</a>
                                        </div><!-- End .product-cat -->
                                        <h3 class="product-title"><a href="{{ route('single.product', $random->slug) }}">
                                            {{ $random->title }}
                                        </a></h3><!-- End .product-title -->
                                        <div class="product-price">
                                            @if($random->discount_price==NULL)
                                                <span class="new-price">
                                                    {{ $website->symbol }} {{ $random->price }}
                                                </span>
                                            @else
                                                <span class="old-price mr-3">
                                                    {{ $website->symbol }} {{ $random->price }}
                                                </span>
                                                <span class="new-price">
                                                    {{ $website->symbol }} {{ $random->discount_price }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="more-container text-center mt-3 mb-0">
                <a href="#" class="btn btn-outline-dark-2 btn-round btn-more"><span>Shop more Outlet deals</span><i class="icon-long-arrow-right"></i></a>
            </div><!-- End .more-container -->
        </div><!-- End .container -->
    </div><!-- End .deal-container -->

    <div class="container">
        <div class="owl-carousel mt-5 mb-5 owl-simple" data-toggle="owl"
                data-owl-options='{
                    "nav": false,
                    "dots": false,
                    "margin": 30,
                    "loop": false,
                    "responsive": {
                        "0": {
                            "items":2
                        },
                        "420": {
                            "items":3
                        },
                        "600": {
                            "items":4
                        },
                        "900": {
                            "items":5
                        },
                        "1024": {
                            "items":6
                        }
                    }
                }'>
                @foreach($brand as $row)
                <a href="#" class="brand">
                    <img src="{{ asset('public/files/brand/'.$row->image) }}" alt="{{ $row->brand_name }}">
                </a>
                @endforeach
            </div><!-- End .owl-carousel -->
    </div><!-- End .container -->

    <div class="container">
        <hr class="mt-3 mb-6">
    </div><!-- End .container -->

    <div class="container">
        <div class="heading heading-center mb-6">
            <h2 class="title"> Featured Products</h2><!-- End .title -->

            <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="top-all-link" data-toggle="tab" href="#top-all-tab" role="tab" aria-controls="top-all-tab" aria-selected="true">All</a>
                </li>
                @foreach($subcategory as $subcat)
                <li class="nav-item">
                    <a class="nav-link getSubcategoryProduct" data-val="{{ $subcat->id }}" id="top-{{ $subcat->subcategory_slug }}-link" data-toggle="tab" href="#top-{{ $subcat->subcategory_slug }}-tab" role="tab" aria-controls="top-{{ $subcat->subcategory_slug }}-tab" aria-selected="false">{{ $subcat->subcategory_name }}</a>
                </li>
                @endforeach

            </ul>
        </div><!-- End .heading -->

        <div class="tab-content">
            <div class="tab-pane p-0 fade show active" id="top-all-tab" role="tabpanel" aria-labelledby="top-all-link">
                <div class="products">
                    <div class="row justify-content-center">
                        @php
                        $is_home=1;
                        @endphp
                        @include('product.product_list');
                    </div>
                </div>

            </div>
            @foreach($subcategory as $subcat)
            <div class="tab-pane p-0 fade getSubcategoryProduct{{ $subcat->id }}" id="top-{{ $subcat->subcategory_slug }}-tab" role="tabpanel" aria-labelledby="top-{{ $subcat->subcategory_slug }}-link">

            </div>
            @endforeach
        </div>
        <div class="more-container text-center">
            <a href="#" class="btn btn-outline-darker btn-more"><span>Load more products</span><i class="icon-long-arrow-down"></i></a>
        </div>
    </div>

    <div class="container">
        <hr class="mt-5 mb-6">
    </div><!-- End .container -->

    <div class="container top">
        <div class="heading heading-flex mb-3">
            <div class="heading-left">
                <h2 class="title">Top Populer Products</h2>
            </div>
        </div>

        <div class="tab-content tab-content-carousel just-action-icons-sm">
            <div class="tab-pane p-0 fade show active" id="top-all-tab" role="tabpanel" aria-labelledby="top-all-link">
                <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl"
                    data-owl-options='{
                        "nav": true,
                        "dots": false,
                        "margin": 20,
                        "loop": false,
                        "responsive": {
                            "0": {
                                "items":2
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
                                "items":5
                            }
                        }
                    }'>
                    @foreach ($populer_product as $p_product)
                    <div class="product product-2">
                        <figure class="product-media">
                            @if($p_product->stock_quantity < 1)
                            <span class="product-label label-new bg-danger">Stock Out</span>
                            @else
                            <span class="product-label label-new">Stock</span>
                            @endif
                            <a href="{{ route('single.product', $p_product->slug) }}">
                                @if (!empty($p_product->thumbnail))
                                <img src="{{ asset('public/files/product/thumbnail/'.$p_product->thumbnail) }}" alt="{{ $p_product->title }}" class="product-image">
                                @endif
                            </a>

                            <div class="product-action-vertical">
                                <a href="javascript:void(0)" data-id="{{ $p_product->id }}" class="btn-product-icon btn-wishlist btn-expandable wishlist"><span>add to wishlist</span></a>
                            </div><!-- End .product-action -->

                            <div class="product-action product-action-dark">
                                <a href="#" id="{{ $p_product->id }}" data-toggle="modal" data-target="#quickModal" class="btn-product quickview btn-wishlist" title="Quick view"><span>quick view</span></a>

                                <a href="#" data-toggle="modal" data-target="#cartModal" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                            </div><!-- End .product-action -->
                        </figure><!-- End .product-media -->

                        <div class="product-body">
                            <div class="product-cat">
                                <a href="{{ route('shop',$p_product->category->category_slug) }}">{{ $p_product->category->category_name }}</a>
                            </div><!-- End .product-cat -->
                            <h3 class="product-title"><a href="{{ route('single.product', $p_product->slug) }}">{{ $p_product->title }}</a></h3>
                            <div class="product-price">
                                $1,199.99
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    <div class="container">
        <hr class="mt-5 mb-0">
    </div><!-- End .container -->

    <div class="icon-boxes-container mt-2 mb-2 bg-transparent">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="icon-box icon-box-side">
                        <span class="icon-box-icon text-dark">
                            <i class="icon-rocket"></i>
                        </span>
                        <div class="icon-box-content">
                            <h3 class="icon-box-title">Free Shipping</h3><!-- End .icon-box-title -->
                            <p>Orders $50 or more</p>
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-sm-6 col-lg-3 -->

                <div class="col-sm-6 col-lg-3">
                    <div class="icon-box icon-box-side">
                        <span class="icon-box-icon text-dark">
                            <i class="icon-rotate-left"></i>
                        </span>

                        <div class="icon-box-content">
                            <h3 class="icon-box-title">Free Returns</h3><!-- End .icon-box-title -->
                            <p>Within 30 days</p>
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-sm-6 col-lg-3 -->

                <div class="col-sm-6 col-lg-3">
                    <div class="icon-box icon-box-side">
                        <span class="icon-box-icon text-dark">
                            <i class="icon-info-circle"></i>
                        </span>

                        <div class="icon-box-content">
                            <h3 class="icon-box-title">Get 20% Off 1 Item</h3><!-- End .icon-box-title -->
                            <p>when you sign up</p>
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-sm-6 col-lg-3 -->

                <div class="col-sm-6 col-lg-3">
                    <div class="icon-box icon-box-side">
                        <span class="icon-box-icon text-dark">
                            <i class="icon-life-ring"></i>
                        </span>

                        <div class="icon-box-content">
                            <h3 class="icon-box-title">We Support</h3><!-- End .icon-box-title -->
                            <p>24/7 amazing services</p>
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-sm-6 col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .icon-boxes-container -->

    <div class="container">
        <div class="cta cta-separator cta-border-image cta-half mb-0" style="background-image: url({{ asset('public/frontend') }}/assets/images/demos/demo-3/bg-2.jpg);">
            <div class="cta-border-wrapper bg-white">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="cta-wrapper cta-text text-center">
                            <h3 class="cta-title">Shop Social</h3><!-- End .cta-title -->
                            <p class="cta-desc">Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. </p><!-- End .cta-desc -->

                            <div class="social-icons social-icons-colored justify-content-center">
                                <a href="#" class="social-icon social-facebook" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                <a href="#" class="social-icon social-twitter" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                <a href="#" class="social-icon social-instagram" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                <a href="#" class="social-icon social-youtube" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
                                <a href="#" class="social-icon social-pinterest" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                            </div><!-- End .soial-icons -->
                        </div><!-- End .cta-wrapper -->
                    </div><!-- End .col-lg-6 -->

                    <div class="col-lg-6">
                        <div class="cta-wrapper text-center">
                            <h3 class="cta-title">Get the Latest Deals</h3><!-- End .cta-title -->
                            <p class="cta-desc">and <br>receive <span class="text-primary">$20 coupon</span> for first shopping</p><!-- End .cta-desc -->

                            <form action="#">
                                <div class="input-group">
                                    <input type="email" class="form-control" placeholder="Enter your Email Address" aria-label="Email Adress" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary btn-rounded" type="submit"><i class="icon-long-arrow-right"></i></button>
                                    </div><!-- .End .input-group-append -->
                                </div><!-- .End .input-group -->
                            </form>
                        </div><!-- End .cta-wrapper -->
                    </div><!-- End .col-lg-6 -->
                </div><!-- End .row -->
            </div><!-- End .bg-white -->
        </div><!-- End .cta -->
    </div><!-- End .container -->
<div id="qvmodal"></div>
<style>
    @media screen and (min-width: 768px) {
        .modal-dialog {
            max-width: 900px !important;
        }
    }
</style>
<!-- Quickview Modal -->
<div class="modal fade bd-example-modal-lg" id="quickModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Quick View</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="padding: 10px" id="quickViewProduct">

        </div>
      </div>
    </div>
  </div>
  <!-- Cart Modal -->
<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Cart</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
@push('js')
<script>
    $('body').delegate('.getSubcategoryProduct', 'click', function() {
        var subcategory_id = $(this).attr('data-val');
        $.ajax({
            url: "{{ url('featured_subcategory_product') }}",
            type: "POST",
            data: {
                '_token': "{{ csrf_token() }}",
                subcategory_id: subcategory_id,
            },
            dataType: "json",
            success: function(response) {
                $('.getSubcategoryProduct'+subcategory_id).html(response.success)
            },

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

    //Show Quickview
    $(document).on('click','.quickview',function(){
      var id = $(this).attr("id");
      $.ajax({
        url:"{{ url("/product-quick-view/") }}/"+id,
        type:'get',
        success:function(data) {
          $("#quickViewProduct").html(data);
        }

      });
    });
</script>
@endpush
@endsection

