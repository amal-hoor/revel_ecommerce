@extends('frontend.layouts.master')

@section('content')


<main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index-2.html"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#">Electronics</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Headsets</li>
                </ol>
            </div><!-- End .container -->
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-single-container product-single-default">
                        <div class="row">
                            <div class="col-lg-7 col-md-6 product-single-gallery">
                                <div class="product-slider-container product-item">
                                    <div class="product-single-carousel owl-carousel owl-theme">

                                                <div class="product-item">
                                                    <img class="product-single-image" src="{{ asset($product->photos) }}" data-zoom-image="{{asset($product->photos)}}"/>
                                                </div>
                                                {{-- @foreach (json_decode($product->photos) as $key => $photo)
                                                <a href="{{ asset($photo) }}">
                                                    <img class="xzoom-gallery" width="80" src="{{ asset($photo) }}"  @if($key == 0) xpreview="{{ asset($photo) }}" @endif>
                                                </a>
                                            @endforeach --}}

                                    </div>
                                    <!-- End .product-single-carousel -->
                                    <span class="prod-full-screen">
                                        <i class="icon-plus"></i>
                                    </span>
                                </div>

                            </div><!-- End .col-lg-7 -->

                            <div class="col-lg-5 col-md-6">
                                <div class="product-single-details">
                                    <h1 class="product-title">Silver Porto Headset</h1>

                                    <div class="ratings-container">
                                        <div class="product-ratings">
                                                @php
                                                    $total = 0;
                                                    $total += $product->reviews->count();
                                                @endphp
                                            <span class="star-rating">
                                                {{ renderStarRating($product->rating) }}
                                            </span>
                                        </div><!-- End .product-ratings -->

                                        <a href="#" class="rating-link"> {{ $total }} Reviews</a>
                                    </div><!-- End .product-container -->

                                    <div class="price-box">
                                        <span class="old-price">{{$product->unit_price}}</span>
                                        <span class="product-price">{{$product->purchase_price}}</span>
                                    </div><!-- End .price-box -->

                                    <div class="product-desc">
                                        <p>{{$product->description}}</p>
                                    </div><!-- End .product-desc -->


                                    <form id="option-choice-form" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $product->id }}">

                                        @foreach (json_decode($product->choice_options) as $key => $choice)
                                            <div class="product-filters-container">
                                                <div class="product-single-filter">
                                                    <label>{{ $choice->title }}:</label>
                                                    <ul class="config-swatch-list">
                                                        @foreach ($choice->options as $key => $option)
                                                            <li>
                                                                <input type="radio" id="{{ $choice->name }}-{{ $option }}"
                                                                       name="{{ $choice->name }}" value="{{ $option }}"
                                                                       @if($key == 0) checked @endif>
                                                                <label for="{{ $choice->name }}-{{ $option }}">{{ $option }}</label>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div><!-- End .product-single-filter -->
                                            </div><!-- End .product-filters-container -->
                                        @endforeach
                                        @if (count(json_decode($product->colors)) > 0)
                                            <div class="product-filters-container">
                                                <div class="product-single-filter">
                                                    <label>{{__('Color')}}:</label>
                                                    <ul class="config-swatch-list">
                                                        @foreach (json_decode($product->colors) as $key => $color)
                                                            <li class="color @if($key==0) active @endif">
                                                                <a href="javascript:void(0)"
                                                                   style="background-color: {{ $color }};"></a>
                                                                <input type="radio" id="{{ $product->id }}-color-{{ $key }}"
                                                                       name="color" style="display: none"
                                                                       value="{{ $color }}" @if($key == 0) checked @endif>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div><!-- End .product-single-filter -->
                                            </div><!-- End .product-filters-container -->
                                        @endif

                                        <div class="product-action">
                                            <div class="number-input" style="padding-right: 10px">
                                                    <div class="product-single-qty">
                                                            <input class="horizontal-quantity form-control" name="quantity" value="1" type="number">
                                                    </div><!-- End .product-single-qty -->
                                            </div>


                                            <button type="button" class="paction add-cart" title="{{__('Add to cart')}}"
                                                    onclick="addToCart()">
                                                <span>{{__('Add to cart')}}</span>
                                            </button>
                                            <button type="button" class="paction add-wishlist" title="{{__('Add to wishlist')}}" onclick="addToWishList({{ $product->id }})">
                                                <span>{{__('Add to wishlist')}}</span>
                                            </button>
                                            <button type="button" class="paction add-compare" title="{{__('Add to compare')}}"
                                                    onclick="addToCompare({{ $product->id }})">
                                                <span>{{__('Add to compare')}}</span>
                                            </button>
                                        </div><!-- End .product-action -->
                                        <style>
                                            .price{
                                                color: #21293c;
                                                font: 600 1.5rem/1.1 "Open Sans", sans-serif;
                                                letter-spacing: .005em;
                                                text-transform: uppercase;
                                                margin-right: 1.3rem;
                                                margin-bottom: 0;

                                            }
                                        </style>
                                        <hr>


                                        <div class="row no-gutters pb-3" id="chosen_price_div">
                                                <div class="col-4">
                                                <div class="product-description-label">{{__('Total Price')}}:</div>
                                                </div>
                                                <div class="col-10">
                                                    <div class="product-price">
                                                        <strong id="total_price">

                                                        </strong>
                                                    </div>
                                                </div>
                                        </div>


                                    </form>
                                </div><!-- End .product-single-details -->
                            </div><!-- End .col-lg-5 -->
                        </div><!-- End .row -->
                    </div><!-- End .product-single-container -->

                    <div class="product-single-tabs">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content" role="tab" aria-controls="product-desc-content" aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="product-tab-reviews" data-toggle="tab" href="#product-reviews-content" role="tab" aria-controls="product-reviews-content" aria-selected="false">Reviews</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel" aria-labelledby="product-tab-desc">
                                <div class="product-desc-content">
                                    <p>{{$product->description}}</p>
                                </div><!-- End .product-desc-content -->
                            </div><!-- End .tab-pane -->



                            <div class="tab-pane fade" id="product-reviews-content" role="tabpanel" aria-labelledby="product-tab-reviews">
                                <div class="product-reviews-content">

                                    <div class="add-product-review">
                                        <h3 class="text-uppercase heading-text-color font-weight-semibold">WRITE YOUR OWN REVIEW</h3>
                                        <p>How do you rate this product? *</p>

                                        <form action="#">
                                            <table class="ratings-table">
                                                <thead>
                                                    <tr>
                                                        <th>&nbsp;</th>
                                                        <th>1 star</th>
                                                        <th>2 stars</th>
                                                        <th>3 stars</th>
                                                        <th>4 stars</th>
                                                        <th>5 stars</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Quality</td>
                                                        <td>
                                                            <input type="radio" name="ratings[1]" id="Quality_1" value="1" class="radio">
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="ratings[1]" id="Quality_2" value="2" class="radio">
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="ratings[1]" id="Quality_3" value="3" class="radio">
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="ratings[1]" id="Quality_4" value="4" class="radio">
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="ratings[1]" id="Quality_5" value="5" class="radio">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Value</td>
                                                        <td>
                                                            <input type="radio" name="value[1]" id="Value_1" value="1" class="radio">
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="value[1]" id="Value_2" value="2" class="radio">
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="value[1]" id="Value_3" value="3" class="radio">
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="value[1]" id="Value_4" value="4" class="radio">
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="value[1]" id="Value_5" value="5" class="radio">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Price</td>
                                                        <td>
                                                            <input type="radio" name="price[1]" id="Price_1" value="1" class="radio">
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="price[1]" id="Price_2" value="2" class="radio">
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="price[1]" id="Price_3" value="3" class="radio">
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="price[1]" id="Price_4" value="4" class="radio">
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="price[1]" id="Price_5" value="5" class="radio">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <div class="form-group">
                                                <label>Nickname <span class="required">*</span></label>
                                                <input type="text" class="form-control form-control-sm" required>
                                            </div><!-- End .form-group -->
                                            <div class="form-group">
                                                <label>Summary of Your Review <span class="required">*</span></label>
                                                <input type="text" class="form-control form-control-sm" required>
                                            </div><!-- End .form-group -->
                                            <div class="form-group mb-2">
                                                <label>Review <span class="required">*</span></label>
                                                <textarea cols="5" rows="6" class="form-control form-control-sm"></textarea>
                                            </div><!-- End .form-group -->

                                            <input type="submit" class="btn btn-primary" value="Submit Review">
                                        </form>
                                    </div><!-- End .add-product-review -->
                                </div><!-- End .product-reviews-content -->
                            </div><!-- End .tab-pane -->
                        </div><!-- End .tab-content -->
                    </div><!-- End .product-single-tabs -->
                </div><!-- End .col-lg-9 -->


                        {{--<div class="widget widget-featured">--}}
                            {{--<h3 class="widget-title">Featured Products</h3>--}}

                            {{--<div class="widget-body">--}}
                                {{--<div class="owl-carousel widget-featured-products">--}}

                                        {{--@foreach (filter_products(\App\Product::where('published', 1)->where('featured', '1'))->limit(12)->get() as $key => $product)--}}

                                    {{--<div class="featured-col">--}}
                                        {{--<div class="product product-sm">--}}
                                            {{--<figure class="product-image-container">--}}
                                                {{--<a href="product.html" class="product-image">--}}
                                                    {{--<img src="{{asset($product->photos)}}" alt="product">--}}
                                                {{--</a>--}}
                                            {{--</figure>--}}
                                            {{--<div class="product-details">--}}
                                                {{--<h2 class="product-title">--}}
                                                    {{--<a href="product.html">{{$product->name}}</a>--}}
                                                {{--</h2>--}}
                                                {{--<div class="ratings-container">--}}
                                                    {{--<div class="product-ratings">--}}

                                                                {{--@php--}}
                                                                {{--$total = 0;--}}
                                                                {{--$total += $product->reviews->count();--}}
                                                            {{--@endphp--}}
                                                        {{--<span class="star-rating">--}}
                                                            {{--{{ renderStarRating($product->rating) }}--}}
                                                        {{--</span>--}}

                                                    {{--</div><!-- End .product-ratings -->--}}
                                                {{--</div><!-- End .product-container -->--}}
                                                {{--<div class="price-box">--}}
                                                    {{--<span class="product-price">{{$product->unit_price}}</span>--}}
                                                {{--</div><!-- End .price-box -->--}}
                                            {{--</div><!-- End .product-details -->--}}
                                        {{--</div><!-- End .product -->--}}

                                    {{--</div><!-- End .featured-col -->--}}
                                    {{--@endforeach--}}
                                {{--</div><!-- End .widget-featured-slider -->--}}
                            {{--</div><!-- End .widget-body -->--}}
                        {{--</div><!-- End .widget -->--}}
        </div><!-- End .container -->

        <div class="featured-section">
            <div class="container">
                <h2 class="carousel-title">Featured Products</h2>

                <div class="featured-products owl-carousel owl-theme owl-dots-top">
                        @foreach (filter_products(\App\Product::where('published', 1)->where('featured', '1'))->limit(12)->get() as $key => $product)
                    <div class="product">
                        <figure class="product-image-container">
                            <a href="product.html" class="product-image">
                                <img src="{{asset($product->photos)}}" alt="product">
                            </a>
                            <a href="ajax/product-quick-view.html" class="btn-quickview">Quick View</a>
                        </figure>
                        <div class="product-details">
                            <div class="ratings-container">
                                    <div class="product-ratings">
                                            @php
                                                $total = 0;
                                                $total += $product->reviews->count();
                                            @endphp
                                        <span class="star-rating">
                                            {{ renderStarRating($product->rating) }}
                                        </span>
                                    </div><!-- End .product-ratings -->
                            </div><!-- End .product-container -->
                            <h2 class="product-title">
                                <a href="product.html">{{$product->name}}</a>
                            </h2>
                            <div class="price-box">
                                <span class="product-price">{{$product->unit_price}}</span>
                            </div><!-- End .price-box -->

                            <div class="product-action">
                                <a href="#" class="paction add-wishlist" title="Add to Wishlist" onclick="addToWishList({{$product->id}})">
                                    <span>Add to Wishlist</span>
                                </a>

                                <a class="add-to-cart btn" class="add-to-cart btn" title="Add to Cart"   onclick="addToCart()">
                                    <span>Add to Cart</span>
                                </a>

                                <a href="#" class="paction add-compare" title="Add to Compare"  onclick="addToCompare({{$product->id}})">
                                    <span>Add to Compare</span>
                                </a>
                            </div><!-- End .product-action -->
                        </div><!-- End .product-details -->
                    </div><!-- End .product -->
                    @endforeach

                </div><!-- End .featured-proucts -->
            </div><!-- End .container -->
        </div><!-- End .featured-section -->
    </main><!-- End .main -->
    @endsection
    <script type="text/javascript">
        $(".quantity").TouchSpin({
                        verticalbuttons: !1,
                        buttonup_txt: "",
                        buttondown_txt: "",
                        buttondown_class: "btn btn-outline btn-down-icon",
                        buttonup_class: "btn btn-outline btn-up-icon",
                        initval: 1,
                        min: 1
        });

        $(".quantity").change(function(){
                getVariantPrice();
        });

            cartQuantityInitialize();
            $('#option-choice-form input').on('change', function(){
                getVariantPrice();
            });
    </script>
