@extends('frontend.layouts.master')

@section('content')


<main class="main">
        <div class="home-top-container">
            <div class="home-slider owl-carousel owl-carousel-lazy">
                @foreach (\App\Slider::where('published', 1)->get() as $key => $slider)
                    <div class="home-slide">
                        <img class="owl-lazy" src="{{ asset($slider->photo) }}" alt="slider image">
                        <div class="home-slide-content">
                            <h1>up to 40% off</h1>
                            <h3>woman clothing</h3>
                            <!--<a href="category.html" class="btn btn-primary">Shop Now</a>-->
                        </div><!-- End .home-slide-content -->
                    </div><!-- End .home-slide -->
                @endforeach
            </div>
        </div>

            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                    </div>

                    <!-- End .col-lg-8 -->

                    <!--<div class="col-lg-4 top-banners">
                        <div class="banner banner-image">
                            <a href="#">
                                <img src="assets/images/banners/banner-1.jpg" alt="banner">
                            </a>
                        </div>&lt;!&ndash; End .banner &ndash;&gt;

                        <div class="banner banner-image">
                            <a href="#">
                                <img src="assets/images/banners/banner-2.jpg" alt="banner">
                            </a>
                        </div>&lt;!&ndash; End .banner &ndash;&gt;

                        <div class="banner banner-image">
                            <a href="#">
                                <img src="assets/images/banners/banner-3.jpg" alt="banner">
                            </a>
                        </div>&lt;!&ndash; End .banner &ndash;&gt;
                    </div>-->
                    <!-- End .col-lg-4 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .home-top-container -->

        <!--
                    <div class="info-boxes-container">
                        <div class="container">
                            <div class="info-box">
                                <i class="icon-shipping"></i>

                                <div class="info-box-content">
                                    <h4>FREE SHIPPING & RETURN</h4>
                                    <p>Free shipping on all orders over $99.</p>
                                </div>&lt;!&ndash; End .info-box-content &ndash;&gt;
                            </div>&lt;!&ndash; End .info-box &ndash;&gt;

                            <div class="info-box">
                                <i class="icon-us-dollar"></i>

                                <div class="info-box-content">
                                    <h4>MONEY BACK GUARANTEE</h4>
                                    <p>100% money back guarantee</p>
                                </div>&lt;!&ndash; End .info-box-content &ndash;&gt;
                            </div>&lt;!&ndash; End .info-box &ndash;&gt;

                            <div class="info-box">
                                <i class="icon-support"></i>

                                <div class="info-box-content">
                                    <h4>ONLINE SUPPORT 24/7</h4>
                                    <p>Lorem ipsum dolor sit amet.</p>
                                </div>&lt;!&ndash; End .info-box-content &ndash;&gt;
                            </div>&lt;!&ndash; End .info-box &ndash;&gt;
                        </div>&lt;!&ndash; End .container &ndash;&gt;
                    </div>&lt;!&ndash; End .info-boxes-container &ndash;&gt;
        -->

        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="home-product-tabs">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="featured-products-tab" data-toggle="tab" href="#featured-products" role="tab" aria-controls="featured-products" aria-selected="true">Featured Products</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="latest-products-tab" data-toggle="tab" href="#latest-products" role="tab" aria-controls="latest-products" aria-selected="false">Latest Products</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="featured-products" role="tabpanel" aria-labelledby="featured-products-tab">
                                <div class="row row-sm">
{{-- featured products --}}
                                    @foreach (filter_products(\App\Product::where('published', 1)->where('featured', '1'))->limit(12)->get() as $key => $product)
                                            <div class="col-6 col-md-4">
                                                <div class="product">
                                                    <figure class="product-image-container">
                                                        <a href="{{ route('product', $product->slug) }}" class="product-image">
                                                            <img src="{{ asset($product->photos)}}" alt="product">
                                                        </a>
                                                        <a href="ajax/product-quick-view.html" class="btn-quickview">Quick View</a>
                                                    </figure>


                                                    <div class="product-details">
                                                        <div class="ratings-container">
                                                            <div class="product-ratings">
                                                                <span class="ratings" style="width:80%"></span><!-- End .ratings -->
                                                            </div><!-- End .product-ratings -->
                                                        </div><!-- End .product-container -->
                                                        <h2 class="product-title">
                                                        <a href="product.html">{{$product->name}}</a>
                                                        </h2>
                                                        <div class="price-box">
                                                            <span class="product-price"></span>
                                                        </div><!-- End .price-box -->

                                                        <div class="product-action">
                                                            <a href="#" class="paction add-wishlist" title="Add to Wishlist"  onclick="addToWishList({{ $product->id }})">
                                                                <span>Add to Wishlist</span>
                                                            </a>

                                                            <a href="#" class="paction add-cart" title="Add to Cart" onclick="showAddToCartModal({{ $product->id }})">
                                                                <span>Add to Cart</span>
                                                            </a>

                                                            <a href="#" class="paction add-compare" title="Add to Compare" onclick="addToCompare({{ $product->id }})">
                                                                <span>Add to Compare</span>
                                                            </a>
                                                        </div><!-- End .product-action -->
                                                    </div><!-- End .product-details -->

                                                </div><!-- End .product -->
                                            </div><!-- End .col-md-4 -->

                                    @endforeach

                                </div><!-- End .row -->
                            </div><!-- End .tab-pane -->


                            <div class="tab-pane fade" id="latest-products" role="tabpanel" aria-labelledby="latest-products-tab">
                                <div class="row row-sm">
                                        @foreach (filter_products(\App\Product::latest())->get() as $key => $product)
                                    <div class="col-6 col-md-4">
                                        <div class="product">
                                            <figure class="product-image-container">
                                                <a href="product.html" class="product-image">
                                                    <img src="{{$product->photos}}" alt="product">
                                                </a>
                                                <a href="ajax/product-quick-view.html" class="btn-quickview">Quick View</a>
                                            </figure>
                                            <div class="product-details">
                                                <div class="ratings-container">
                                                    <div class="product-ratings">
                                                        <span class="ratings" style="width:80%"></span><!-- End .ratings -->
                                                    </div><!-- End .product-ratings -->
                                                </div><!-- End .product-container -->
                                                <h2 class="product-title">
                                                    <a href="product.html">{{$product->name}}</a>
                                                </h2>
                                                <div class="price-box">
                                                    <span class="product-price">$28.00</span>
                                                </div><!-- End .price-box -->

                                                <div class="product-action">
                                                    <a href="#" class="paction add-wishlist" title="Add to Wishlist">
                                                        <span>Add to Wishlist</span>
                                                    </a>

                                                    <a href="product.html" class="paction add-cart" title="Add to Cart">
                                                        <span>Add to Cart</span>
                                                    </a>

                                                    <a href="#" class="paction add-compare" title="Add to Compare">
                                                        <span>Add to Compare</span>
                                                    </a>
                                                </div><!-- End .product-action -->
                                            </div><!-- End .product-details -->
                                        </div><!-- End .product -->
                                    </div><!-- End .col-md-4 -->
                                    @endforeach



                                </div><!-- End .row -->
                            </div><!-- End .tab-pane -->
                        </div><!-- End .tab-content -->
                    </div><!-- End .home-product-tabs -->

                    <div class="banners-group">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="banner banner-image">
                                    <a href="#">
                                        <img src="{{asset('assets/images/banners/banner-7.jpg')}}" alt="banner">
                                    </a>
                                </div><!-- End .banner -->

                            </div><!-- End .col-md-4 -->

                        </div><!-- End .row -->
                    </div><!-- End .banners-group -->
                </div><!-- End .col-lg-9 -->

            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-4"></div><!-- margin -->
@php
$brands = \App\Brand::all();
@endphp
        <div class="partners-container">
            <div class="container">
                <div class="partners-carousel owl-carousel owl-theme">
                    @foreach ($brands as $brand)
                                <a href="#" class="partner">
                                    <img src="{{ asset($brand->logo) }}" alt="logo">
                                </a>
                    @endforeach
                </div><!-- End .partners-carousel -->
            </div><!-- End .container -->
        </div><!-- End .partners-container -->
    </main><!-- End .main -->

@endsection
