@extends('frontend.layouts.master')

@section('content')


<main class="main">
        <div class="container">
            <div class="home-slider owl-carousel owl-carousel-lazy">
                @foreach (\App\Slider::where('published', 1)->get() as $key => $slider)
                    <div class="home-slide">
                        <img class="owl-lazy" src="{{ asset($slider->photo) }}"  data-src="{{ asset($slider->photo) }}" alt="slider image">
                    </div><!-- End .home-slide-content -->
                @endforeach
            </div>
        </div>



<div class="container">
                            {{--<div class="row">--}}
                                {{--@foreach (\App\Banner::where('published', 1)->get() as $key => $banner)--}}
                                    {{--<div class="col-lg-4">--}}
                                       {{--<img class="owl-lazy img-responsive" src="{{ asset($banner->photo) }}"  data-src="{{ asset($banner->photo) }}" alt="banner image">--}}
                                    {{--</div>--}}
                                {{--@endforeach--}}
    <div class="row">
    @foreach(\App\Banner::where('published' , 1)->where('position' , 1)->take(3)->get() as $banner)
        <div class="col-4">
            <div class="banner banner-image">
                <a href="#">
                    <img src="{{ asset($banner->photo) }}" alt="banner">
                </a>
            </div><!-- End .banner -->
        </div><!-- End .col-md-4 -->
    @endforeach
    </div>

                            </div>
</div>





                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .home-top-container -->


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
                                                    <a href="ajax/product-quick-view.html" class="btn-quickview">{{ $product->name }}</a>
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
                                                <a href="ajax/product-quick-view.html" class="btn-quickview">{{$product->name}}</a>
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
                                                    <span class="product-price">{{$product->unit_price}}</span>
                                                </div><!-- End .price-box -->

                                                <div class="product-action">
                                                    <a href="#" class="paction add-wishlist" title="Add to Wishlist" onclick="addToWishList({{ $product->id }})">
                                                        <span>Add to Wishlist</span>
                                                    </a>

                                                    <a href="product.html" class="paction add-cart" title="Add to Cart" onclick="showAddToCartModal({{ $product->id }})">
                                                        <span>Add to Cart</span>
                                                    </a>
                                                     <form action="" method="post">
                                                    <a href="#" class="paction add-compare" id="compare" title="Add to Compare" onclick="addToCompare({{ $product->id }})">
                                                        <span>Add to Compare</span>
                                                    </a>
                                                   </form>
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
                                    @php($banner=\App\Banner::where('position' , 2)->first())
                                    <img src="{{ asset($banner->photo) }}" alt="banner" height="100">

                                </div><!-- End .banner -->

                            </div><!-- End .col-md-4 -->

                        </div><!-- End .row -->
                    </div><!-- End .banners-group -->
                </div><!-- End .col-lg-9 -->

            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-4"></div><!-- margin -->

        <div class="partners-container">
            <div class="container">
                <div class="partners-carousel owl-carousel owl-theme">
                    @foreach(\App\Brand::all() as $brand)
                                <a href="#" class="partner">
                                    <img src="{{ asset($brand->logo) }}" alt="logo">
                                </a>
                    @endforeach
                </div><!-- End .partners-carousel -->
            </div><!-- End .container -->
        </div><!-- End .partners-container -->
    </main><!-- End .main -->

@endsection
